<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliklinik extends Model
{
    use HasFactory;
    protected $table = 'polikliniks';
    protected $fillable = ['kd_poli', 'nm_poli', 'keterangan', 'banner'];
}