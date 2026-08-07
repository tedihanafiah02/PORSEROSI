<?php

namespace App\Filament\Resources\WasitResource\Pages;

use App\Filament\Resources\WasitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWasits extends ListRecords
{
    protected static string $resource = WasitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
