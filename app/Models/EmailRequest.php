<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailRequest extends Model
{
    use HasFactory;
protected $fillable = [
        'nomor_tiket',
        'user_id',
        'opd_id',
        'nama_lengkap',
        'nip',
        'jabatan',
        'no_hp',
        'email_pribadi',
        'nama_email_diusulkan',
        'domain',
        'alasan_permohonan',
        'surat_permohonan',
        'status',
        'catatan_admin',
        'diproses_oleh',
        'tanggal_verifikasi',
        'tanggal_selesai',
    ];

    protected $casts = [
        'tanggal_verifikasi' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'opd_id', 'id');
    }

    public function diprosesOleh()
    {
        return $this->belongsTo(User::class, 'diproses_oleh');
    }

}
