<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table = 'opd'; //tulis nama tabel yang digunakan
    protected $fillable = [
        'kode_opd',
        'nama_opd',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
