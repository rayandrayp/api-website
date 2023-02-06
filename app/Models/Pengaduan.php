<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'whatsapp',
        'tanggal_kejadian',
        'lokasi_kejadian',
        'pengaduan',
        'jenis_laporan_id'
    ];

    public function jenis_laporan()
    {
        return $this->belongsTo(JenisLaporanPengaduan::class, 'jenis_laporan_id');
    }
}