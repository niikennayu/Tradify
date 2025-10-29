<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'kode_unit',
        'nama_unit',
        'description',
        'image_path',
        'price',
        'status'
    ];

    /**
     * Relasi Many-to-Many ke Category (Req #7)
     * Satu Unit bisa memiliki banyak Kategori
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Relasi One-to-Many ke Rental
     * Satu Unit bisa memiliki banyak riwayat Rental
     */
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}