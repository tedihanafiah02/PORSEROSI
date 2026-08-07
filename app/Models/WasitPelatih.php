<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WasitPelatih extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_wa',
        'email',
        'provinsi',
        'kabupaten_kota',
        'klub_asal',
        'kategori',
        'lisensi',
        'disiplin',
        'foto_path',
        'sertifikat_path',
        'status',
    ];
}
