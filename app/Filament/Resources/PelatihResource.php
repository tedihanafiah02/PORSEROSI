<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelatihResource\Pages;
use App\Models\WasitPelatih;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class PelatihResource extends Resource
{
    protected static ?string $model = WasitPelatih::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Data';
    protected static ?int $navigationSort = 4;
    protected static ?string $modelLabel = 'Pelatih';
    protected static ?string $pluralModelLabel = 'Data Pelatih';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('kategori', 'Pelatih');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pribadi')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('nama_lengkap')
                                ->label('Nama Lengkap')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('nik')
                                ->label('NIK KTP')
                                ->required()
                                ->maxLength(20),
                            TextInput::make('tempat_lahir')
                                ->label('Tempat Lahir')
                                ->required()
                                ->maxLength(255),
                            DatePicker::make('tanggal_lahir')
                                ->label('Tanggal Lahir')
                                ->required(),
                            Select::make('jenis_kelamin')
                                ->label('Jenis Kelamin')
                                ->options([
                                    'Laki-laki' => 'Laki-laki',
                                    'Perempuan' => 'Perempuan',
                                ])
                                ->required(),
                            TextInput::make('no_wa')
                                ->label('No. WhatsApp')
                                ->required()
                                ->tel()
                                ->maxLength(255),
                            TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->maxLength(255),
                        ]),
                    ]),

                Section::make('Informasi Kedaerahan & Klub')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('provinsi')
                                ->label('Provinsi (Pengprov)')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('kabupaten_kota')
                                ->label('Kabupaten/Kota')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('klub_asal')
                                ->label('Klub Asal')
                                ->required()
                                ->maxLength(255),
                        ]),
                    ]),

                Section::make('Kategori & Lisensi')
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('kategori')
                                ->label('Kategori')
                                ->options([
                                    'Pelatih' => 'Pelatih',
                                ])
                                ->default('Pelatih')
                                ->disabled()
                                ->dehydrated()
                                ->required(),
                            Select::make('lisensi')
                                ->label('Lisensi Tertinggi')
                                ->options([
                                    'Daerah' => 'Daerah',
                                    'Nasional' => 'Nasional',
                                    'Internasional' => 'Internasional',
                                    'Belum Ada' => 'Belum Ada',
                                ])
                                ->required(),
                            TextInput::make('disiplin')
                                ->label('Disiplin Olahraga')
                                ->placeholder('Contoh: Speed, Freestyle, Skateboard')
                                ->maxLength(255),
                            Select::make('status')
                                ->label('Status Pendaftaran')
                                ->options([
                                    'pending' => 'Data Diterima, Sedang Diproses',
                                    'selesai' => 'Pendaftaran Berhasil',
                                    'ditolak' => 'Data Ditolak',
                                ])
                                ->required()
                                ->default('pending'),
                        ]),
                    ]),

                Section::make('Dokumen Pendukung')
                    ->schema([
                        Grid::make(2)->schema([
                            FileUpload::make('foto_path')
                                ->label('Pas Foto')
                                ->image()
                                ->directory('wasit_pelatih/foto')
                                ->disk('public')
                                ->saveUploadedFileUsing(fn ($file) => compress_to_webp($file, 'wasit_pelatih/foto'))
                                ->required(),
                            FileUpload::make('sertifikat_path')
                                ->label('Sertifikat Lisensi (Opsional)')
                                ->directory('wasit_pelatih/sertifikat')
                                ->disk('public')
                                ->saveUploadedFileUsing(fn ($file) => compress_to_webp($file, 'wasit_pelatih/sertifikat'))
                                ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png']),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto_path')
                    ->label('Foto')
                    ->circular()
                    ->disk('public'),
                TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable(),
                TextColumn::make('provinsi')
                    ->label('Provinsi')
                    ->searchable(),
                TextColumn::make('klub_asal')
                    ->label('Klub')
                    ->searchable(),
                TextColumn::make('lisensi')
                    ->label('Lisensi')
                    ->searchable(),
                TextColumn::make('disiplin')
                    ->label('Disiplin')
                    ->searchable(),
                TextColumn::make('no_wa')
                    ->label('No. WA')
                    ->searchable(),
                TextColumn::make('sertifikat_path')
                    ->label('Sertifikat')
                    ->formatStateUsing(fn ($state) => $state ? 'Lihat Dokumen' : 'Tidak Ada')
                    ->color(fn ($state) => $state ? 'success' : 'gray')
                    ->url(fn ($record) => $record->sertifikat_path ? get_image_url($record->sertifikat_path) : null)
                    ->openUrlInNewTab(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'selesai' => 'success',
                        'ditolak' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Data Diterima, Sedang Diproses',
                        'selesai' => 'Pendaftaran Berhasil',
                        'ditolak' => 'Data Ditolak',
                    })
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Tgl Daftar')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
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
            'index' => Pages\ListPelatihs::route('/'),
            'create' => Pages\CreatePelatih::route('/create'),
            'edit' => Pages\EditPelatih::route('/{record}/edit'),
        ];
    }
}
