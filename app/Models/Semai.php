<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semai extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_semai';
    protected $table='semai';
    protected $fillable = ['jenis_semai','harga_semai'];

}
