<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;
    protected $table = 'dokter';
    protected $primaryKey = 'kd_dokter';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'kd_dokter',
        'nm_dokter',
        'imagepath',
        'kd_sps',
        'status',
    ];

    public function spesialis()
    {
        return $this->belongsTo(Spesialis::class, 'kd_sps', 'kd_sps');
    }
    
    public function minat_klinis()
    {
        return $this->hasMany(MinatKlinis::class, 'kd_dokter', 'kd_dokter');
    }

}