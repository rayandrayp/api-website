<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JajaranDireksi extends Model
{
    use HasFactory;
    protected $table = 'jajarandireksi';
    protected $fillable = [
        'nama',
        'jabatan',
        'imagepath'
    ];
}
