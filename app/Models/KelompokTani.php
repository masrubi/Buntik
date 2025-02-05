<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokTani extends Model
{
    use HasFactory;
    protected $table = 'kelompok_tani';
    protected $fillable = [
        'nama_kelompok', 'id_provinsi','nama_prov','id_kabupaten','nama_kabupaten','id_kecamatan','nama_kecamatan','id_desa','nama_desa','kode_pos','alamat',
        'lokasi',
        'modal_gedung',
        'modal_pupuk',
        'modal_bibit',
        'modal_alat_operasional'
    ];

    public function pengelolaanTanaman()
    {
        return $this->hasMany(PengelolaanTanaman::class);
        
    }
}
