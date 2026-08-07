<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerAdvertisement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'link',
        'is_active',
        'type',
        'thumbnail',
        'show_on_all_pages',
        'pages',
        'start_date',
        'end_date',
        'order',
        'slide_duration',
    ];

    protected $casts = [
        'show_on_all_pages' => 'boolean',
        'pages' => 'array',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'order' => 'integer',
        'slide_duration' => 'integer',
    ];

    public static function getActiveBannersForPage(string $page)
    {
        // Automatically deactivate banners whose end_date has passed in the database
        self::where('is_active', 'active')
            ->whereNotNull('end_date')
            ->where('end_date', '<', now())
            ->update(['is_active' => 'not_active']);

        return self::where('is_active', 'active')
            ->where(function ($query) {
                $query->whereNull('start_date')
                      ->orWhere('start_date', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('end_date')
                      ->orWhere('end_date', '>=', now());
            })
            ->orderBy('order', 'asc')
            ->get()
            ->filter(function ($banner) use ($page) {
                if ($banner->show_on_all_pages) {
                    return true;
                }
                return is_array($banner->pages) && in_array($page, $banner->pages);
            });
    }
}
