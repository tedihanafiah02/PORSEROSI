<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LiveStreaming extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_en',
        'slug',
        'thumbnail',
        'platform',
        'embed_url',
        'start_datetime',
        'end_datetime',
        'description',
        'description_en',
        'status',
        'is_active',
        'is_featured',
    ];

    /**
     * Localized Helpers
     */
    public function getLocalizedTitle(): string
    {
        return app()->getLocale() === 'en' ? ($this->title_en ?? $this->title) : $this->title;
    }

    public function getLocalizedDescription(): ?string
    {
        return app()->getLocale() === 'en' ? ($this->description_en ?? $this->description) : $this->description;
    }

    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Auto update statuses of live streams based on time rules.
     */
    public static function autoUpdateStatuses(): void
    {
        $now = \Carbon\Carbon::now();

        // 1. Update upcoming streams to live or finished if start time has passed
        self::where('status', 'upcoming')
            ->where('start_datetime', '<=', $now)
            ->each(function ($stream) use ($now) {
                $endTime = $stream->end_datetime ?: $stream->start_datetime->copy()->addHours(12);
                if ($now >= $endTime) {
                    $stream->update(['status' => 'finished']);
                } else {
                    $stream->update(['status' => 'live']);
                }
            });

        // 2. Update live streams to finished if end time has passed
        self::where('status', 'live')
            ->each(function ($stream) use ($now) {
                $endTime = $stream->end_datetime ?: $stream->start_datetime->copy()->addHours(12);
                if ($now >= $endTime) {
                    $stream->update(['status' => 'finished']);
                }
            });
    }
}
