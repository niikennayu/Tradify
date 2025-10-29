<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contact Us') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">
                    <p>Jika Anda memiliki pertanyaan lebih lanjut, silakan hubungi kami melalui:</p>
                    
                    <ul class="list-disc list-inside">
                        <li><strong>Alamat:</strong> Jl. Adat Istiadat No. 123, Jakarta, Indonesia</li>
                        <li><strong>Telepon:</strong> (021) 1234-5678</li>
                        <li><strong>Email:</strong> info@adatradify.com</li>
                        <li><strong>Jam Operasional:</strong> Senin - Sabtu (09.00 - 17.00 WIB)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
