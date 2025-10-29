<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Relasi Many-to-Many ke Unit (Req #7)
     * Satu Kategori bisa dimiliki oleh banyak Unit
     */
    public function units()
    {
        // Perhatikan, nama pivot table 'category_unit' 
        // sudah sesuai standar konvensi Laravel (nama model urut abjad)
        return $this->belongsToMany(Unit::class);
    }
}