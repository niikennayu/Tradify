<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;
use App\Models\Category;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pastikan Anda sudah menambahkan 'kode_unit', 'nama_unit', 'description', 'status' 
        // ke $fillable di model App\Models\Unit

        // Ambil ID kategori yang sudah ada
        // Ini mengharuskan CategorySeeder dijalankan SEBELUM UnitSeeder
        $catJawa = Category::where('name', 'Jawa')->first();
        $catSumatera = Category::where('name', 'Sumatera')->first();
        $catSulawesi = Category::where('name', 'Sulawesi')->first();
        $catPernikahan = Category::where('name', 'Pernikahan')->first();
        $catKarnaval = Category::where('name', 'Karnaval')->first();

        // 1. Unit Beskap Jawa
        $unit1 = Unit::create([
            'kode_unit' => 'JWA-001', // Req #8a
            'nama_unit' => 'Beskap Jawa Solo Lengkap', // Req #8
            'description' => 'Set Beskap lengkap dengan blangkon, keris, dan jarik. Warna hitam pekat.',
            'price' => 180000,
            'status' => 'tersedia',
        ]);
        // Lampirkan kategori (Req #7 - multiple categories)
        if ($catJawa && $catPernikahan) {
            $unit1->categories()->attach([$catJawa->id, $catPernikahan->id]);
        }

        // 2. Unit Baju Bodo
        $unit2 = Unit::create([
            'kode_unit' => 'SLW-001',
            'nama_unit' => 'Baju Bodo Modern Merah',
            'description' => 'Baju Bodo modern bahan sutra warna merah cerah. Cocok untuk acara formal dan karnaval.',
            'price' => 250000,
            'status' => 'tersedia',
        ]);
        if ($catSulawesi && $catKarnaval) {
            $unit2->categories()->attach([$catSulawesi->id, $catKarnaval->id]);
        }

        // 3. Unit Songket Palembang
        $unit3 = Unit::create([
            'kode_unit' => 'SMT-001',
            'nama_unit' => 'Set Songket Palembang Pengantin',
            'description' => 'Sepasang baju pengantin adat Palembang dengan Songket emas mewah.',
            'price' => 224000,
            'status' => 'disewa', // Bikin 1 data 'disewa' untuk testing
        ]);
        if ($catSumatera && $catPernikahan) {
            $unit3->categories()->attach([$catSumatera->id, $catPernikahan->id]);
        }
         
        // 4. Unit Kebaya Karnaval
        $unit4 = Unit::create([
            'kode_unit' => 'KVL-001',
            'nama_unit' => 'Kebaya Karnaval Merak',
            'description' => 'Kebaya modifikasi dengan tema burung Merak, lengkap dengan sayap.',
            'price' => 599000,
            'status' => 'perawatan', // Bikin 1 data 'perawatan' untuk testing
        ]);
        if ($catKarnaval) {
            $unit4->categories()->attach($catKarnaval->id);
        }
    }
}
