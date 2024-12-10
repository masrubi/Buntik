<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'kecamatan';

    // Tentukan kolom yang bisa diisi (fillable)
    protected $fillable = [
        'name', // Nama desa
        'kota_id', // ID kecamatan yang menjadi foreign key
    ];

    /**
     * Relasi ke model Kecamatan
     */
    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id');
    }

    public function desa()
    {
        return $this->hasMany(Desa::class, 'kecamatan_id');
    }
}
