<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use App\Models\EventOption;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Semua Event';

    protected static ?string $modelLabel = 'Event';

    protected static ?string $pluralModelLabel = 'Semua Event';

    protected static ?string $navigationGroup = 'Event';

    protected static ?int $navigationSort = 1;

    protected static function getEventOptions(string $type, array $defaults): array
    {
        $stored = EventOption::where('type', $type)
            ->orderBy('name')
            ->pluck('name', 'name')
            ->toArray();

        return array_merge($defaults, $stored);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Event')
                ->description('Data utama event')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->label('Nama Event')
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Forms\Components\DatePicker::make('start_date')
                        ->required()
                        ->label('Tanggal Mulai')
                        ->native(false)
                        ->displayFormat('d/m/Y'),

                    Forms\Components\DatePicker::make('end_date')
                        ->label('Tanggal Selesai')
                        ->native(false)
                        ->displayFormat('d/m/Y')
                        ->afterOrEqual('start_date'),

                    Forms\Components\TextInput::make('venue')
                        ->required()
                        ->label('Venue / Tempat')
                        ->maxLength(255),

                    Forms\Components\TextInput::make('city')
                        ->label('Kota')
                        ->maxLength(255),

                    Forms\Components\TextInput::make('country')
                        ->label('Negara')
                        ->default('Indonesia')
                        ->maxLength(255),

                    Forms\Components\TextInput::make('organizer')
                        ->required()
                        ->label('Penyelenggara')
                        ->maxLength(255),
                ])->columns(2),

            Forms\Components\Section::make('Detail Event')
                ->schema([
                    Forms\Components\RichEditor::make('description')
                        ->label('Deskripsi Event')
                        ->columnSpanFull(),

                    Forms\Components\FileUpload::make('logo')
                        ->label('Logo Event')
                        ->image()
                        ->directory('events')
                        ->disk('public')
                        ->saveUploadedFileUsing(fn ($file) => compress_to_webp($file, 'events'))
                        ->maxSize(2048),

                    Forms\Components\Hidden::make('category')
                        ->dehydrated(true)
                        ->dehydrateStateUsing(function ($state) {
                            if (!empty($state)) {
                                \App\Models\EventOption::firstOrCreate([
                                    'type' => 'category',
                                    'name' => $state,
                                ]);
                            }
                            return $state;
                        }),
                    Forms\Components\Select::make('category_select')
                        ->label('Kategori')
                        ->options(function ($get) {
                            $current = $get('category');
                            $defaults = [
                                'kompetisi' => 'Kompetisi',
                                'pelatihan' => 'Pelatihan',
                                'seleksi' => 'Seleksi Nasional',
                                'exhibition' => 'Exhibition',
                                'seminar' => 'Seminar',
                            ];
                            if ($current && !in_array($current, array_keys($defaults))) {
                                $defaults[$current] = $current;
                            }
                            return array_merge(self::getEventOptions('category', $defaults), ['__other__' => 'Ketik Manual...']);
                        })
                        ->placeholder('Pilih kategori')
                        ->reactive()
                        ->required()
                        ->dehydrated(false)
                        ->afterStateHydrated(function ($state, $set, $get) {
                            $dbVal = $get('category');
                            if ($dbVal) {
                                $set('category_select', $dbVal);
                            }
                        })
                        ->afterStateUpdated(function ($state, $set) {
                            if ($state !== '__other__') {
                                $set('category', $state);
                            }
                        })
                        ->visible(fn ($get) => $get('category_select') !== '__other__'),
                    Forms\Components\TextInput::make('category_custom')
                        ->label('Kategori (Ketik Manual)')
                        ->placeholder('Ketik kategori baru jika tidak ada dalam daftar')
                        ->reactive()
                        ->required()
                        ->dehydrated(false)
                        ->afterStateUpdated(function ($state, $set) {
                            $set('category', $state);
                        })
                        ->visible(fn ($get) => $get('category_select') === '__other__')
                        ->suffixAction(
                            Forms\Components\Actions\Action::make('backToSelectCategory')
                                ->icon('heroicon-m-arrow-path')
                                ->action(function ($set) {
                                    $set('category_select', null);
                                    $set('category', null);
                                    $set('category_custom', null);
                                })
                        ),

                    Forms\Components\Select::make('sport_type')
                        ->label('Disiplin Olahraga')
                        ->options([
                            'all'              => 'Semua Disiplin',
                            'inline-freestyle' => 'Inline Freestyle',
                            'inline-hockey'    => 'Inline Hockey',
                            'roller-freestyle' => 'Roller Freestyle',
                            'scooter'          => 'Scooter',
                            'skateboard'       => 'Skateboard',
                            'speed'            => 'Speed',
                            'artistic'         => 'Artistic',
                        ])
                        ->default('all')
                        ->required(),

                    Forms\Components\Select::make('status')
                        ->label('Status')
                        ->options([
                            'upcoming' => 'Akan Datang',
                            'ongoing' => 'Berlangsung',
                            'completed' => 'Selesai',
                            'cancelled' => 'Dibatalkan',
                        ])
                        ->default('upcoming')
                        ->required(),

                    Forms\Components\Hidden::make('scale')
                        ->dehydrated(true)
                        ->dehydrateStateUsing(function ($state) {
                            if (!empty($state)) {
                                \App\Models\EventOption::firstOrCreate([
                                    'type' => 'scale',
                                    'name' => $state,
                                ]);
                            }
                            return $state;
                        }),
                    Forms\Components\Select::make('scale_select')
                        ->label('Skala Event')
                        ->options(function ($get) {
                            $current = $get('scale');
                            $defaults = [
                                'Provinsi' => 'Provinsi',
                                'Regional' => 'Regional',
                                'Nasional' => 'Nasional',
                                'Internasional' => 'Internasional',
                            ];
                            if ($current && !in_array($current, array_keys($defaults))) {
                                $defaults[$current] = $current;
                            }
                            return array_merge(self::getEventOptions('scale', $defaults), ['__other__' => 'Ketik Manual...']);
                        })
                        ->placeholder('Pilih skala event')
                        ->reactive()
                        ->required()
                        ->dehydrated(false)
                        ->afterStateHydrated(function ($state, $set, $get) {
                            $dbVal = $get('scale');
                            if ($dbVal) {
                                $set('scale_select', $dbVal);
                            }
                        })
                        ->afterStateUpdated(function ($state, $set) {
                            if ($state !== '__other__') {
                                $set('scale', $state);
                            }
                        })
                        ->visible(fn ($get) => $get('scale_select') !== '__other__'),
                    Forms\Components\TextInput::make('scale_custom')
                        ->label('Skala Event (Ketik Manual)')
                        ->placeholder('Ketik skala event baru jika tidak ada dalam daftar')
                        ->reactive()
                        ->required()
                        ->dehydrated(false)
                        ->afterStateUpdated(function ($state, $set) {
                            $set('scale', $state);
                        })
                        ->visible(fn ($get) => $get('scale_select') === '__other__')
                        ->suffixAction(
                            Forms\Components\Actions\Action::make('backToSelectScale')
                                ->icon('heroicon-m-arrow-path')
                                ->action(function ($set) {
                                    $set('scale_select', null);
                                    $set('scale', null);
                                    $set('scale_custom', null);
                                })
                        ),

                    Forms\Components\Hidden::make('discipline')
                        ->dehydrated(true)
                        ->dehydrateStateUsing(function ($state) {
                            if (!empty($state)) {
                                \App\Models\EventOption::firstOrCreate([
                                    'type' => 'discipline',
                                    'name' => $state,
                                ]);
                            }
                            return $state;
                        }),
                    Forms\Components\Select::make('discipline_select')
                        ->label('Disiplin')
                        ->options(function ($get) {
                            $current = $get('discipline');
                            $defaults = [
                                'Street' => 'Street',
                                'Park' => 'Park',
                                'Game of Skate' => 'Game of Skate',
                                'Best Trick' => 'Best Trick',
                                'Speed' => 'Speed',
                                'Freestyle' => 'Freestyle',
                                'Aggressive' => 'Aggressive',
                            ];
                            if ($current && !in_array($current, array_keys($defaults))) {
                                $defaults[$current] = $current;
                            }
                            return array_merge(self::getEventOptions('discipline', $defaults), ['__other__' => 'Ketik Manual...']);
                        })
                        ->placeholder('Pilih disiplin')
                        ->reactive()
                        ->required()
                        ->dehydrated(false)
                        ->afterStateHydrated(function ($state, $set, $get) {
                            $dbVal = $get('discipline');
                            if ($dbVal) {
                                $set('discipline_select', $dbVal);
                            }
                        })
                        ->afterStateUpdated(function ($state, $set) {
                            if ($state !== '__other__') {
                                $set('discipline', $state);
                            }
                        })
                        ->visible(fn ($get) => $get('discipline_select') !== '__other__'),
                    Forms\Components\TextInput::make('discipline_custom')
                        ->label('Disiplin (Ketik Manual)')
                        ->placeholder('Ketik disiplin baru jika tidak ada dalam daftar')
                        ->reactive()
                        ->required()
                        ->dehydrated(false)
                        ->afterStateUpdated(function ($state, $set) {
                            $set('discipline', $state);
                        })
                        ->visible(fn ($get) => $get('discipline_select') === '__other__')
                        ->suffixAction(
                            Forms\Components\Actions\Action::make('backToSelectDiscipline')
                                ->icon('heroicon-m-arrow-path')
                                ->action(function ($set) {
                                    $set('discipline_select', null);
                                    $set('discipline', null);
                                    $set('discipline_custom', null);
                                })
                        ),
                ])->columns(2),

            Forms\Components\Section::make('Informasi Tambahan')
                ->schema([
                    Forms\Components\Toggle::make('is_published')
                        ->label('Publikasikan')
                        ->default(true),
                    Forms\Components\Toggle::make('is_registration_open')
                        ->label('Buka Pendaftaran')
                        ->default(false)
                        ->reactive(),
                    Forms\Components\TextInput::make('registration_url')
                        ->label('Link Pendaftaran (e.g. Google Form)')
                        ->url()
                        ->placeholder('https://forms.gle/...')
                        ->visible(fn ($get) => $get('is_registration_open'))
                        ->required(fn ($get) => $get('is_registration_open'))
                        ->maxLength(255)
                        ->columnSpanFull(),
                ])->columns(2),

            Forms\Components\Section::make('Status Terjemahan (Otomatis)')
                ->description('Kolom ini akan terisi otomatis saat Anda menyimpan data dalam Bahasa Indonesia.')
                ->collapsible()
                ->collapsed()
                ->icon('heroicon-o-language')
                ->schema([
                    Forms\Components\TextInput::make('name_en')
                        ->label('Event Name (EN)')
                        ->placeholder('Akan terisi otomatis...'),
                    
                    Forms\Components\TextInput::make('venue_en')
                        ->label('Venue (EN)')
                        ->placeholder('Akan terisi otomatis...'),
                    
                    Forms\Components\TextInput::make('city_en')
                        ->label('City (EN)')
                        ->placeholder('Akan terisi otomatis...'),
                    
                    Forms\Components\RichEditor::make('description_en')
                        ->label('Description (EN)')
                        ->placeholder('Akan terisi otomatis...')
                        ->columnSpanFull(),
                ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo')
                    ->circular()
                    ->disk('public'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Event')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('venue')
                    ->label('Venue')
                    ->limit(30),

                Tables\Columns\TextColumn::make('organizer')
                    ->label('Penyelenggara')
                    ->limit(25),

                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'kompetisi' => 'Kompetisi',
                        'pelatihan' => 'Pelatihan',
                        'seleksi' => 'Seleksi Nasional',
                        'exhibition' => 'Exhibition',
                        'seminar' => 'Seminar',
                        default => ucfirst($state),
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'upcoming' => 'info',
                        'ongoing' => 'success',
                        'completed' => 'gray',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'upcoming' => 'Akan Datang',
                        'ongoing' => 'Berlangsung',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                        default => ucfirst($state),
                    }),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),
            ])
            ->defaultSort('start_date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'upcoming' => 'Akan Datang',
                        'ongoing' => 'Berlangsung',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ]),
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'kompetisi' => 'Kompetisi',
                        'pelatihan' => 'Pelatihan',
                        'seleksi' => 'Seleksi Nasional',
                        'exhibition' => 'Exhibition',
                    ]),
                Tables\Filters\SelectFilter::make('sport_type')
                    ->label('Disiplin')
                    ->options([
                        'all'              => 'Semua Disiplin',
                        'inline-freestyle' => 'Inline Freestyle',
                        'inline-hockey'    => 'Inline Hockey',
                        'roller-freestyle' => 'Roller Freestyle',
                        'scooter'          => 'Scooter',
                        'skateboard'       => 'Skateboard',
                        'speed'            => 'Speed',
                        'artistic'         => 'Artistic',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
