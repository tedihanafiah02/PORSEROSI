<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficerResource\Pages;
use App\Filament\Resources\OfficerResource\RelationManagers;
use App\Models\Officer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfficerResource extends Resource
{
    protected static ?string $model = Officer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $navigationGroup = 'Tentang';

    protected static ?string $modelLabel = 'Pengurus';
    protected static ?string $pluralModelLabel = 'Struktur Organisasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Pengurus'),
                Forms\Components\TextInput::make('position')
                    ->required()
                    ->maxLength(255)
                    ->label('Jabatan (ID)')
                    ->placeholder('Contoh: Ketua Harian'),
                Forms\Components\TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(1)
                    ->label('Nomor Urut')
                    ->placeholder('Contoh: 1'),
                Forms\Components\FileUpload::make('photo_path')
                    ->label('Foto Profil')
                    ->directory('officers') // Simpan foto di folder 'storage/app/public/officers'
                    ->image()
                    ->disk('public')
                    ->saveUploadedFileUsing(fn ($file) => compress_to_webp($file, 'officers'))
                    ->columnSpanFull(),

                Forms\Components\Section::make('Status Terjemahan (Otomatis)')
                    ->description('Kolom ini akan terisi otomatis saat Anda menyimpan data dalam Bahasa Indonesia.')
                    ->collapsible()
                    ->collapsed()
                    ->icon('heroicon-o-language')
                    ->schema([
                        Forms\Components\TextInput::make('position_en')
                            ->label('Jabatan (EN)')
                            ->placeholder('Akan terisi otomatis...'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo_path')
                    ->label('Foto')
                    ->disk('public')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('position')
                    ->label('Jabatan (ID)')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('position_en')
                    ->label('Jabatan (EN)')
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
            'index' => Pages\ListOfficers::route('/'),
            'create' => Pages\CreateOfficer::route('/create'),
            'edit' => Pages\EditOfficer::route('/{record}/edit'),
        ];
    }
}
