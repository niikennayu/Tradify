<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Terms & Condition') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">
                    <h3 class="text-lg font-medium">1. Status Keanggotaan (Req #4)</h3>
                    <p>User harus terdaftar sebagai anggota untuk dapat meminjam / sewa unit.</p>
                    
                    <h3 class="text-lg font-medium">2. Batas Peminjaman (Req #11)</h3>
                    <p>Setiap anggota hanya dapat meminjam maksimal 2 (dua) unit baju adat secara bersamaan.</p>

                    <h3 class="text-lg font-medium">3. Durasi Peminjaman (Req #12)</h3>
                    <p>Durasi pinjaman maksimal adalah 5 (lima) hari. Jika pengembalian lebih dari 5 hari, maka akan dikenakan denda sesuai kebijakan.</p>
                    
                    <h3 class="text-lg font-medium">4. Denda Keterlambatan (Req #12)</h3>
                    <p>Besaran denda keterlambatan adalah Rp 50.000,- (Lima puluh ribu rupiah) per hari, dihitung setelah tanggal jatuh tempo.</p>

                    <h3 class="text-lg font-medium">5. Proses Pengembalian (Req #13)</h3>
                    <p>Pengembalian unit wajib dilakukan di lokasi kami dan akan diproses oleh Admin untuk validasi sistem.</p>
                    
                    <h3 class="text-lg font-medium">6. Kerusakan & Kehilangan</h3>
                    <p>Anggota bertanggung jawab penuh atas unit yang dipinjam. Kerusakan berat atau kehilangan akan dikenakan sanksi penggantian penuh.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>