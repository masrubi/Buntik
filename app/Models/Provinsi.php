<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $table = 'provinsi';

    // Tentukan kolom yang bisa diisi (fillable)
    protected $fillable = [
        'name', // Nama desa
        
    ];

    /**
     * Relasi ke model Kecamatan
     */
   

    public function kota()
    {
        return $this->hasMany(Kota::class, 'provinsi_id');
    }
}
