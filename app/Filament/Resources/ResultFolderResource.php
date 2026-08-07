<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResultFolderResource\Pages;
use App\Filament\Resources\ResultFolderResource\RelationManagers;
use App\Models\ResultFolder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResultFolderResource extends Resource
{
    protected static ?string $model = ResultFolder::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationGroup = 'Result';

    protected static ?string $modelLabel = 'Folder Result';
    protected static ?string $pluralModelLabel = 'Folder Result';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Folder'),
                Forms\Components\Select::make('parent_id')
                    ->label('Induk Folder')
                    ->options(fn ($record) => ResultFolder::query()
                        ->when($record, fn ($query) => $query->where('id', '!=', $record->id))
                        ->pluck('name', 'id')
                        ->toArray()
                    )
                    ->nullable()
                    ->searchable(),
                Forms\Components\TextInput::make('slug')
                    ->maxLength(255)
                    ->label('Slug Kategori (Hanya Disiplin Utama)')
                    ->placeholder('Contoh: speed, inline-freestyle'),
                Forms\Components\TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(1)
                    ->label('Nomor Urut'),
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
                Tables\Columns\TextColumn::make('parent.name')
                    ->label('Induk Folder')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug'),
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
            'index' => Pages\ListResultFolders::route('/'),
            'create' => Pages\CreateResultFolder::route('/create'),
            'edit' => Pages\EditResultFolder::route('/{record}/edit'),
        ];
    }
}
