<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    protected $table = 'kabupaten';

    // Tentukan kolom yang bisa diisi (fillable)
    protected $fillable = [
        'nama', // Nama desa
        'provinsi_id', // ID kecamatan yang menjadi foreign key
    ];

    /**
     * Relasi ke model Kecamatan
     */
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }

    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class, 'kabupaten_id');
    }
}
