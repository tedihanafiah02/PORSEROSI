<?php

namespace App\Filament\Resources\RegulationFolderResource\Pages;

use App\Filament\Resources\RegulationFolderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRegulationFolders extends ListRecords
{
    protected static string $resource = RegulationFolderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
