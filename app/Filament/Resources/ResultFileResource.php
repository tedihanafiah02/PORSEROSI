<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResultFileResource\Pages;
use App\Filament\Resources\ResultFileResource\RelationManagers;
use App\Models\ResultFile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class ResultFileResource extends Resource
{
    protected static ?string $model = ResultFile::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-down';

    protected static ?string $navigationGroup = 'Result';

    protected static ?string $modelLabel = 'File Result';
    protected static ?string $pluralModelLabel = 'File Result';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul Berkas'),
                Forms\Components\Select::make('result_folder_id')
                    ->label('Folder Tujuan')
                    ->relationship('folder', 'name')
                    ->required()
                    ->searchable(),
                Forms\Components\FileUpload::make('file_path')
                    ->label('Berkas (PDF / Excel)')
                    ->directory('results')
                    ->disk('public')
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/vnd.ms-excel',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                    ])
                    ->required(),
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
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Berkas')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('folder.name')
                    ->label('Folder')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('file_path')
                    ->label('Tautan File')
                    ->formatStateUsing(fn ($state) => 'Unduh Dokumen')
                    ->color('success')
                    ->url(fn ($record) => Storage::url($record->file_path))
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListResultFiles::route('/'),
            'create' => Pages\CreateResultFile::route('/create'),
            'edit' => Pages\EditResultFile::route('/{record}/edit'),
        ];
    }
}
