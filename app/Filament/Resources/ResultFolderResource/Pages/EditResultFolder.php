<?php

namespace App\Filament\Resources\ResultFolderResource\Pages;

use App\Filament\Resources\ResultFolderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResultFolder extends EditRecord
{
    protected static string $resource = ResultFolderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
