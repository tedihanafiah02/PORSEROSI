<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Filament\Resources\PartnerResource\RelationManagers;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Mitra & Iklan';

    protected static ?string $modelLabel = 'Partner';
    protected static ?string $pluralModelLabel = 'Partner';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required()->label('Nama Partner'),
            Forms\Components\TextInput::make('link')->label('Link/URL Website')->url()->nullable(),
            Forms\Components\TextInput::make('contact_name')->label('Nama Kontak/PJ')->nullable(),
            Forms\Components\TextInput::make('whatsapp_number')->label('Nomor WhatsApp (Contoh: 628123456789)')->nullable(),
            Forms\Components\Select::make('status')
                ->label('Status Partner')
                ->options([
                    'active' => 'Aktif (Tampil di Website)',
                    'pending' => 'Pending (Butuh Persetujuan)',
                ])
                ->default('active')
                ->required(),
            Forms\Components\Select::make('row')
                ->label('Posisi Baris (Slider Beranda)')
                ->options([
                    1 => 'Baris 1 (Jalan ke Kanan)',
                    2 => 'Baris 2 (Jalan ke Kiri)',
                ])
                ->default(1)
                ->required(),
            Forms\Components\Textarea::make('description')
                ->label('Deskripsi Partner')
                ->rows(3)
                ->nullable()
                ->columnSpanFull(),
            Forms\Components\FileUpload::make('logo_path')
                ->required()
                ->label('Logo Partner')
                ->directory('partners')
                ->image()
                ->disk('public')
                ->saveUploadedFileUsing(fn ($file) => compress_to_webp($file, 'partners'))
                ->columnSpanFull(),
            Forms\Components\TextInput::make('alt_text')->label('Teks Alternatif')->nullable()->columnSpanFull(),

            Forms\Components\Section::make('Status Terjemahan (Otomatis)')
                ->description('Kolom ini akan terisi otomatis saat Anda menyimpan data dalam Bahasa Indonesia.')
                ->collapsible()
                ->collapsed()
                ->icon('heroicon-o-language')
                ->schema([
                    Forms\Components\TextInput::make('alt_text_en')
                        ->label('Alt Text (EN)')
                        ->placeholder('Akan terisi otomatis...'),
                    Forms\Components\Textarea::make('description_en')
                        ->label('Description (EN)')
                        ->rows(3)
                        ->placeholder('Akan terisi otomatis...'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo_path')->label('Logo')->disk('public'),
                Tables\Columns\TextColumn::make('name')->label('Nama Partner')->searchable()
                    ->description(fn ($record) => $record->contact_name ? "Kontak: {$record->contact_name} ({$record->whatsapp_number})" : null),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'pending' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('row')
                    ->label('Baris Slider')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '1' => 'success',
                        '2' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pendaftar Google')
                    ->placeholder('Dibuat oleh Admin'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Aktif',
                        'pending' => 'Pending',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
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
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}