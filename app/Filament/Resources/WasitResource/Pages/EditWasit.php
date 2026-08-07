<?php

namespace App\Filament\Resources\WasitResource\Pages;

use App\Filament\Resources\WasitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWasit extends EditRecord
{
    protected static string $resource = WasitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
