<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LapKondisiJalan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_ruas_jalan',
        'nama_ruas_jalan',
        'panjang_ruas_jalan',
        'status_jalan',
        'kondisi_baik',
        'kondisi_cukup_baik',
        'kondisi_rusak_ringan',
        'kondisi_rusak_berat',
        'keseluruhan_kondisi',
        'tahun_pembangunan',
        'koordinat_jalan',
        'progress',
        'gambar_jalan',
        'gambar_jalan_paths',
        'id_desa',
        'id_user',
    ];
}
