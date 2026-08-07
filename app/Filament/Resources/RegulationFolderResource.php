<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegulationFolderResource\Pages;
use App\Filament\Resources\RegulationFolderResource\RelationManagers;
use App\Models\RegulationFolder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegulationFolderResource extends Resource
{
    protected static ?string $model = RegulationFolder::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationGroup = 'Peraturan';

    protected static ?string $modelLabel = 'Folder Peraturan';
    protected static ?string $pluralModelLabel = 'Folder Peraturan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Folder'),
                Forms\Components\TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(1)
                    ->label('Nomor Urut')
                    ->placeholder('Contoh: 1'),

                Forms\Components\Section::make('Status Terjemahan (Otomatis)')
                    ->description('Kolom ini akan terisi otomatis saat Anda menyimpan data dalam Bahasa Indonesia.')
                    ->collapsible()
                    ->collapsed()
                    ->icon('heroicon-o-language')
                    ->schema([
                        Forms\Components\TextInput::make('name_en')
                            ->label('Nama Folder (EN)')
                            ->placeholder('Akan terisi otomatis...'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Folder')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name_en')
                    ->label('Nama Folder (EN)')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListRegulationFolders::route('/'),
            'create' => Pages\CreateRegulationFolder::route('/create'),
            'edit' => Pages\EditRegulationFolder::route('/{record}/edit'),
        ];
    }
}
