<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendidikanDokter extends Model
{
    use HasFactory;
    protected $fillable = [
        'kd_dokter',
        'pendidikan',
        'perguruan_tinggi',
        'tahun'
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
}