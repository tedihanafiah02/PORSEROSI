<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($event) {
            if ($event->start_date) {
                $start = Carbon::parse($event->start_date)->startOfDay();
                $end = $event->end_date ? Carbon::parse($event->end_date)->startOfDay() : $start;
                $event->duration_days = $start->diffInDays($end) + 1;
            } else {
                $event->duration_days = 1;
            }
        });
    }

    protected $fillable = [
        'name',
        'name_en',
        'slug',
        'start_date',
        'end_date',
        'venue',
        'venue_en',
        'city',
        'city_en',
        'country',
        'country_en',
        'organizer',
        'organizer_en',
        'description',
        'description_en',
        'logo',
        'category',
        'sport_type',
        'status',
        'registration_url',
        'contact_info',
        'is_published',
        'is_registration_open',
        'duration_days',
        'scale',
        'discipline',
    ];

    /**
     * Localized Helpers
     */
    public function getLocalizedName(): string
    {
        return app()->getLocale() === 'en' ? ($this->name_en ?? $this->name) : $this->name;
    }

    public function getLocalizedVenue(): ?string
    {
        return app()->getLocale() === 'en' ? ($this->venue_en ?? $this->venue) : $this->venue;
    }

    public function getLocalizedCity(): ?string
    {
        return app()->getLocale() === 'en' ? ($this->city_en ?? $this->city) : $this->city;
    }

    public function getLocalizedDescription(): ?string
    {
        return app()->getLocale() === 'en' ? ($this->description_en ?? $this->description) : $this->description;
    }

    public function getLocalizedOrganizer(): ?string
    {
        return app()->getLocale() === 'en' ? ($this->organizer_en ?? $this->organizer) : $this->organizer;
    }

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_published' => 'boolean',
    ];

    /**
     * Auto-generate slug from name
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Auto-update event statuses based on current date
     */
    public static function autoUpdateStatuses()
    {
        $today = \Carbon\Carbon::today();

        // 1. Event yang sudah berakhir (end_date < today, atau start_date < today jika end_date null) -> status = completed
        self::where('status', '!=', 'completed')
            ->where(function($q) use ($today) {
                $q->where(function($q2) use ($today) {
                    $q2->whereNotNull('end_date')
                       ->where('end_date', '<', $today);
                })->orWhere(function($q2) use ($today) {
                    $q2->whereNull('end_date')
                       ->where('start_date', '<', $today);
                });
            })
            ->update(['status' => 'completed']);

        // 2. Event yang sudah mulai (start_date <= today) tapi statusnya masih upcoming -> status = ongoing
        self::where('status', 'upcoming')
            ->where('start_date', '<=', $today)
            ->update(['status' => 'ongoing']);
    }

    /**
     * Scope: hanya event yang dipublish
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope: event yang akan datang
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', Carbon::today());
    }

    /**
     * Scope: event berdasarkan bulan & tahun
     */
    public function scopeInMonth($query, $month, $year)
    {
        return $query->whereMonth('start_date', $month)->whereYear('start_date', $year);
    }

    /**
     * Scope: filter berdasarkan cabang olahraga utama
     */
    public function scopeByCabor($query, $cabor)
    {
        if ($cabor && $cabor !== 'semua') {
            return $query->where('sport_type', $cabor);
        }
        return $query;
    }

    /**
     * Format tanggal event untuk tampilan
     */
    public function getFormattedDateAttribute(): string
    {
        $start = $this->start_date->translatedFormat('l, d F Y');

        if ($this->end_date && !$this->start_date->equalTo($this->end_date)) {
            $end = $this->end_date->translatedFormat('l, d F Y');
            return "{$start} – {$end}";
        }

        return $start;
    }

    /**
     * Label kategori event
     */
    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'kompetisi' => __('messages.event_cat_competition'),
            'pelatihan' => __('messages.event_cat_training'),
            'seleksi'   => __('messages.event_cat_selection'),
            'exhibition'=> __('messages.event_cat_exhibition'),
            'seminar'   => __('messages.event_cat_seminar'),
            default     => ucfirst($this->category),
        };
    }

    /**
     * Label tipe olahraga
     */
    public function getSportTypeLabelAttribute(): string
    {
        return match ($this->sport_type) {
            'inline-freestyle' => 'Inline Freestyle',
            'inline-hockey'    => 'Inline Hockey',
            'roller-freestyle' => 'Roller Freestyle',
            'scooter'          => 'Scooter',
            'skateboard'       => 'Skateboard',
            'speed'            => 'Speed',
            'artistic'         => 'Artistic',
            'all'              => __('messages.all_sports'),
            default            => ucfirst($this->sport_type),
        };
    }

    /**
     * Status badge color
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'upcoming' => 'blue',
            'ongoing' => 'green',
            'completed' => 'gray',
            'cancelled' => 'red',
            default => 'gray',
        };
    }

    /**
     * Status label
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'upcoming'  => __('messages.status_upcoming'),
            'ongoing'   => __('messages.status_ongoing'),
            'completed' => __('messages.status_completed'),
            'cancelled' => __('messages.status_cancelled'),
            default     => ucfirst($this->status),
        };
    }
}
