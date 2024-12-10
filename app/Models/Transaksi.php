<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'user_id',         // ID user yang melakukan transaksi
        'total',           // Total harga transaksi
        'metode_pembayaran', // online/offline
        'status',          // Status pembayaran (selesai, menunggu, dll.)
        'created_at', 
        'updated_at'
    ];

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }

    /**
     * Scope untuk transaksi offline
     */
    public function scopeOffline($query)
    {
        return $query->where('metode_pembayaran', 'offline');
    }

    /**
     * Scope untuk transaksi online
     */
    public function scopeOnline($query)
    {
        return $query->where('metode_pembayaran', 'online');
    }
}

