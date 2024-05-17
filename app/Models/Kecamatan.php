<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_kabupaten',
        'nama_kecamatan'
    ];

    public function desas()
    {
        return $this->hasMany(Desa::class, 'id_kecamatan');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten');
    }

}
