<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerAdvertisementResource\Pages;
use App\Filament\Resources\BannerAdvertisementResource\RelationManagers;
use App\Models\BannerAdvertisement;
use Dotenv\Util\Str;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BannerAdvertisementResource extends Resource
{
    protected static ?string $model = BannerAdvertisement::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationGroup = 'Mitra & Iklan';

    public static function getModelLabel(): string
    {
        return 'Banner Iklan';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Banner Iklan';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('link')
                ->activeUrl()
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),

            Forms\Components\FileUpload::make('thumbnail')
                ->required()
                ->image()
                ->disk('public')
                ->saveUploadedFileUsing(fn ($file) => compress_to_webp($file, 'banner-advertisements'))
                ->helperText('Rekomendasi ukuran: Lebar 1200px & Tinggi 420px (Rasio 100:35) agar responsive di HP dan Desktop.')
                ->columnSpanFull(),

            Forms\Components\Select::make('is_active')
                ->options([
                    'active' => 'Active',
                    'not_active' => 'Not Active',
                ])
                ->required()
                ->default('active'),

            Forms\Components\Toggle::make('show_on_all_pages')
                ->label('Tampilkan di Semua Halaman')
                ->default(true)
                ->reactive()
                ->afterStateUpdated(fn ($state, callable $set) => $state ? $set('pages', null) : null),

            Forms\Components\CheckboxList::make('pages')
                ->label('Pilih Halaman Penayangan')
                ->options([
                    'beranda' => 'Beranda / Home',
                    'live' => 'Live Streaming',
                    'profil' => 'Profil Organisasi',
                    'visimisi' => 'Visi & Misi',
                    'panduan' => 'Unduh Panduan',
                    'partner' => 'Partner / Sponsor',
                    'index' => 'Berita / Kabar',
                    'search' => 'Pencarian Berita',
                    'details' => 'Detail Berita',
                    'author' => 'Detail Author',
                ])
                ->columns(2)
                ->visible(fn ($get) => !$get('show_on_all_pages'))
                ->required(fn ($get) => !$get('show_on_all_pages'))
                ->columnSpanFull(),

            Forms\Components\DateTimePicker::make('start_date')
                ->label('Tanggal Mulai')
                ->seconds(false)
                ->required(),

            Forms\Components\DateTimePicker::make('end_date')
                ->label('Tanggal Berakhir')
                ->seconds(false)
                ->required()
                ->after('start_date'),

            Forms\Components\TextInput::make('order')
                ->label('Urutan Tampil')
                ->numeric()
                ->default(1)
                ->required(),

            Forms\Components\TextInput::make('slide_duration')
                ->label('Durasi Slide (Detik)')
                ->numeric()
                ->default(5)
                ->minValue(1)
                ->required()
                ->helperText('Durasi penampilan banner ini sebelum otomatis berganti ke urutan berikutnya.'),

            Forms\Components\Hidden::make('type')->default('banner'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->disk('public'),

                Tables\Columns\TextColumn::make('link')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\IconColumn::make('show_on_all_pages')
                    ->label('Semua Halaman')
                    ->boolean(),

                Tables\Columns\TextColumn::make('pages')
                    ->label('Halaman Penayangan')
                    ->badge()
                    ->separator(',')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'beranda' => 'Beranda',
                        'live' => 'Live',
                        'profil' => 'Profil',
                        'visimisi' => 'Visi Misi',
                        'panduan' => 'Panduan',
                        'partner' => 'Partner',
                        'index' => 'Berita',
                        'search' => 'Pencarian',
                        'details' => 'Detail',
                        'author' => 'Author',
                        default => $state,
                    })
                    ->placeholder('Semua Halaman'),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Mulai')
                    ->dateTime('d M Y H:i')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('Berakhir')
                    ->dateTime('d M Y H:i')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),

                Tables\Columns\TextColumn::make('slide_duration')
                    ->label('Durasi')
                    ->suffix(' detik'),

                Tables\Columns\TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->color(
                        fn(string $state): string => match ($state) {
                            'active' => 'success',
                            'not_active' => 'danger',
                        },
                    ),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getRelations(): array
    {
        return [
                //
            ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBannerAdvertisements::route('/'),
            'create' => Pages\CreateBannerAdvertisement::route('/create'),
            'edit' => Pages\EditBannerAdvertisement::route('/{record}/edit'),
        ];
    }
}