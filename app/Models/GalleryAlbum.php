<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryAlbum extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'description_en',
        'cover_image',
    ];

    public function getLocalizedDescription(): ?string
    {
        return app()->getLocale() === 'en' ? ($this->description_en ?? $this->description) : $this->description;
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'gallery_album_id');
    }
}
