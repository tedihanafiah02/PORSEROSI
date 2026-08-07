<?php

namespace App\Observers;

use App\Models\ResultFile;
use App\Services\AutoTranslateService;

class ResultFileObserver
{
    /**
     * Handle the ResultFile "saving" event.
     */
    public function saving(ResultFile $file): void
    {
        if ($file->isDirty('title') && empty($file->title_en)) {
            $file->title_en = AutoTranslateService::translate($file->title, 'en');
        }
    }
}
