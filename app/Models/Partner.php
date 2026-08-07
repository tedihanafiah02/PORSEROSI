<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    /**
     * Kolom yang boleh diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'description_en',
        'contact_name',
        'whatsapp_number',
        'status',
        'user_id',
        'logo_path',
        'alt_text',
        'alt_text_en',
        'link',
        'row',
    ];

    public function getLocalizedAlt(): ?string
    {
        return app()->getLocale() === 'en' ? ($this->alt_text_en ?? $this->alt_text) : $this->alt_text;
    }

    public function getLocalizedDescription(): ?string
    {
        return app()->getLocale() === 'en' ? ($this->description_en ?? $this->description) : $this->description;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}