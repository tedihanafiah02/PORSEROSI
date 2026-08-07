<?php

namespace App\Observers;

use App\Models\RegulationFolder;
use App\Services\AutoTranslateService;
use Illuminate\Support\Facades\Log;

class RegulationFolderObserver
{
    protected AutoTranslateService $translator;

    public function __construct(AutoTranslateService $translator)
    {
        $this->translator = $translator;
    }

    public function saved(RegulationFolder $folder): void
    {
        $needsUpdate = false;
        $updates = [];

        if (!empty($folder->name) && empty($folder->name_en)) {
            $translated = $this->translator->translate($folder->name);
            if ($translated) {
                $updates['name_en'] = $translated;
                $needsUpdate = true;
            }
        }

        if ($needsUpdate) {
            RegulationFolder::withoutEvents(function () use ($folder, $updates) {
                $folder->updateQuietly($updates);
            });
            Log::info("RegulationFolder #{$folder->id}: Auto-translated name to English.");
        }
    }
}
