<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPanen extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'hasil_panen';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'pengelolaan_tanaman_id',
        'id_user',
        'jml_panen',
        'jml_jual',
        'jml_hibah',
        'jml_sisa',
    ];

    // Relasi ke model PengelolaanTanaman
    public function pengelolaanTanaman()
    {
        return $this->belongsTo(PengelolaanTanaman::class, 'pengelolaan_tanaman_id');
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
