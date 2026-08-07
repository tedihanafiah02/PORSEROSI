<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProvinsiResource\Pages;
use App\Filament\Resources\ProvinsiResource\RelationManagers;
use App\Models\Provinsi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProvinsiResource extends Resource
{
    protected static ?string $model = Provinsi::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationGroup = 'Data';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Pengprov';
    protected static ?string $pluralModelLabel = 'Data Pengprov';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Provinsi'),
                Forms\Components\TextInput::make('leader')
                    ->required()
                    ->maxLength(255)
                    ->label('Ketua Pengprov'),
                Forms\Components\TextInput::make('period')
                    ->required()
                    ->maxLength(255)
                    ->label('Masa Jabatan')
                    ->placeholder('Contoh: 2024 - 2028'),
                Forms\Components\TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(1)
                    ->label('Nomor Urut'),
                Forms\Components\TagsInput::make('cities')
                    ->required()
                    ->label('Kabupaten & Kota Under Provinsi')
                    ->placeholder('Ketik nama lalu tekan Enter')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Provinsi')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('leader')
                    ->label('Ketua Pengprov')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('period')
                    ->label('Masa Jabatan'),
                Tables\Columns\TextColumn::make('order')
                    ->label('Nomor Urut')
                    ->sortable(),
            ])
            ->defaultSort('order', 'asc')
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
            'index' => Pages\ListProvinsis::route('/'),
            'create' => Pages\CreateProvinsi::route('/create'),
            'edit' => Pages\EditProvinsi::route('/{record}/edit'),
        ];
    }
}
