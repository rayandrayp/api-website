<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanPPID extends Model
{
    use HasFactory;
    protected $table = 'permintaan_ppid';
    protected $fillable = [
        'kategori',
        'nama',
        'alamat',
        'pekerjaan',
        'phone',
        'email',
        'metode_perolehan',
        'metode_pemberian',
        'rincian',
        'lampiran'
    ];
}