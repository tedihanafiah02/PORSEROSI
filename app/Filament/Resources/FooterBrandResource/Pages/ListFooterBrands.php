<?php

namespace App\Filament\Resources\FooterBrandResource\Pages;

use App\Filament\Resources\FooterBrandResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFooterBrands extends ListRecords
{
    protected static string $resource = FooterBrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
