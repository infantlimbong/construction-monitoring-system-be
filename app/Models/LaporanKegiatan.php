<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jalan',
        'id_jembatan',
        'id_sumber_dana',
        'kegiatan',
        'lokasi',
        'anggaran_kes',
        'anggaran_fisik',
        'nilai_kontrak',
        'realisasi',
        'total_anggaran',
        'sisa_anggaran',
        'sisa_tender',
        'realisasi_fisik',
        'denda_keterlambatan',
        'kontrak_pelaksana',
        'tanggal_kontrak',
        'tanggal_spmk',
        'tanggal_selesai_kontrak',
        'keterangan',
        'tanggal_laporan',
    ];
}