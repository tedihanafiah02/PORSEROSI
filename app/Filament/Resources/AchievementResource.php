<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementResource\Pages;
use App\Models\Achievement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AchievementResource extends Resource
{
    protected static ?string $model = Achievement::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationLabel = 'Prestasi';
    protected static ?string $navigationGroup = 'Tentang';
    protected static ?int $navigationSort = 5;
    protected static ?string $modelLabel = 'Prestasi';
    protected static ?string $pluralModelLabel = 'Data Prestasi';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Turnamen')->schema([
                Forms\Components\TextInput::make('year')
                    ->label('Tahun')
                    ->required()
                    ->numeric()
                    ->minValue(2000)
                    ->maxValue(2100)
                    ->default(now()->year),

                Forms\Components\TextInput::make('tournament_name')
                    ->label('Nama Turnamen')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Hidden::make('tournament_level')
                    ->dehydrated(true),

                Forms\Components\Select::make('tournament_level_select')
                    ->label('Level Turnamen')
                    ->options(function ($get) {
                        $current = $get('tournament_level');
                        $defaults = [
                            'Internasional' => 'Internasional',
                            'Regional'      => 'Regional (SEA / Asia)',
                            'Nasional'      => 'Nasional',
                        ];
                        if ($current && !in_array($current, array_keys($defaults))) {
                            $defaults[$current] = $current;
                        }
                        return array_merge($defaults, ['__other__' => 'Ketik Manual...']);
                    })
                    ->reactive()
                    ->required()
                    ->dehydrated(false)
                    ->afterStateHydrated(function ($state, $set, $get) {
                        $dbVal = $get('tournament_level');
                        if ($dbVal) {
                            $set('tournament_level_select', $dbVal);
                        }
                    })
                    ->afterStateUpdated(function ($state, $set) {
                        if ($state !== '__other__') {
                            $set('tournament_level', $state);
                        }
                    })
                    ->visible(fn ($get) => $get('tournament_level_select') !== '__other__'),

                Forms\Components\TextInput::make('tournament_level_custom')
                    ->label('Level Turnamen (Ketik Manual)')
                    ->placeholder('Ketik level turnamen baru')
                    ->reactive()
                    ->required()
                    ->dehydrated(false)
                    ->afterStateUpdated(function ($state, $set) {
                        $set('tournament_level', $state);
                    })
                    ->visible(fn ($get) => $get('tournament_level_select') === '__other__')
                    ->suffixAction(
                        Forms\Components\Actions\Action::make('backToSelectLevel')
                            ->icon('heroicon-m-arrow-path')
                            ->action(function ($set) {
                                $set('tournament_level_select', null);
                                $set('tournament_level', null);
                                $set('tournament_level_custom', null);
                            })
                    ),
            ])->columns(3),

            Forms\Components\Section::make('Detail Prestasi')->schema([
                Forms\Components\Select::make('cabang_olahraga')
                    ->label('Disiplin')
                    ->required()
                    ->options([
                        'Inline Freestyle' => 'Inline Freestyle',
                        'Inline Hockey'    => 'Inline Hockey',
                        'Roller Freestyle' => 'Roller Freestyle',
                        'Scooter'          => 'Scooter',
                        'Skateboard'       => 'Skateboard',
                        'Speed'            => 'Speed',
                        'Artistic'         => 'Artistic',
                    ])
                    ->default('Inline Freestyle'),

                Forms\Components\Hidden::make('discipline')
                    ->dehydrated(true),

                Forms\Components\Select::make('discipline_select')
                    ->label('Disiplin')
                    ->options(function ($get) {
                        $current = $get('discipline');
                        $defaults = [
                            // Sepatu Roda
                            'Inline Speed Skating 300m Putra'       => 'Speed 300m Putra',
                            'Inline Speed Skating 300m Putri'       => 'Speed 300m Putri',
                            'Inline Speed Skating 500m Putra'       => 'Speed 500m Putra',
                            'Inline Speed Skating 500m Putri'       => 'Speed 500m Putri',
                            'Inline Speed Skating 1000m Putra'      => 'Speed 1000m Putra',
                            'Inline Speed Skating 1000m Putri'      => 'Speed 1000m Putri',
                            'Inline Speed Skating 10.000m Points Race Putra' => 'Speed 10.000m PR Putra',
                            'Inline Speed Skating 10.000m Points Race Putri' => 'Speed 10.000m PR Putri',
                            'Inline Speed Marathon Putra'           => 'Speed Marathon Putra',
                            'Inline Speed Marathon Putri'           => 'Speed Marathon Putri',
                            'Artistic Skating Free Putri'           => 'Artistic Free Putri',
                            'Artistic Skating Free Putra'           => 'Artistic Free Putra',
                            'Artistic Compulsory Figures Putri'     => 'Artistic Compulsory Putri',
                            'Artistic Compulsory Figures Putra'     => 'Artistic Compulsory Putra',
                            'Artistic Solo Dance Putri'             => 'Artistic Solo Dance Putri',
                            'Roller Hockey Putra'                   => 'Roller Hockey Putra',
                            'Roller Hockey Putri'                   => 'Roller Hockey Putri',
                            'Downhill Putra'                        => 'Downhill Putra',
                            'Downhill Putri'                        => 'Downhill Putri',
                            'Downhill / Slalom Putra'               => 'Downhill/Slalom Putra',
                            'Slalom Speed Putri'                    => 'Slalom Speed Putri',
                            // Skateboard
                            'Skateboard Street Putra'               => 'Skateboard Street Putra',
                            'Skateboard Street Putri'               => 'Skateboard Street Putri',
                            'Skateboard Park Putra'                 => 'Skateboard Park Putra',
                            'Skateboard Park Putri'                 => 'Skateboard Park Putri',
                            // Scooter
                            'Scooter Park Putra'                    => 'Scooter Park Putra',
                            'Scooter Park Putri'                    => 'Scooter Park Putri',
                            'Scooter Street Putra'                  => 'Scooter Street Putra',
                            'Scooter Street Putri'                  => 'Scooter Street Putri',
                        ];
                        if ($current && !in_array($current, array_keys($defaults))) {
                            $defaults[$current] = $current;
                        }
                        return array_merge($defaults, ['__other__' => 'Ketik Manual...']);
                    })
                    ->searchable()
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
                    ->placeholder('Ketik disiplin baru')
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

                Forms\Components\Hidden::make('achievement_type')
                    ->dehydrated(true),

                Forms\Components\Select::make('achievement_type_select')
                    ->label('Pencapaian')
                    ->options(function ($get) {
                        $current = $get('achievement_type');
                        $defaults = [
                            'Winner'     => '🥇 Winner (Juara 1)',
                            'Runner-Up'  => '🥈 Runner-Up (Juara 2)',
                            'Bronze'     => '🥉 Bronze (Juara 3)',
                            'Juara 1'    => 'Juara 1',
                            'Juara 2'    => 'Juara 2',
                            'Juara 3'    => 'Juara 3',
                            'Gold'       => 'Gold Medal',
                            'Silver'     => 'Silver Medal',
                        ];
                        if ($current && !in_array($current, array_keys($defaults))) {
                            $defaults[$current] = $current;
                        }
                        return array_merge($defaults, ['__other__' => 'Ketik Manual...']);
                    })
                    ->reactive()
                    ->required()
                    ->dehydrated(false)
                    ->afterStateHydrated(function ($state, $set, $get) {
                        $dbVal = $get('achievement_type');
                        if ($dbVal) {
                            $set('achievement_type_select', $dbVal);
                        }
                    })
                    ->afterStateUpdated(function ($state, $set) {
                        if ($state !== '__other__') {
                            $set('achievement_type', $state);
                        }
                    })
                    ->visible(fn ($get) => $get('achievement_type_select') !== '__other__'),

                Forms\Components\TextInput::make('achievement_type_custom')
                    ->label('Pencapaian (Ketik Manual)')
                    ->placeholder('Ketik pencapaian baru')
                    ->reactive()
                    ->required()
                    ->dehydrated(false)
                    ->afterStateUpdated(function ($state, $set) {
                        $set('achievement_type', $state);
                    })
                    ->visible(fn ($get) => $get('achievement_type_select') === '__other__')
                    ->suffixAction(
                        Forms\Components\Actions\Action::make('backToSelectAchievementType')
                            ->icon('heroicon-m-arrow-path')
                            ->action(function ($set) {
                                $set('achievement_type_select', null);
                                $set('achievement_type', null);
                                $set('achievement_type_custom', null);
                            })
                    ),
            ])->columns(3),

            Forms\Components\Section::make('Atlet & Publikasi')->schema([
                Forms\Components\Textarea::make('athlete_names')
                    ->label('Nama Atlet')
                    ->required()
                    ->helperText('Untuk lebih dari satu atlet, pisahkan dengan koma.')
                    ->rows(2)
                    ->columnSpan(2),

                Forms\Components\Toggle::make('is_published')
                    ->label('Dipublikasikan')
                    ->default(true),
            ])->columns(3),

            Forms\Components\Section::make('Status Terjemahan (Otomatis)')
                ->description('Kolom ini akan terisi otomatis saat Anda menyimpan data dalam Bahasa Indonesia.')
                ->collapsible()
                ->collapsed()
                ->icon('heroicon-o-language')
                ->schema([
                    Forms\Components\TextInput::make('tournament_name_en')
                        ->label('Tournament Name (EN)')
                        ->placeholder('Akan terisi otomatis...'),
                    
                    Forms\Components\TextInput::make('tournament_level_en')
                        ->label('Tournament Level (EN)')
                        ->placeholder('Akan terisi otomatis...'),
                    
                    Forms\Components\TextInput::make('discipline_en')
                        ->label('Discipline (EN)')
                        ->placeholder('Akan terisi otomatis...'),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('year')
                    ->label('Tahun')
                    ->sortable()
                    ->badge()
                    ->color('warning'),

                Tables\Columns\TextColumn::make('tournament_name')
                    ->label('Turnamen')
                    ->searchable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('cabang_olahraga')
                    ->label('Disiplin')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Inline Freestyle' => 'primary',
                        'Inline Hockey'    => 'info',
                        'Roller Freestyle' => 'gray',
                        'Scooter'          => 'info',
                        'Skateboard'       => 'success',
                        'Speed'            => 'warning',
                        'Artistic'         => 'danger',
                        default            => 'gray',
                    }),

                Tables\Columns\TextColumn::make('discipline')
                    ->label('Disiplin')
                    ->searchable()
                    ->limit(35),

                Tables\Columns\TextColumn::make('achievement_type')
                    ->label('Pencapaian')
                    ->badge()
                    ->color(fn (string $state): string => match (strtolower($state)) {
                        'winner', 'juara 1', 'gold'          => 'warning',
                        'runner-up', 'juara 2', 'silver'     => 'gray',
                        'bronze', 'juara 3'                  => 'danger',
                        default                              => 'primary',
                    }),

                Tables\Columns\TextColumn::make('athlete_names')
                    ->label('Nama Atlet')
                    ->searchable()
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->athlete_names),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publik')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('year')
                    ->label('Tahun')
                    ->options(fn () => Achievement::query()->orderBy('year', 'desc')->pluck('year', 'year')->unique()->toArray()),

                Tables\Filters\SelectFilter::make('cabang_olahraga')
                    ->label('Disiplin')
                    ->options([
                        'Inline Freestyle' => 'Inline Freestyle',
                        'Inline Hockey'    => 'Inline Hockey',
                        'Roller Freestyle' => 'Roller Freestyle',
                        'Scooter'          => 'Scooter',
                        'Skateboard'       => 'Skateboard',
                        'Speed'            => 'Speed',
                        'Artistic'         => 'Artistic',
                    ]),

                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Status Publikasi'),
            ])
            ->defaultSort('year', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAchievements::route('/'),
            'create' => Pages\CreateAchievement::route('/create'),
            'edit'   => Pages\EditAchievement::route('/{record}/edit'),
        ];
    }
}
