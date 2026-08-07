<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ArticleNews extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'title_en',
        'slug',
        'thumbnail',
        'content',
        'content_en',
        'category_id',
        'author_id',
        'is_featured',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Get title based on current locale with fallback.
     */
    public function getLocalizedTitle(): string
    {
        $locale = app()->getLocale();
        if ($locale === 'en') {
            return $this->title_en ?? $this->name;
        }
        return $this->name;
    }

    /**
     * Get content based on current locale with fallback.
     */
    public function getLocalizedContent(): string
    {
        $locale = app()->getLocale();
        if ($locale === 'en') {
            return $this->content_en ?? $this->content;
        }
        return $this->content;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}
