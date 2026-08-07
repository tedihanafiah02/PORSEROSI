<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FooterBrandResource\Pages;
use App\Filament\Resources\FooterBrandResource\RelationManagers;
use App\Models\FooterBrand;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FooterBrandResource extends Resource
{
    protected static ?string $model = FooterBrand::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    
    protected static ?string $navigationGroup = 'Mitra & Iklan';
    
    protected static ?string $navigationLabel = 'Partner Brand Footer';

    protected static ?string $modelLabel = 'Partner Brand Footer';

    protected static ?string $pluralModelLabel = 'Partner Brand Footer';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nama Brand')
                    ->maxLength(255),
                Forms\Components\TextInput::make('link')
                    ->label('Link / URL Website')
                    ->url()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Brand')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('link')
                    ->label('Link Website')
                    ->limit(50),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
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
            'index' => Pages\ListFooterBrands::route('/'),
            'create' => Pages\CreateFooterBrand::route('/create'),
            'edit' => Pages\EditFooterBrand::route('/{record}/edit'),
        ];
    }
}
