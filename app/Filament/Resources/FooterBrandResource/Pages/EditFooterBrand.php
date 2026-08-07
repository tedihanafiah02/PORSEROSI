<?php

namespace App\Filament\Resources\FooterBrandResource\Pages;

use App\Filament\Resources\FooterBrandResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFooterBrand extends EditRecord
{
    protected static string $resource = FooterBrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
