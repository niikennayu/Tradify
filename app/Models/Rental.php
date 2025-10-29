<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'unit_id',
        'rental_date',
        'due_date',
        'return_date',
        'status',
        'fine_amount'
    ];

    /**
     * Relasi ke User (Pemilik rental)
     * Satu Rental dimiliki oleh satu User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Unit (Unit yang dirental)
     * Satu Rental merujuk ke satu Unit
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
