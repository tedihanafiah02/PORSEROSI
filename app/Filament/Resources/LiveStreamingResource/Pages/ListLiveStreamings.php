<?php

namespace App\Filament\Resources\LiveStreamingResource\Pages;

use App\Filament\Resources\LiveStreamingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLiveStreamings extends ListRecords
{
    protected static string $resource = LiveStreamingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
