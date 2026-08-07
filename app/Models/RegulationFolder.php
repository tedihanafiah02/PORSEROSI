<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RegulationFolder extends Model
{
    protected $fillable = [
        'name',
        'name_en',
        'order',
    ];

    public function regulations(): HasMany
    {
        return $this->hasMany(Regulation::class);
    }

    public function getLocalizedName(): ?string
    {
        return app()->getLocale() === 'en' ? ($this->name_en ?? $this->name) : $this->name;
    }
}
