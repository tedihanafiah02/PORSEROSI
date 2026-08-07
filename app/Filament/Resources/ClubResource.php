<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClubResource\Pages;
use App\Filament\Resources\ClubResource\RelationManagers;
use App\Models\Club;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClubResource extends Resource
{
    protected static ?string $model = Club::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';

    protected static ?string $navigationGroup = 'Data';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Klub';
    protected static ?string $pluralModelLabel = 'Data Klub';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Klub'),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->maxLength(255)
                    ->label('Kota / Kabupaten'),
                Forms\Components\TextInput::make('province')
                    ->required()
                    ->maxLength(255)
                    ->label('Provinsi'),
                Forms\Components\TextInput::make('discipline')
                    ->required()
                    ->maxLength(255)
                    ->label('Disiplin Olahraga')
                    ->placeholder('Contoh: Speed, Freestyle, Skateboard'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Klub')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city')
                    ->label('Kota / Kabupaten')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('province')
                    ->label('Provinsi')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('discipline')
                    ->label('Disiplin')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('province')
                    ->options(fn() => Club::query()->pluck('province', 'province')->unique()->toArray())
                    ->label('Filter Provinsi'),
            ])
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClubs::route('/'),
            'create' => Pages\CreateClub::route('/create'),
            'edit' => Pages\EditClub::route('/{record}/edit'),
        ];
    }
}
