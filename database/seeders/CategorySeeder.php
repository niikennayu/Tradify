<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pastikan Anda sudah menambahkan 'name' dan 'description' 
        // ke $fillable di model App\Models\Category
        $categories = [
            [
                'name' => 'Jawa',
                'description' => 'Koleksi baju adat dari berbagai daerah di Pulau Jawa, seperti Kebaya, Beskap, dan Batik.'
            ],
            [
                'name' => 'Sumatera',
                'description' => 'Koleksi baju adat dari Pulau Sumatera, termasuk Ulos Batak, Songket Palembang, dan Baju Kurung.'
            ],
            [
                'name' => 'Sulawesi',
                'description' => 'Baju adat khas Pulau Sulawesi, seperti Baju Bodo dari Makassar dan pakaian adat Toraja.'
            ],
            [
                'name' => 'Kalimantan',
                'description' => 'Pakaian adat Suku Dayak dan daerah lainnya di Pulau Kalimantan.'
            ],
            [
                'name' => 'Pernikahan',
                'description' => 'Set pakaian adat lengkap untuk prosesi pernikahan, baik untuk mempelai pria maupun wanita.'
            ],
            [
                'name' => 'Karnaval',
                'description' => 'Kostum adat yang dimodifikasi untuk keperluan festival, karnaval, atau acara budaya.'
            ],
        ];

        // Masukkan data ke database
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}