<?php

namespace App\Filament\Resources\RegulationFolderResource\Pages;

use App\Filament\Resources\RegulationFolderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRegulationFolder extends EditRecord
{
    protected static string $resource = RegulationFolderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
