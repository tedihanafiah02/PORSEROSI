<?php

namespace App\Observers;

use App\Models\Partner;
use App\Services\AutoTranslateService;
use Illuminate\Support\Facades\Log;

class PartnerObserver
{
    protected AutoTranslateService $translator;

    public function __construct(AutoTranslateService $translator)
    {
        $this->translator = $translator;
    }

    public function saved(Partner $partner): void
    {
        $needsUpdate = false;
        $updates = [];

        if (!empty($partner->alt_text) && empty($partner->alt_text_en)) {
            $translated = $this->translator->translate($partner->alt_text);
            if ($translated) {
                $updates['alt_text_en'] = $translated;
                $needsUpdate = true;
            }
        }

        if (!empty($partner->description) && empty($partner->description_en)) {
            $translated = $this->translator->translate($partner->description);
            if ($translated) {
                $updates['description_en'] = $translated;
                $needsUpdate = true;
            }
        }

        if ($needsUpdate) {
            Partner::withoutEvents(function () use ($partner, $updates) {
                $partner->updateQuietly($updates);
            });
            Log::info("Partner #{$partner->id}: Auto-translated fields to English.");
        }
    }
}
