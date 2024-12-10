<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengelolaanTanaman extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'pengelolaan_tanaman';

    // Kolom yang dapat diisi
    protected $fillable = [
        'kelompok_tani_id',
        'tanaman_id',
        'tanggal_tanam',
        'tanggal_panen',
        'jml_tanam',
        'jml_pupuk',
        'id_user',
    ];

    // Casting kolom ke tipe data yang sesuai
    protected $casts = [
        'tanggal_tanam' => 'date',
        'tanggal_panen' => 'date',
        'jml_tanam' => 'float',
        'jml_pupuk' => 'float',
    ];

    // Relasi ke KelompokTani
    public function kelompokTani()
    {
        return $this->belongsTo(KelompokTani::class, 'kelompok_tani_id');
    }

    // Relasi ke Tanaman
    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class, 'tanaman_id');
    }

    // Relasi opsional ke HasilPanen jika ada
    public function hasilPanen()
    {
        return $this->hasOne(HasilPanen::class, 'pengelolaan_tanaman_id');
    }
 

public function user()
{
    return $this->belongsTo(User::class, 'id_user');
}
}
