<?php

namespace App\Filament\Resources\ResultFileResource\Pages;

use App\Filament\Resources\ResultFileResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResultFile extends EditRecord
{
    protected static string $resource = ResultFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
