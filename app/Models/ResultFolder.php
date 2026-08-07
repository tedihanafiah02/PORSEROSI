<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultFolder extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'name_en',
        'slug',
        'order',
    ];

    public function parent()
    {
        return $this->belongsTo(ResultFolder::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ResultFolder::class, 'parent_id')->orderBy('order', 'asc');
    }

    public function files()
    {
        return $this->hasMany(ResultFile::class, 'result_folder_id')->orderBy('order', 'asc');
    }

    public function getLocalizedName()
    {
        if (app()->getLocale() === 'en' && $this->name_en) {
            return $this->name_en;
        }
        return $this->name;
    }
}
