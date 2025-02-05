<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table='pesanan';
    protected $primaryKey = 'id_pesanan';
    protected $fillable=['id_user','id_produk','quantity','id_alamat','id_kabupaten','ongkir','bayar',
    'total_bayar','bukti_bayar','no_resi','desain','request_user','status',
    'variasi','variasi_harga','variasi_total','semai','semai_harga',
    'semai_total','note_semai_variasi','total_dp','bukti_bayar_dp',
    'bukti_bayar_dp_lunas','dp_status','tipe_pembayaran'];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }


    // Relasi ke produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    // Relasi ke alamat user
    public function userAlamat()
    {
        return $this->belongsTo(UserAlamat::class, 'id_alamat', 'id_user_alamat');
    }

    // Relasi ke user sebagai customer
    public function customer()
    {
        return $this->belongsTo(User::class, 'id_customer', 'id');
    }
}
