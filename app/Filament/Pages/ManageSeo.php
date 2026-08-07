<?php

namespace App\Filament\Pages;

use App\Models\SeoSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;

class ManageSeo extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-magnifying-glass';
    protected static ?string $navigationLabel = 'Pengaturan SEO';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $title = 'Pengaturan SEO';
    protected static string $view = 'filament.pages.manage-seo';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SeoSetting::all()->pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('SEO Settings')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Umum')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                Forms\Components\TextInput::make('site_name')
                                    ->label('Nama Situs')
                                    ->required(),
                                Forms\Components\TextInput::make('site_title')
                                    ->label('Judul Default Situs')
                                    ->helperText('Format: Nama Situs - Tagline')
                                    ->required(),
                                Forms\Components\Textarea::make('site_description')
                                    ->label('Deskripsi Default Situs')
                                    ->helperText('Maks. 160 karakter untuk optimal di Google')
                                    ->rows(3)
                                    ->required(),
                                Forms\Components\Textarea::make('site_keywords')
                                    ->label('Keywords Default')
                                    ->helperText('Pisahkan dengan koma')
                                    ->rows(2),
                                Forms\Components\TextInput::make('og_image')
                                    ->label('OG Image Default (URL)')
                                    ->helperText('Ukuran ideal: 1200x630px')
                                    ->url(),
                                Forms\Components\TextInput::make('favicon')
                                    ->label('Favicon (URL/path)'),
                            ]),

                        Forms\Components\Tabs\Tab::make('Organisasi')
                            ->icon('heroicon-o-building-office')
                            ->schema([
                                Forms\Components\TextInput::make('organization_name')
                                    ->label('Nama Organisasi'),
                                Forms\Components\TextInput::make('organization_legal_name')
                                    ->label('Nama Legal'),
                                Forms\Components\TextInput::make('organization_founding_year')
                                    ->label('Tahun Berdiri'),
                                Forms\Components\TextInput::make('organization_logo')
                                    ->label('Logo (URL)'),
                                Forms\Components\TextInput::make('organization_email')
                                    ->label('Email')
                                    ->email(),
                                Forms\Components\TextInput::make('organization_phone')
                                    ->label('Telepon/WhatsApp'),
                                Forms\Components\Textarea::make('organization_address')
                                    ->label('Alamat')
                                    ->rows(2),
                            ]),

                        Forms\Components\Tabs\Tab::make('Media Sosial')
                            ->icon('heroicon-o-share')
                            ->schema([
                                Forms\Components\TextInput::make('social_whatsapp')
                                    ->label('Nomor WhatsApp')
                                    ->helperText('Format: 628123456789 (tanpa spasi, tanda + atau angka 0 di depan)')
                                    ->tel(),
                                Forms\Components\TextInput::make('social_email')
                                    ->label('Email')
                                    ->email(),
                                Forms\Components\TextInput::make('social_instagram')
                                    ->label('Instagram URL')
                                    ->url()
                                    ->prefix('https://'),
                                Forms\Components\TextInput::make('social_facebook')
                                    ->label('Facebook URL')
                                    ->url()
                                    ->prefix('https://'),
                                Forms\Components\TextInput::make('social_youtube')
                                    ->label('YouTube URL')
                                    ->url()
                                    ->prefix('https://'),
                                Forms\Components\TextInput::make('social_twitter')
                                    ->label('Twitter/X URL')
                                    ->url()
                                    ->prefix('https://'),
                                Forms\Components\TextInput::make('social_tiktok')
                                    ->label('TikTok URL')
                                    ->url()
                                    ->prefix('https://'),
                            ]),

                        Forms\Components\Tabs\Tab::make('Analytics & Verifikasi')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                Forms\Components\TextInput::make('google_verification')
                                    ->label('Google Search Console Verification')
                                    ->helperText('Kode meta tag verification dari Google Search Console'),
                                Forms\Components\TextInput::make('google_analytics_id')
                                    ->label('Google Analytics 4 ID')
                                    ->placeholder('G-XXXXXXXXXX'),
                                Forms\Components\TextInput::make('gtm_id')
                                    ->label('Google Tag Manager ID')
                                    ->placeholder('GTM-XXXXXXX'),
                                Forms\Components\TextInput::make('bing_verification')
                                    ->label('Bing Webmaster Verification'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            SeoSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        SeoSetting::clearCache();

        Notification::make()
            ->title('Pengaturan SEO berhasil disimpan!')
            ->success()
            ->send();
    }
}
