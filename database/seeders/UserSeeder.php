<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Akun Admin (Req #19)
        // Pastikan Anda sudah menambahkan 'role', 'phone_number', 'address' 
        // ke $fillable di model App\Models\User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Ganti 'password' dengan password yang aman
            'role' => 'admin', // Req #2
            'phone_number' => '081234567890', // Req #5
            'address' => 'Kantor Pusat adaTradify, Jakarta', // Req #5
            'remember_token' => Str::random(10),
        ]);

        // 2. Akun User / Anggota (Req #19)
        User::create([
            'name' => 'Budi Setiawan',
            'email' => 'budi@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Ganti 'password' dengan password yang aman
            'role' => 'user', // Default
            'phone_number' => '089876543210',
            'address' => 'Jl. Merdeka No. 17, Bandung',
            'remember_token' => Str::random(10),
        ]);

        // 3. Akun User / Anggota Lain
        User::create([
            'name' => 'Citra Lestari',
            'email' => 'citra@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Ganti 'password' dengan password yang aman
            'role' => 'user',
            'phone_number' => '087712345678',
            'address' => 'Jl. Diponegoro No. 22, Surabaya',
            'remember_token' => Str::random(10),
        ]);
    }
}