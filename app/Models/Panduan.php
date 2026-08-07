<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panduan extends Model
{
    protected $fillable = [
        'title',
        'title_en',
        'image',
        'description',
        'description_en',
        'file_path',
    ];

    /**
     * Get title based on current locale with fallback.
     */
    public function getLocalizedTitle(): string
    {
        $locale = app()->getLocale();
        if ($locale === 'en') {
            return $this->title_en ?? $this->title;
        }
        return $this->title;
    }

    /**
     * Get description based on current locale with fallback.
     */
    public function getLocalizedDescription(): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'en') {
            return $this->description_en ?? $this->description;
        }
        return $this->description;
    }
}
