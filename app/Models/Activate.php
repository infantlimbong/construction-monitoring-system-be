<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activate extends Model
{
    use HasFactory;

    protected $fillable = ['activate'];

    protected $table = 'activate';
}
