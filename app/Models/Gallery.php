<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    // Tambahkan kolom yang boleh diisi secara massal
    protected $fillable = [
        'image_path',
        'alt_text',
        'alt_text_en',
        'gallery_album_id',
    ];

    public function getLocalizedAlt(): ?string
    {
        return app()->getLocale() === 'en' ? ($this->alt_text_en ?? $this->alt_text) : $this->alt_text;
    }

    public function album()
    {
        return $this->belongsTo(GalleryAlbum::class, 'gallery_album_id');
    }
}