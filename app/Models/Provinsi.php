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
        'nama', // Nama desa
        
    ];

    /**
     * Relasi ke model Kecamatan
     */
   

    public function kabupaten()
    {
        return $this->hasMany(Kabupaten::class, 'provinsi_id');
    }
}
