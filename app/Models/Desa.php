<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;
    protected $table = 'desa';

    // Tentukan kolom yang bisa diisi (fillable)
    protected $fillable = [
        'name', // Nama desa
        'kecamatan_id', // ID kecamatan yang menjadi foreign key
    ];

    /**
     * Relasi ke model Kecamatan
     */
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
}
