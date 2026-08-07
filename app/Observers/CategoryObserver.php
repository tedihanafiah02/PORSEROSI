<?php

namespace App\Observers;

use App\Models\Category;
use App\Services\AutoTranslateService;
use Illuminate\Support\Facades\Log;

class CategoryObserver
{
    protected AutoTranslateService $translator;

    public function __construct(AutoTranslateService $translator)
    {
        $this->translator = $translator;
    }

    public function saved(Category $category): void
    {
        if (!empty($category->name) && empty($category->name_en)) {
            $translated = $this->translator->translate($category->name);
            if ($translated) {
                Category::withoutEvents(function () use ($category, $translated) {
                    $category->updateQuietly(['name_en' => $translated]);
                });

                Log::info("Category #{$category->id}: Auto-translated name to English: '{$translated}'");
            }
        }
    }
}
