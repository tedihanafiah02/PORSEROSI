<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Author extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'occupation',
        'occupation_en',
        'avatar',
        'slug',
    ];

    /**
     * Get occupation based on locale.
     */
    public function getLocalizedOccupation(): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'en') {
            return $this->occupation_en ?? $this->occupation;
        }
        return $this->occupation;
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function news(): HasMany
    {
        return $this->hasMany(ArticleNews::class);
    }

}
