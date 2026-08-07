<?php

namespace App\Observers;

use App\Models\Officer;
use App\Services\AutoTranslateService;
use Illuminate\Support\Facades\Log;

class OfficerObserver
{
    protected AutoTranslateService $translator;

    public function __construct(AutoTranslateService $translator)
    {
        $this->translator = $translator;
    }

    public function saved(Officer $officer): void
    {
        $needsUpdate = false;
        $updates = [];

        if (!empty($officer->position) && empty($officer->position_en)) {
            $translated = $this->translator->translate($officer->position);
            if ($translated) {
                $updates['position_en'] = $translated;
                $needsUpdate = true;
            }
        }

        if ($needsUpdate) {
            Officer::withoutEvents(function () use ($officer, $updates) {
                $officer->updateQuietly($updates);
            });
            Log::info("Officer #{$officer->id}: Auto-translated position to English.");
        }
    }
}
