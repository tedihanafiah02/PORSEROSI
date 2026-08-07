<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Regulation extends Model
{
    protected $fillable = [
        'title',
        'title_en',
        'file_path',
        'regulation_folder_id',
        'order',
    ];

    public function folder(): BelongsTo
    {
        return $this->belongsTo(RegulationFolder::class, 'regulation_folder_id');
    }

    public function getLocalizedTitle(): ?string
    {
        return app()->getLocale() === 'en' ? ($this->title_en ?? $this->title) : $this->title;
    }
}
