<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $fillable = [
        'name',
        'leader',
        'period',
        'cities',
        'order',
    ];

    protected $casts = [
        'cities' => 'array',
    ];
}
