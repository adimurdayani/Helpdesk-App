<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailRequest extends Model
{
    //
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

     // Pemohon
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // OPD
    public function opd()
    {
        return $this->belongsTo(Instansi::class);
    }

    // Admin yang memproses
    public function diprosesOleh()
    {
        return $this->belongsTo(User::class, 'diproses_oleh');
    }

    // Membuat penomoran otomatis
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->nomor_tiket = 'HELP-' . now()->format('YmdHis');
        });
    }


}
