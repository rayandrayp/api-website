<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiDokter extends Model
{
    use HasFactory;
    protected $fillable = [
        'kd_dokter',
        'prestasi',
        'tahun',
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
}