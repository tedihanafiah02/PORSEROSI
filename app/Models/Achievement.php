<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Achievement extends Model
{
    protected $fillable = [
        'year',
        'tournament_name',
        'tournament_name_en',
        'tournament_level',
        'tournament_level_en',
        'achievement_type',
        'discipline',
        'discipline_en',
        'cabang_olahraga',
        'athlete_names',
        'is_published',
        'sort_order',
    ];

    /**
     * Get tournament name based on locale.
     */
    public function getLocalizedTournament(): string
    {
        $locale = app()->getLocale();
        if ($locale === 'en') {
            return $this->tournament_name_en ?? $this->tournament_name;
        }
        return $this->tournament_name;
    }

    /**
     * Get tournament level based on locale.
     */
    public function getLocalizedLevel(): string
    {
        $locale = app()->getLocale();
        if ($locale === 'en') {
            return $this->tournament_level_en ?? $this->tournament_level;
        }
        return $this->tournament_level;
    }

    /**
     * Get discipline based on locale.
     */
    public function getLocalizedDiscipline(): string
    {
        $locale = app()->getLocale();
        if ($locale === 'en') {
            return $this->discipline_en ?? $this->discipline;
        }
        return $this->discipline;
    }

    /**
     * Get localized achievement type.
     */
    public function getLocalizedType(): string
    {
        $type = strtolower($this->achievement_type);
        $isEn = app()->getLocale() === 'en';

        if ($isEn) {
            return match ($type) {
                'winner', 'juara 1', 'gold' => 'Winner / Gold',
                'runner-up', 'juara 2', 'silver' => 'Runner-up / Silver',
                'bronze', 'juara 3' => 'Bronze',
                default => ucfirst($this->achievement_type),
            };
        }

        return match ($type) {
            'winner', 'gold' => 'Juara 1',
            'runner-up', 'silver' => 'Juara 2',
            'bronze' => 'Juara 3',
            default => ucfirst($this->achievement_type),
        };
    }

    protected $casts = [
        'is_published' => 'boolean',
        'year'         => 'integer',
        'sort_order'   => 'integer',
    ];

    // Scope: hanya yang dipublikasikan
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    // Scope: filter by cabang olahraga
    public function scopeByCabor(Builder $query, string $cabor): Builder
    {
        if ($cabor && $cabor !== 'semua') {
            return $query->where('cabang_olahraga', $cabor);
        }
        return $query;
    }

    // Accessor: badge warna sesuai achievement type
    public function getBadgeColorAttribute(): string
    {
        return match (strtolower($this->achievement_type)) {
            'winner', 'juara 1', 'gold'   => 'gold',
            'runner-up', 'juara 2', 'silver' => 'silver',
            'bronze', 'juara 3'            => 'bronze',
            default                        => 'default',
        };
    }

    // Accessor: emoji medal
    public function getMedalEmojiAttribute(): string
    {
        return match (strtolower($this->achievement_type)) {
            'winner', 'juara 1', 'gold'   => '🥇',
            'runner-up', 'juara 2', 'silver' => '🥈',
            'bronze', 'juara 3'            => '🥉',
            default                        => '🏆',
        };
    }
}
