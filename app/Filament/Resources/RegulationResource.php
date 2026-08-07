<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegulationResource\Pages;
use App\Filament\Resources\RegulationResource\RelationManagers;
use App\Models\Regulation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegulationResource extends Resource
{
    protected static ?string $model = Regulation::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Peraturan';

    protected static ?string $modelLabel = 'Berkas Peraturan';
    protected static ?string $pluralModelLabel = 'Berkas Peraturan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul Peraturan'),
                Forms\Components\Select::make('regulation_folder_id')
                    ->relationship('folder', 'name')
                    ->label('Folder Peraturan')
                    ->placeholder('Root (Tanpa Folder) / Pilih Folder')
                    ->nullable(),
                Forms\Components\TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(1)
                    ->label('Nomor Urut')
                    ->placeholder('Contoh: 1'),
                Forms\Components\FileUpload::make('file_path')
                    ->required()
                    ->label('File PDF Peraturan')
                    ->directory('regulations')
                    ->acceptedFileTypes(['application/pdf'])
                    ->disk('public')
                    ->columnSpanFull(),

                Forms\Components\Section::make('Status Terjemahan (Otomatis)')
                    ->description('Kolom ini akan terisi otomatis saat Anda menyimpan data dalam Bahasa Indonesia.')
                    ->collapsible()
                    ->collapsed()
                    ->icon('heroicon-o-language')
                    ->schema([
                        Forms\Components\TextInput::make('title_en')
                            ->label('Judul Peraturan (EN)')
                            ->placeholder('Akan terisi otomatis...'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Peraturan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('folder.name')
                    ->label('Folder')
                    ->badge()
                    ->color('info')
                    ->placeholder('Root (Tanpa Folder)')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title_en')
                    ->label('Judul Peraturan (EN)')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Nomor Urut')
                    ->sortable(),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('folder')
                    ->relationship('folder', 'name')
                    ->label('Filter Folder'),
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
            'index' => Pages\ListRegulations::route('/'),
            'create' => Pages\CreateRegulation::route('/create'),
            'edit' => Pages\EditRegulation::route('/{record}/edit'),
        ];
    }
}
