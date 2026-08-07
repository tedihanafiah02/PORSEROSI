<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultFile extends Model
{
    protected $fillable = [
        'result_folder_id',
        'title',
        'title_en',
        'file_path',
        'order',
    ];

    public function folder()
    {
        return $this->belongsTo(ResultFolder::class, 'result_folder_id');
    }

    public function getLocalizedTitle()
    {
        if (app()->getLocale() === 'en' && $this->title_en) {
            return $this->title_en;
        }
        return $this->title;
    }
}
