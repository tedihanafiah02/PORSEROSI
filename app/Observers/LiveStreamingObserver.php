<?php

namespace App\Observers;

use App\Models\LiveStreaming;
use App\Services\AutoTranslateService;
use Illuminate\Support\Facades\Log;

class LiveStreamingObserver
{
    protected AutoTranslateService $translator;

    public function __construct(AutoTranslateService $translator)
    {
        $this->translator = $translator;
    }

    public function saved(LiveStreaming $liveStreaming): void
    {
        $needsUpdate = false;
        $updates = [];

        if (!empty($liveStreaming->title) && empty($liveStreaming->title_en)) {
            $translated = $this->translator->translate($liveStreaming->title);
            if ($translated) {
                $updates['title_en'] = $translated;
                $needsUpdate = true;
            }
        }

        if (!empty($liveStreaming->description) && empty($liveStreaming->description_en)) {
            $translated = $this->translator->translate($liveStreaming->description);
            if ($translated) {
                $updates['description_en'] = $translated;
                $needsUpdate = true;
            }
        }

        if ($needsUpdate) {
            LiveStreaming::withoutEvents(function () use ($liveStreaming, $updates) {
                $liveStreaming->updateQuietly($updates);
            });
            Log::info("LiveStreaming #{$liveStreaming->id}: Auto-translated to English.");
        }
    }
}
