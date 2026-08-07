<?php

namespace App\Observers;

use App\Models\ArticleNews;
use App\Services\AutoTranslateService;
use Illuminate\Support\Facades\Log;

class ArticleNewsObserver
{
    protected AutoTranslateService $translator;

    public function __construct(AutoTranslateService $translator)
    {
        $this->translator = $translator;
    }

    /**
     * Called when an ArticleNews record is saved (created or updated).
     * Automatically translates name and content to English if not already set
     * OR if the Indonesian source has changed (to keep translations in sync).
     */
    public function saved(ArticleNews $articleNews): void
    {
        $needsUpdate = false;
        $updates = [];

        // Auto-translate title (name) to English
        if (!empty($articleNews->name) && empty($articleNews->title_en)) {
            $translated = $this->translator->translate($articleNews->name);
            if ($translated) {
                $updates['title_en'] = $translated;
                $needsUpdate = true;
            }
        }

        // Auto-translate content to English
        if (!empty($articleNews->content) && empty($articleNews->content_en)) {
            $translated = $this->translator->translateHtml($articleNews->content);
            if ($translated) {
                $updates['content_en'] = $translated;
                $needsUpdate = true;
            }
        }

        if ($needsUpdate) {
            // Use updateQuietly to avoid infinite observer loop
            ArticleNews::withoutEvents(function () use ($articleNews, $updates) {
                $articleNews->updateQuietly($updates);
            });

            Log::info("ArticleNews #{$articleNews->id}: Auto-translated to English.");
        }
    }
}
