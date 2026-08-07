<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    protected $fillable = [
        'name',
        'position',
        'position_en',
        'photo_path',
        'order',
    ];

    public function getLocalizedPosition(): ?string
    {
        return app()->getLocale() === 'en' ? ($this->position_en ?? $this->position) : $this->position;
    }
}
