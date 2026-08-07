<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleNewsResource\Pages;
use App\Models\ArticleNews;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ArticleNewsResource extends Resource
{
    protected static ?string $model = ArticleNews::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'Berita';
    protected static ?string $navigationGroup = 'Berita';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('📝 Konten Artikel')
                    ->description('Cukup isi dalam Bahasa Indonesia. Terjemahan Bahasa Inggris akan dibuat otomatis oleh sistem.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Judul Artikel')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        RichEditor::make('content')
                            ->label('Konten Artikel')
                            ->required()
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'attachFiles', 'blockquote', 'bold', 'bulletList',
                                'h2', 'h3', 'italic', 'link', 'orderedList',
                                'redo', 'strike', 'underline', 'undo',
                            ]),
                    ]),

                Forms\Components\Section::make('⚙️ Pengaturan')
                    ->schema([
                        Forms\Components\FileUpload::make('thumbnail')
                            ->label('Thumbnail / Cover')
                            ->required()
                            ->image()
                            ->disk('public')
                            ->saveUploadedFileUsing(fn ($file) => compress_to_webp($file, 'article-thumbnails'))
                            ->columnSpanFull(),

                        Forms\Components\Select::make('category_id')
                            ->label('Kategori')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('author_id')
                            ->label('Penulis')
                            ->relationship('author', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('is_featured')
                            ->label('Status Featured')
                            ->options([
                                'featured'     => '⭐ Featured (Unggulan)',
                                'not_featured' => 'Biasa',
                            ])
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('🌐 Status Terjemahan (Otomatis)')
                    ->description('Kolom ini diisi otomatis oleh sistem. Anda bisa mengedit manual jika perlu koreksi.')
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('title_en')
                            ->label('Judul (English) — auto-generated')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('content_en')
                            ->label('Konten (English) — auto-generated')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Cover')
                    ->disk('public'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Judul')
                    ->searchable()
                    ->limit(50),

                Tables\Columns\IconColumn::make('title_en')
                    ->label('🌐 EN')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-clock')
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->tooltip(fn ($record) => $record->title_en ? 'Terjemahan tersedia' : 'Belum diterjemahkan')
                    ->getStateUsing(fn ($record) => !empty($record->title_en)),

                Tables\Columns\TextColumn::make('is_featured')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'featured'     => 'success',
                        'not_featured' => 'gray',
                        default        => 'gray',
                    }),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
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
            'index'  => Pages\ListArticleNews::route('/'),
            'create' => Pages\CreateArticleNews::route('/create'),
            'edit'   => Pages\EditArticleNews::route('/{record}/edit'),
        ];
    }
}
