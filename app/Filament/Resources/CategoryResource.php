<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-open';
    protected static ?string $navigationLabel = 'Kategori';
    protected static ?string $navigationGroup = 'Berita';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('📂 Data Kategori')
                    ->description('Cukup isi dalam Bahasa Indonesia. Terjemahan Bahasa Inggris dibuat otomatis.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Kategori (Indonesia)')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('icon')
                            ->label('Icon Kategori')
                            ->image()
                            ->required()
                            ->disk('public')
                            ->saveUploadedFileUsing(fn ($file) => compress_to_webp($file, 'category-icons')),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('🌐 Status Terjemahan (Otomatis)')
                    ->description('Kolom ini diisi otomatis oleh sistem. Anda bisa mengedit manual jika perlu koreksi.')
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('name_en')
                            ->label('Category Name (English)')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('icon')
                    ->label('Icon')
                    ->disk('public'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama (ID)')
                    ->searchable(),

                Tables\Columns\TextColumn::make('name_en')
                    ->label('Name (EN)')
                    ->placeholder('—')
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
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
            'index'  => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit'   => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}