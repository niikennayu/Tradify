<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    
                    {{-- Kolom Gambar --}}
                    <div class="p-6">
                        <img class="w-full h-auto rounded-lg shadow-lg" 
                             src="https://placehold.co/800x1000/EFEFEF/AAAAAA?text={{ $unit->nama_unit }}" 
                             alt="{{ $unit->nama_unit }}">
                        {{-- Galeri Thumbnail (jika ada) --}}
                        <div class="flex space-x-2 mt-4">
                            <img src="https://placehold.co/100x120/EFEFEF/AAAAAA?text=Thumb+1" class="w-24 h-30 rounded-md border-2 border-red-500 cursor-pointer">
                            <img src="https://placehold.co/100x120/EFEFEF/AAAAAA?text=Thumb+2" class="w-24 h-30 rounded-md border border-gray-300 cursor-pointer hover:border-red-500">
                            <img src="https://placehold.co/100x120/EFEFEF/AAAAAA?text=Thumb+3" class="w-24 h-30 rounded-md border border-gray-300 cursor-pointer hover:border-red-500">
                        </div>
                    </div>

                    {{-- Kolom Detail & Tombol Sewa --}}
                    <div class="p-8">
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-3">{{ $unit->nama_unit }}</h1>
                        
                        @if ($unit->categories->isNotEmpty())
                            <p class="text-md text-gray-600 dark:text-gray-400 mb-4">
                                Kategori: {{ $unit->categories->pluck('name')->join(', ') }}
                            </p>
                        @endif

                        {{-- Harga (jika ada) --}}
                        {{-- <p class="text-3xl font-extrabold text-red-600 dark:text-red-400 mb-6">Rp. 250.000 <span class="text-lg font-normal text-gray-500">/ 3 Hari</span></p> --}}
                        
                        {{-- Deskripsi --}}
                        <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 mb-6">
                            <p>{{ $unit->description }}</p>
                        </div>
                        
                        {{-- Status Ketersediaan --}}
                        @if ($unit->status == 'tersedia')
                            <div class="mb-6 p-3 bg-green-100 text-green-800 rounded-lg flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                <span class="font-semibold">Tersedia</span>
                            </div>

                            {{-- Tombol Sewa Sekarang --}}
                            <form action="{{ route('sewa.store', $unit) }}" method="POST">
                                @csrf
                                <button type"submit" class="w-full bg-red-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:bg-red-700 transition-all duration-300 text-lg uppercase">
                                    Sewa Sekarang
                                </button>
                            </form>
                            <p class="text-xs text-center text-gray-500 mt-3">Sewa maksimal 5 hari (Req #12)</p>
                        
                        @else
                            {{-- Status Tidak Tersedia --}}
                            <div class="mb-6 p-3 bg-gray-200 text-gray-700 rounded-lg flex items-center">
                                <i class="fas fa-times-circle mr-2"></i>
                                <span class="font-semibold">Sedang Disewa / Perawatan</span>
                            </div>
                            <button disabled class="w-full bg-gray-400 text-gray-600 font-bold py-3 px-6 rounded-lg cursor-not-allowed text-lg uppercase">
                                Tidak Tersedia
                            </button>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>