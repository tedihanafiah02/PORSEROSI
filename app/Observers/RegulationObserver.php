<?php

namespace App\Observers;

use App\Models\Regulation;
use App\Services\AutoTranslateService;
use Illuminate\Support\Facades\Log;

class RegulationObserver
{
    protected AutoTranslateService $translator;

    public function __construct(AutoTranslateService $translator)
    {
        $this->translator = $translator;
    }

    public function saved(Regulation $regulation): void
    {
        $needsUpdate = false;
        $updates = [];

        if (!empty($regulation->title) && empty($regulation->title_en)) {
            $translated = $this->translator->translate($regulation->title);
            if ($translated) {
                $updates['title_en'] = $translated;
                $needsUpdate = true;
            }
        }

        if ($needsUpdate) {
            Regulation::withoutEvents(function () use ($regulation, $updates) {
                $regulation->updateQuietly($updates);
            });
            Log::info("Regulation #{$regulation->id}: Auto-translated title to English.");
        }
    }
}
