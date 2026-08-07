<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class EditProfile extends BaseEditProfile
{
    /**
     * Override the form schema to add avatar upload and customize password fields.
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('avatar_url')
                    ->label('Foto Profil')
                    ->avatar()
                    ->disk('public')
                    ->directory('avatars')
                    ->image()
                    ->saveUploadedFileUsing(fn ($file) => compress_to_webp($file, 'avatars'))
                    ->columnSpanFull(),
                
                $this->getNameFormComponent(),
                
                $this->getEmailFormComponent(),
                
                // Password field (always visible, same validation)
                TextInput::make('password')
                    ->label('Kata Sandi Baru')
                    ->password()
                    ->revealable(filament()->arePasswordsRevealable())
                    ->rule(Password::default())
                    ->autocomplete('new-password')
                    ->dehydrated(fn ($state): bool => filled($state))
                    ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
                    ->live(debounce: 500)
                    ->same('passwordConfirmation'),
                
                // Password confirmation field (always visible, required when password is filled)
                TextInput::make('passwordConfirmation')
                    ->label('Konfirmasi Kata Sandi Baru')
                    ->password()
                    ->revealable(filament()->arePasswordsRevealable())
                    ->required(fn (Get $get): bool => filled($get('password')))
                    ->dehydrated(false),
            ]);
    }
}
