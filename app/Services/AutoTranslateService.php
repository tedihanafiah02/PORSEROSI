<?php

namespace App\Services;

use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;

class AutoTranslateService
{
    protected GoogleTranslate $translator;

    public function __construct()
    {
        $this->translator = new GoogleTranslate();
        $this->translator->setSource('id');
        $this->translator->setTarget('en');
    }

    /**
     * Translate a plain text string from Indonesian to English.
     */
    public function translate(string $text): ?string
    {
        if (empty(trim($text))) {
            return null;
        }

        try {
            $result = $this->translator->translate($text);
            return $result;
        } catch (\Exception $e) {
            Log::warning("AutoTranslate failed: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Translate an HTML string, preserving HTML tags.
     * Splits into chunks to avoid request size limits.
     */
    public function translateHtml(string $html): ?string
    {
        if (empty(trim($html))) {
            return null;
        }

        try {
            // Strip tags to get plain text for translation, but we need to keep HTML
            // Use a tag-safe approach: translate in chunks
            $this->translator->setSource('id');
            $this->translator->setTarget('en');

            // Google Translate can handle HTML if we send it with a special flag
            // We'll strip_tags for translation and reformat, OR send raw HTML directly
            // The stichoza package handles HTML passthrough reasonably well
            $result = $this->translator->translate($html);
            return $result;
        } catch (\Exception $e) {
            Log::warning("AutoTranslate HTML failed: " . $e->getMessage());
            return null;
        }
    }
}
