@props(['unit', 'dueDate' => null])
@php
    // Logika untuk placeholder image. 
    // Ganti 'placeholder.jpg' dengan path gambar Anda, 
    // atau idealnya, simpan nama file gambar di database per unit.
    $imagePath = $unit->image_path ?: ('images/units/' . $unit->kode_unit . '.jpg');
    $placeholder = 'https://placehold.co/300x400/e2e8f0/94a3b8?text=adaTradify';
@endphp

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden group">
    <a href="{{ route('unit.show', $unit) }}" class="block">
        <div class="relative aspect-[3/4] overflow-hidden">
            <!-- Gambar Produk -->
            <img src="{{ asset($imagePath) }}" 
                 alt="{{ $unit->nama_unit }}" 
                 class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105"
                 onerror="this.onerror=null; this.src='{{ $placeholder }}';">

            <!-- Status Badge (jika disewa) -->
            @if($unit->status == 'disewa')
                <div class="absolute top-3 left-3 bg-gray-800 bg-opacity-80 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                    Disewa
                </div>
            @endif
            
            <!-- (Contoh Badge Diskon seperti di gambar Anda) -->
            {{-- <div class="absolute top-3 left-3 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-md">
                10% OFF
            </div> --}}
        </div>

        <div class="p-4 text-center">
            <!-- Nama Unit -->
            <h3 class="font-semibold text-gray-700 dark:text-gray-200 truncate" title="{{ $unit->nama_unit }}">
                {{ $unit->nama_unit }}
            </h3>

            <!-- Harga Unit -->
            <p class="text-red-600 dark:text-red-400 font-bold mt-1">
                Rp{{ number_format($unit->price, 0, ',', '.') }}
            </p>

            <!-- Info Tanggal Kembali (Hanya untuk Dashboard) -->
            @if($dueDate)
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                    Harus Kembali: <span class="font-medium text-gray-700 dark:text-gray-300">{{ \Carbon\Carbon::parse($dueDate)->format('d M Y') }}</span>
                </p>
            @endif

            <!-- (Contoh Tombol "See Product Detail" seperti di gambar Anda) -->
            {{-- <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 mt-3">
                <span class="inline-block bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-4 py-2 rounded-lg text-sm font-medium">
                    See Product Detail
                </span>
            </div> --}}
        </div>
    </a>
</div>