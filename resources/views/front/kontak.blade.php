@extends('front.master')

@section('title', (app()->getLocale() === 'en' ? 'Contact Us' : 'Hubungi Kami') . ' | PB PORSEROSI')

@section('content')
    @php
        $socialIg = \App\Models\SeoSetting::get('social_instagram');
        $socialFb = \App\Models\SeoSetting::get('social_facebook');
        $socialYt = \App\Models\SeoSetting::get('social_youtube');
        $socialTw = \App\Models\SeoSetting::get('social_twitter');
        $socialTt = \App\Models\SeoSetting::get('social_tiktok');
        $orgEmail = \App\Models\SeoSetting::get('social_email') ?: \App\Models\SeoSetting::get('organization_email');
        $orgPhone = \App\Models\SeoSetting::get('social_whatsapp') ?: \App\Models\SeoSetting::get('organization_phone');
        $disciplines = \App\Http\Controllers\FrontController::getDisciplinesData(app()->getLocale());
    @endphp

    <div class="font-[Poppins] text-slate-200 flex flex-col flex-grow min-h-screen bg-[#0d0d1f]">
        <x-navbar />

        {{-- Header Section --}}
        <div class="relative pt-32 pb-12 md:pt-40 md:pb-16 text-center overflow-hidden">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[300px] bg-yellow-500/10 blur-[120px] rounded-full pointer-events-none"></div>
            
            <div class="relative z-10 px-4 max-w-4xl mx-auto">
                <span class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-yellow-500/10 border border-yellow-500/20 text-yellow-500 text-xs font-extrabold tracking-widest mb-4 uppercase">
                    PB PORSEROSI
                </span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4 uppercase tracking-tight">
                    {{ app()->getLocale() === 'en' ? 'Contact Us' : 'Hubungi Kami' }}
                </h1>
                <p class="text-slate-400 text-sm md:text-base max-w-2xl mx-auto leading-relaxed">
                    {{ app()->getLocale() === 'en' 
                        ? 'Get in touch with the Executive Board of the Indonesian Roller Skating Sports Association (PB PORSEROSI).' 
                        : 'Hubungi Pengurus Besar Persatuan Olahraga Sepatu Roda Seluruh Indonesia (PB PORSEROSI) untuk informasi lebih lanjut.' 
                    }}
                </p>
            </div>
        </div>

        {{-- Main Content Section --}}
        <div class="relative pb-24 z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                {{-- Toast Notifications --}}
                @if(session('success_feedback'))
                    <div class="max-w-4xl mx-auto mb-8 bg-emerald-500 text-white px-6 py-4 rounded-2xl shadow-xl flex items-center justify-between border border-emerald-400 font-medium" data-aos="fade-up">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center shrink-0">
                                <i class="fas fa-check"></i>
                            </div>
                            <span>{{ session('success_feedback') }}</span>
                        </div>
                    </div>
                @endif
                @if(session('error'))
                    <div class="max-w-4xl mx-auto mb-8 bg-rose-500 text-white px-6 py-4 rounded-2xl shadow-xl flex items-center justify-between border border-rose-400 font-medium" data-aos="fade-up">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center shrink-0">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-stretch">
                    
                    {{-- KONTEN KIRI: Google Maps Peta --}}
                    <div class="lg:col-span-6 flex flex-col h-[350px] lg:h-auto" data-aos="fade-right" data-aos-duration="1000">
                        <div class="w-full h-full min-h-[350px] bg-[#181836]/40 border border-white/5 rounded-3xl overflow-hidden shadow-2xl relative">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2231036755798!2d106.50649057571201!3d-6.234294544919307!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4207721f49c75b%3A0x4d5c2186876d1a0d!2sKarhana%20parfum%20%26%20konter%20pulsa!5e0!3m2!1sid!2sid!4v1783927988878!5m2!1sid!2sid" 
                                class="absolute inset-0 w-full h-full border-0 grayscale opacity-85 hover:grayscale-0 hover:opacity-100 transition-all duration-700" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="strict-origin-when-cross-origin">
                            </iframe>
                        </div>
                    </div>

                    {{-- KONTEN KANAN: Alamat, Sosmed & Form Saran --}}
                    <div class="lg:col-span-6 flex flex-col justify-between gap-8" data-aos="fade-left" data-aos-duration="1000">
                        
                        {{-- Alamat Kantor & Sosmed --}}
                        <div class="bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-3xl p-6 md:p-8 shadow-xl">
                            
                            {{-- Kantor Sekretariat --}}
                            <div class="mb-8">
                                <h2 class="text-lg font-extrabold text-white mb-4 uppercase tracking-wider pl-2 border-l-4 border-yellow-500">
                                    {{ app()->getLocale() === 'en' ? 'Secretariat Office' : 'Kantor Sekretariat' }}
                                </h2>
                                <p class="text-slate-300 text-sm leading-relaxed mb-1 font-extrabold text-white">
                                    PB PORSEROSI
                                </p>
                                <p class="text-slate-400 text-sm leading-relaxed font-medium">
                                    PPKGBK Building, Lantai 8<br>
                                    Jl. Pintu 1, Senayan<br>
                                    Jakarta, Indonesia
                                </p>
                            </div>

                            {{-- Media Sosial --}}
                            <div>
                                <h2 class="text-lg font-extrabold text-white mb-4 uppercase tracking-wider pl-2 border-l-4 border-yellow-500">
                                    {{ app()->getLocale() === 'en' ? 'Connect With Us' : 'Media Sosial Kami' }}
                                </h2>
                                <div class="flex flex-wrap gap-3">
                                    @if($socialIg)
                                        <a href="{{ $socialIg }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/10 hover:bg-gradient-to-tr hover:from-yellow-600 hover:to-pink-500 hover:border-transparent text-slate-300 hover:text-white transition-all shadow-lg">
                                            <i class="fab fa-instagram text-lg"></i>
                                        </a>
                                    @endif
                                    @if($socialTw)
                                        <a href="{{ $socialTw }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/10 hover:bg-[#1DA1F2] hover:border-transparent text-slate-300 hover:text-white transition-all shadow-lg">
                                            <i class="fab fa-twitter text-lg"></i>
                                        </a>
                                    @endif
                                    @if($orgEmail)
                                        <a href="mailto:{{ $orgEmail }}" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/10 hover:bg-red-500 hover:border-transparent text-slate-300 hover:text-white transition-all shadow-lg">
                                            <i class="fas fa-envelope text-lg"></i>
                                        </a>
                                    @endif
                                    @if($socialYt)
                                        <a href="{{ $socialYt }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/10 hover:bg-red-600 hover:border-transparent text-slate-300 hover:text-white transition-all shadow-lg">
                                            <i class="fab fa-youtube text-lg"></i>
                                        </a>
                                    @endif
                                    @if($socialTt)
                                        <a href="{{ $socialTt }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/10 hover:bg-slate-800 hover:border-transparent text-slate-300 hover:text-white transition-all shadow-lg">
                                            <i class="fab fa-tiktok text-lg"></i>
                                        </a>
                                    @endif
                                    @if($socialFb)
                                        <a href="{{ $socialFb }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/10 hover:bg-blue-600 hover:border-transparent text-slate-300 hover:text-white transition-all shadow-lg">
                                            <i class="fab fa-facebook text-lg"></i>
                                        </a>
                                    @endif
                                    @if($orgPhone)
                                        <a href="https://wa.me/{{ $orgPhone }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/10 hover:bg-emerald-500 hover:border-transparent text-slate-300 hover:text-white transition-all shadow-lg">
                                            <i class="fab fa-whatsapp text-lg"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </div>

                        {{-- Form Isi Saran & Masukan --}}
                        <div id="saran-masukan" class="bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-3xl p-6 md:p-8 shadow-xl">
                            <h2 class="text-lg font-extrabold text-white mb-4 uppercase tracking-wider pl-2 border-l-4 border-yellow-500">
                                {{ app()->getLocale() === 'en' ? 'Submit Suggestions & Feedback' : 'Kirim Saran & Masukan' }}
                            </h2>
                            
                            @auth
                                <div class="mb-4 flex items-center gap-3 p-3 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl">
                                    @if(auth()->user()->avatar_url)
                                        <img src="{{ auth()->user()->avatar_url }}" alt="Google Avatar" class="w-8 h-8 rounded-full border border-emerald-500/30">
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center text-emerald-400">
                                            <i class="fas fa-user-circle text-lg"></i>
                                        </div>
                                    @endif
                                    <div class="text-xs">
                                        <div class="font-extrabold text-white">{{ auth()->user()->name }}</div>
                                        <div class="text-slate-400">{{ auth()->user()->email }} (Google Account)</div>
                                    </div>
                                </div>

                                <form action="{{ route('front.feedback.store') }}" method="POST" class="space-y-4">
                                    @csrf

                                    {{-- Honeypot field for bot protection --}}
                                    <div class="hidden" style="display: none;">
                                        <input type="text" name="website" tabindex="-1" autocomplete="off">
                                    </div>

                                    <div>
                                        <label for="email" class="block text-xs font-bold text-slate-400 mb-2 uppercase tracking-wide">
                                            {{ app()->getLocale() === 'en' ? 'Your Email Address' : 'Alamat Email Anda' }}
                                        </label>
                                        <input 
                                            type="email" 
                                            name="email" 
                                            id="email" 
                                            readonly 
                                            value="{{ auth()->user()->email }}"
                                            class="w-full bg-black/10 border border-white/5 rounded-2xl px-4 py-3 text-slate-400 cursor-not-allowed focus:outline-none text-sm" 
                                            placeholder="contoh@email.com">
                                    </div>

                                    <div>
                                        <label for="discipline" class="block text-xs font-bold text-slate-400 mb-2 uppercase tracking-wide">
                                            {{ app()->getLocale() === 'en' ? 'Select Target / Discipline' : 'Pilih Bagian / Disiplin' }}
                                        </label>
                                        <div class="relative">
                                            <select 
                                                name="discipline" 
                                                id="discipline" 
                                                required
                                                class="w-full bg-black/30 border border-white/10 rounded-2xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-colors text-sm appearance-none cursor-pointer">
                                                <option value="Umum" {{ old('discipline') === 'Umum' ? 'selected' : '' }}>
                                                    {{ app()->getLocale() === 'en' ? 'General' : 'Umum' }}
                                                </option>
                                                @foreach($disciplines as $slug => $cabor)
                                                    <option value="{{ $cabor['name'] }}" {{ old('discipline') === $cabor['name'] ? 'selected' : '' }}>
                                                        {{ $cabor['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                                <i class="fas fa-chevron-down text-xs"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="message" class="block text-xs font-bold text-slate-400 mb-2 uppercase tracking-wide">
                                            {{ app()->getLocale() === 'en' ? 'Message / Suggestion' : 'Pesan / Saran' }}
                                        </label>
                                        <textarea 
                                            name="message" 
                                            id="message" 
                                            required 
                                            rows="4" 
                                            class="w-full bg-black/30 border border-white/10 rounded-2xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-colors resize-none text-sm" 
                                            placeholder="{{ app()->getLocale() === 'en' ? 'Write your suggestions or feedback for PB PORSEROSI...' : 'Tuliskan saran atau masukan Anda untuk PB PORSEROSI...' }}">{{ old('message') }}</textarea>
                                    </div>

                                    <div class="pt-2">
                                        <button type="submit" class="w-full bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-400 hover:to-yellow-500 text-black font-extrabold py-3.5 px-4 rounded-2xl flex items-center justify-center gap-2 transition-all shadow-lg hover:shadow-yellow-500/25 text-sm uppercase tracking-wider">
                                            <i class="fas fa-paper-plane"></i>
                                            {{ app()->getLocale() === 'en' ? 'Submit Feedback' : 'Kirim Masukan' }}
                                        </button>
                                    </div>
                                </form>
                            @else
                                <div class="text-center py-6">
                                    <div class="w-12 h-12 rounded-full bg-yellow-500/10 flex items-center justify-center text-yellow-500 mx-auto mb-4">
                                        <i class="fas fa-info-circle text-xl"></i>
                                    </div>
                                    <h3 class="text-white font-extrabold text-sm mb-2 uppercase tracking-wider">
                                        {{ app()->getLocale() === 'en' ? 'Google Login Required' : 'Wajib Login dengan Google' }}
                                    </h3>
                                    <p class="text-slate-400 text-xs mb-6 max-w-xs mx-auto leading-relaxed">
                                        {{ app()->getLocale() === 'en' 
                                            ? 'You need to login with your Google account to submit suggestions & feedback.' 
                                            : 'Anda harus login dengan akun Google terlebih dahulu untuk dapat mengirimkan saran & masukan.' }}
                                    </p>
                                    <a href="{{ route('auth.google') }}?redirect_to={{ urlencode(route('front.kontak')) }}" class="inline-flex items-center justify-center gap-3 px-6 py-3 rounded-2xl bg-white text-gray-800 font-extrabold text-xs uppercase tracking-wider hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-white/10">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                                        {{ app()->getLocale() === 'en' ? 'Login with Google' : 'Login dengan Google' }}
                                    </a>
                                </div>
                            @endauth
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <x-footer />
    </div>
@endsection
