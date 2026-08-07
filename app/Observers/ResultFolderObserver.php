<?php

namespace App\Observers;

use App\Models\ResultFolder;
use App\Services\AutoTranslateService;

class ResultFolderObserver
{
    /**
     * Handle the ResultFolder "saving" event.
     */
    public function saving(ResultFolder $folder): void
    {
        if ($folder->isDirty('name') && empty($folder->name_en)) {
            $folder->name_en = AutoTranslateService::translate($folder->name, 'en');
        }
    }
}
