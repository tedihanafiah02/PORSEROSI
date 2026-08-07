<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Filament\Resources\GalleryResource\RelationManagers;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Galeri & Media';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\FileUpload::make('image_path')
                ->label('Image')
                ->required()
                ->directory('gallery-images') // Folder penyimpanan gambar
                ->image() // Hanya menerima file gambar
                ->maxSize(5048) // Batas ukuran file (2MB)
                ->disk('public') // Gunakan disk 'public'
                ->saveUploadedFileUsing(fn ($file) => compress_to_webp($file, 'gallery-images')),
            Forms\Components\Select::make('gallery_album_id')
                ->label('Folder / Album')
                ->relationship('album', 'name')
                ->required()
                ->searchable()
                ->preload(),
            Forms\Components\TextInput::make('alt_text')->label('Alt Text')->nullable(),

            Forms\Components\Section::make('Status Terjemahan (Otomatis)')
                ->description('Kolom ini akan terisi otomatis saat Anda menyimpan data dalam Bahasa Indonesia.')
                ->collapsible()
                ->collapsed()
                ->icon('heroicon-o-language')
                ->schema([
                    Forms\Components\TextInput::make('alt_text_en')
                        ->label('Alt Text (EN)')
                        ->placeholder('Akan terisi otomatis...'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')->label('Image')->disk('public'),
                Tables\Columns\TextColumn::make('album.name')->label('Folder / Album')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('alt_text')->label('Alt Text'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('gallery_album_id')
                    ->label('Folder / Album')
                    ->relationship('album', 'name'),
            ])

            ->actions([
                Tables\Actions\EditAction::make(), // Tombol Edit
                Tables\Actions\DeleteAction::make(), // Tombol Delete
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(), // Tombol Delete untuk multiple records
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
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}