<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'nip',
        'no_telepon',
        'jenis_kelamin',
        'foto',
    ];
}
