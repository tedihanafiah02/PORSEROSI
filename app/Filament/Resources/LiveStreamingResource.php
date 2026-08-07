<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LiveStreamingResource\Pages;
use App\Models\LiveStreaming;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\BadgeColumn;

class LiveStreamingResource extends Resource
{
    protected static ?string $model = LiveStreaming::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';
    protected static ?string $navigationGroup = 'Galeri & Media';
    protected static ?string $navigationLabel = 'Live Streaming';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Informasi Utama')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(LiveStreaming::class, 'slug', ignoreRecord: true),
                                Forms\Components\Select::make('platform')
                                    ->required()
                                    ->options([
                                        'youtube' => 'YouTube Live',
                                        'tv' => 'TV Streaming',
                                    ])
                                    ->default('youtube'),
                                Forms\Components\Textarea::make('embed_url')
                                    ->required()
                                    ->columnSpanFull()
                                    ->helperText('Masukkan URL embed iframe yang valid atau link streaming untuk platform yang dipilih.'),
                                Forms\Components\Textarea::make('description')
                                    ->columnSpanFull()
                                    ->rows(3),
                            ])->columns(2),

                        Forms\Components\Section::make('Status Terjemahan (Otomatis)')
                            ->description('Kolom ini akan terisi otomatis saat Anda menyimpan data dalam Bahasa Indonesia.')
                            ->collapsible()
                            ->collapsed()
                            ->icon('heroicon-o-language')
                            ->schema([
                                Forms\Components\TextInput::make('title_en')
                                    ->label('Title (EN)')
                                    ->placeholder('Akan terisi otomatis...'),
                                
                                Forms\Components\Textarea::make('description_en')
                                    ->label('Description (EN)')
                                    ->placeholder('Akan terisi otomatis...')
                                    ->rows(3),
                            ]),

                        Forms\Components\Section::make('Penjadwalan')
                            ->schema([
                                Forms\Components\DateTimePicker::make('start_datetime')
                                    ->required()
                                    ->label('Jadwal Dimulai'),
                                Forms\Components\DateTimePicker::make('end_datetime')
                                    ->label('Perkiraan Selesai (Opsional)'),
                            ])->columns(2),
                    ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Media & Status')
                            ->schema([
                                Forms\Components\FileUpload::make('thumbnail')
                                    ->image()
                                    ->directory('live-thumbnails')
                                    ->disk('public')
                                    ->saveUploadedFileUsing(fn ($file) => compress_to_webp($file, 'live-thumbnails'))
                                    ->maxSize(2048)
                                    ->helperText('Gambar poster sebelum live dimulai.'),
                                Forms\Components\Select::make('status')
                                    ->required()
                                    ->options([
                                        'upcoming' => 'Akan Datang',
                                        'live' => 'Live Now',
                                        'finished' => 'Selesai',
                                    ])
                                    ->default('upcoming')
                                    ->helperText('Status dapat diotomatisasi di halaman publik berdasarkan jadwal.'),
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Tampilkan di Publik')
                                    ->default(true)
                                    ->required(),
                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Sorot (Featured)')
                                    ->default(false)
                                    ->required(),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->circular()
                    ->disk('public')
                    ->defaultImageUrl(url('/images/placeholder.png')),
                TextColumn::make('title')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn (LiveStreaming $record): string => Str::limit($record->description, 40)),
                TextColumn::make('platform')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'youtube' => 'danger',
                        'tv' => 'primary',
                        default => 'info',
                    })
                    ->searchable(),
                TextColumn::make('start_datetime')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->label('Jadwal Live'),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'primary' => 'upcoming',
                        'danger' => 'live',
                        'success' => 'finished',
                    ]),
                ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('start_datetime', 'desc');
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
            'index' => Pages\ListLiveStreamings::route('/'),
            'create' => Pages\CreateLiveStreaming::route('/create'),
            'edit' => Pages\EditLiveStreaming::route('/{record}/edit'),
        ];
    }
}
