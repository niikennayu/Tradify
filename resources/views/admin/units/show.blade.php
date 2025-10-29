<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Unit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Kode Unit</div>
                            <div class="text-base font-medium">{{ $unit->kode_unit }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Nama Unit</div>
                            <div class="text-base font-medium">{{ $unit->nama_unit }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Harga</div>
                            <div class="text-base font-medium">Rp{{ number_format($unit->price, 0, ',', '.') }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Status</div>
                            <div class="text-base font-medium">{{ ucfirst($unit->status) }}</div>
                        </div>
                        <div class="md:col-span-2">
                            <div class="text-sm text-gray-500 dark:text-gray-400">Kategori</div>
                            <div class="text-base font-medium">{{ $unit->categories->pluck('name')->join(', ') }}</div>
                        </div>
                        <div class="md:col-span-2">
                            <div class="text-sm text-gray-500 dark:text-gray-400">Deskripsi</div>
                            <div class="text-base">{{ $unit->description }}</div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <a href="{{ route('admin.units.edit', $unit) }}" class="rounded-md bg-gray-100 px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600">Edit</a>
                        <a href="{{ route('admin.units.index') }}" class="ms-2 rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-500">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


