<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PanduanResource\Pages;
use App\Models\Panduan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class PanduanResource extends Resource
{
    protected static ?string $model = Panduan::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Peraturan';
    protected static ?string $pluralModelLabel = 'Panduan & Dokumen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('📄 Data Dokumen')
                    ->description('Isi dalam Bahasa Indonesia. Terjemahan Inggris otomatis dibuat oleh sistem.')
                    ->schema([
                        TextInput::make('title')
                            ->label('Nama Dokumen (Indonesia)')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Deskripsi Singkat (Indonesia)')
                            ->rows(3)
                            ->columnSpanFull(),

                        FileUpload::make('image')
                            ->label('Gambar Sampul / Thumbnail')
                            ->image()
                            ->directory('panduans/images')
                            ->disk('public')
                            ->saveUploadedFileUsing(fn ($file) => compress_to_webp($file, 'panduans/images'))
                            ->columnSpanFull(),

                        FileUpload::make('file_path')
                            ->label('File Dokumen (PDF, Word, Excel)')
                            ->acceptedFileTypes([
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'application/vnd.ms-excel',
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            ])
                            ->directory('panduans/files')
                            ->disk('public')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('🌐 Status Terjemahan (Otomatis)')
                    ->description('Kolom ini diisi otomatis oleh sistem. Anda bisa mengedit manual jika perlu koreksi.')
                    ->collapsed()
                    ->schema([
                        TextInput::make('title_en')
                            ->label('Nama Dokumen (English)')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description_en')
                            ->label('Deskripsi Singkat (English)')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('Sampul')->disk('public'),

                TextColumn::make('title')
                    ->label('Nama Dokumen')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                Tables\Columns\IconColumn::make('title_en')
                    ->label('🌐 EN')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-clock')
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->getStateUsing(fn ($record) => !empty($record->title_en)),

                TextColumn::make('created_at')
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
            'index'  => Pages\ListPanduans::route('/'),
            'create' => Pages\CreatePanduan::route('/create'),
            'edit'   => Pages\EditPanduan::route('/{record}/edit'),
        ];
    }
}
