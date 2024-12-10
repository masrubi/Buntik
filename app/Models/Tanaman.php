<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanaman extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $primaryKey = 'id';
    protected $table = 'tanaman';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_tanaman',
        'deskripsi',
    ];

    
}
