<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle(Request $request)
    {
        // Store intended redirect URL if provided
        if ($request->has('redirect_to')) {
            session(['google_redirect_to' => $request->get('redirect_to')]);
        }
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Check if user exists by google_id or email
            $user = User::where('google_id', $googleUser->id)
                        ->orWhere('email', $googleUser->email)
                        ->first();

            if ($user) {
                if (!$user->google_id) {
                    $user->update([
                        'google_id' => $googleUser->id,
                        'avatar_url' => $googleUser->avatar,
                    ]);
                }
                
                Auth::login($user);
            } else {
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar_url' => $googleUser->avatar,
                    'role' => 'user',
                ]);

                Auth::login($newUser);
            }

            // Redirect to intended URL if set
            $redirectTo = session()->pull('google_redirect_to');
            if ($redirectTo) {
                return redirect($redirectTo)->with('success_feedback', 'Berhasil login dengan Google!');
            }

            return redirect()->route('front.beranda')->with('success_feedback', 'Berhasil login dengan Google!');

        } catch (Exception $e) {
            $redirectTo = session()->pull('google_redirect_to');
            return redirect($redirectTo ?? route('front.beranda'))->with('error', 'Gagal login dengan Google. Coba lagi.');
        }
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $redirectTo = $request->get('redirect_to', route('front.beranda'));
        return redirect($redirectTo);
    }
}
