<?php

namespace App\Observers;

use App\Models\Achievement;
use App\Services\AutoTranslateService;
use Illuminate\Support\Facades\Log;

class AchievementObserver
{
    protected AutoTranslateService $translator;

    public function __construct(AutoTranslateService $translator)
    {
        $this->translator = $translator;
    }

    public function saved(Achievement $achievement): void
    {
        $needsUpdate = false;
        $updates = [];

        if (!empty($achievement->tournament_name) && empty($achievement->tournament_name_en)) {
            $translated = $this->translator->translate($achievement->tournament_name);
            if ($translated) {
                $updates['tournament_name_en'] = $translated;
                $needsUpdate = true;
            }
        }

        if (!empty($achievement->tournament_level) && empty($achievement->tournament_level_en)) {
            $translated = $this->translator->translate($achievement->tournament_level);
            if ($translated) {
                $updates['tournament_level_en'] = $translated;
                $needsUpdate = true;
            }
        }

        if (!empty($achievement->discipline) && empty($achievement->discipline_en)) {
            $translated = $this->translator->translate($achievement->discipline);
            if ($translated) {
                $updates['discipline_en'] = $translated;
                $needsUpdate = true;
            }
        }

        if ($needsUpdate) {
            Achievement::withoutEvents(function () use ($achievement, $updates) {
                $achievement->updateQuietly($updates);
            });
            Log::info("Achievement #{$achievement->id}: Auto-translated to English.");
        }
    }
}
