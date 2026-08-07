<?php

namespace App\Observers;

use App\Models\Author;
use App\Services\AutoTranslateService;
use Illuminate\Support\Facades\Log;

class AuthorObserver
{
    protected AutoTranslateService $translator;

    public function __construct(AutoTranslateService $translator)
    {
        $this->translator = $translator;
    }

    public function saved(Author $author): void
    {
        $needsUpdate = false;
        $updates = [];

        if (!empty($author->occupation) && empty($author->occupation_en)) {
            $translated = $this->translator->translate($author->occupation);
            if ($translated) {
                $updates['occupation_en'] = $translated;
                $needsUpdate = true;
            }
        }

        if ($needsUpdate) {
            Author::withoutEvents(function () use ($author, $updates) {
                $author->updateQuietly($updates);
            });
            Log::info("Author #{$author->id}: Auto-translated to English.");
        }
    }
}
