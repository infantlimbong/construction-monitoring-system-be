<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LapKondisiJembatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_ruas_jembatan',
        'nama_ruas_jembatan',
        'panjang_ruas_jembatan',
        'status_jembatan',
        'kondisi_baik',
        'kondisi_cukup_baik',
        'kondisi_rusak_ringan',
        'kondisi_rusak_berat',
        'keseluruhan_kondisi',
        'tahun_pembangunan',
        'koordinat_jembatan',
        'progress',
        'gambar_jembatan',
        'id_desa',
        'id_user'
    ];
}