<?php

namespace App\Observers;

use App\Models\Panduan;
use App\Services\AutoTranslateService;
use Illuminate\Support\Facades\Log;

class PanduanObserver
{
    protected AutoTranslateService $translator;

    public function __construct(AutoTranslateService $translator)
    {
        $this->translator = $translator;
    }

    public function saved(Panduan $panduan): void
    {
        $needsUpdate = false;
        $updates = [];

        if (!empty($panduan->title) && empty($panduan->title_en)) {
            $translated = $this->translator->translate($panduan->title);
            if ($translated) {
                $updates['title_en'] = $translated;
                $needsUpdate = true;
            }
        }

        if (!empty($panduan->description) && empty($panduan->description_en)) {
            $translated = $this->translator->translate($panduan->description);
            if ($translated) {
                $updates['description_en'] = $translated;
                $needsUpdate = true;
            }
        }

        if ($needsUpdate) {
            Panduan::withoutEvents(function () use ($panduan, $updates) {
                $panduan->updateQuietly($updates);
            });

            Log::info("Panduan #{$panduan->id}: Auto-translated to English.");
        }
    }
}
