<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisLaporanPengaduan extends Model
{
    use HasFactory;
    protected $fillable = [
        'jenis_laporan'
    ];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'jenis_laporan_id');
    }
}