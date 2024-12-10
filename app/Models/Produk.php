<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_produk';
    protected $table = 'produk_tani';
    protected $fillable = [
        'nama_produk',
        'nama_kelompok',
        'kategori',
        'harga_produk',
        'foto_produk1',
        'foto_produk2',
        'foto_produk3',
        'foto_produk4',
        'deskripsi',
        'stok_produk',
        'kelompok_tani_id',
        'tanaman_id',
        'pengelolaan_tanaman_id',
        'hasil_panen_id',
    ];

    // Relasi ke tabel HasilPanen
    public function hasilPanen()
    {
        return $this->belongsTo(HasilPanen::class, 'hasil_panen_id');
    }
}
