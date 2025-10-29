<x-app-layout>
    {{-- Header Halaman --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Peminjaman Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Notifikasi Error (jika gagal sewa) --}}
            @if (session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative shadow" role="alert">
                    <strong class="font-bold">Gagal!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            {{-- Grid untuk Card Peminjaman --}}
            @if ($rentals->isEmpty())
                {{-- Pesan jika tidak ada data pinjaman --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                        <h3 class="text-lg font-medium">Anda belum meminjam unit.</h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            Ayo jelajahi koleksi kami di halaman "Check Jadwal"!
                        </p>
                        <x-primary-button class="mt-4" onclick="window.location.href='{{ route('home') }}'">
                            Lihat Koleksi
                        </x-primary-button>
                    </div>
                </div>
            @else
                {{-- Tampilkan card untuk setiap unit yang dipinjam --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($rentals as $rental)
                        {{-- INI BAGIAN YANG BENAR: Memanggil komponen card dari Canvas --}}
                        <x-product-card :unit="$rental->unit" :due-date="$rental->due_date" />
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>