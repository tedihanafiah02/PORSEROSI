<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SeoSetting extends Model
{
    protected $fillable = ['key', 'value', 'group', 'label', 'type'];

    /**
     * Get SEO setting value by key with optional default.
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        return Cache::remember("seo_setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting?->value ?? $default;
        });
    }

    /**
     * Set SEO setting value by key.
     */
    public static function set(string $key, ?string $value): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
        Cache::forget("seo_setting_{$key}");
    }

    /**
     * Get all settings for a specific group.
     */
    public static function getGroup(string $group): array
    {
        return Cache::remember("seo_group_{$group}", 3600, function () use ($group) {
            return static::where('group', $group)
                ->pluck('value', 'key')
                ->toArray();
        });
    }

    /**
     * Clear all SEO setting caches.
     */
    public static function clearCache(): void
    {
        $keys = static::pluck('key');
        foreach ($keys as $key) {
            Cache::forget("seo_setting_{$key}");
        }
        foreach (['general', 'social', 'analytics', 'schema'] as $group) {
            Cache::forget("seo_group_{$group}");
        }
    }
}
