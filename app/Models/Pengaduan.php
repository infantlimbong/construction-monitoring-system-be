<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_desa',
        'koordinat',
        'kondisi',
        'keterangan',
        'gambar'
    ];
}
