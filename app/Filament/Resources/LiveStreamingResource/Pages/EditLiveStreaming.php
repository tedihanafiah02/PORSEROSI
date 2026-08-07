<?php

namespace App\Filament\Resources\LiveStreamingResource\Pages;

use App\Filament\Resources\LiveStreamingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLiveStreaming extends EditRecord
{
    protected static string $resource = LiveStreamingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
