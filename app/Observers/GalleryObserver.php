<?php

namespace App\Observers;

use App\Models\Gallery;
use App\Services\AutoTranslateService;
use Illuminate\Support\Facades\Log;

class GalleryObserver
{
    protected AutoTranslateService $translator;

    public function __construct(AutoTranslateService $translator)
    {
        $this->translator = $translator;
    }

    public function saved(Gallery $gallery): void
    {
        $needsUpdate = false;
        $updates = [];

        if (!empty($gallery->alt_text) && empty($gallery->alt_text_en)) {
            $translated = $this->translator->translate($gallery->alt_text);
            if ($translated) {
                $updates['alt_text_en'] = $translated;
                $needsUpdate = true;
            }
        }

        if ($needsUpdate) {
            Gallery::withoutEvents(function () use ($gallery, $updates) {
                $gallery->updateQuietly($updates);
            });
            Log::info("Gallery #{$gallery->id}: Auto-translated to English.");
        }
    }
}
