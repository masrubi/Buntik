<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'foto_profile'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_user');
    }
    public function pesananSebagaiAnggota()
    {
        return $this->hasMany(Pesanan::class, 'id_user');
    }

    public function pelanggan()
    {
        return $this->hasManyThrough(
            User::class,        // Tabel target (users untuk customer)
            Pesanan::class,     // Tabel perantara (pesanan)
            'id_user',          // Foreign key pada tabel pesanan yang merujuk ke anggota
            'id',               // Foreign key pada tabel users untuk customer
            'id',               // Local key pada tabel anggota
            'id_customer'       // Local key pada tabel pesanan untuk customer
        );
    }
}
