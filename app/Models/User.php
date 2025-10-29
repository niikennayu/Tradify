<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // Ini adalah gabungan dari $fillable bawaan Breeze + kolom baru Anda
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // (Req #2)
        'phone_number', // (Req #5)
        'address', // (Req #5)
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke tabel Rentals (Tambahan Anda)
     * Satu User bisa memiliki banyak Rental
     */
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}