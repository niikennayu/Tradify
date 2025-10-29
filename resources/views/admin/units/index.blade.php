<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Units') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-end">
                <a href="{{ route('admin.units.create') }}" class="inline-flex items-center rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Tambah Unit</a>
            </div>

            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-green-800 dark:bg-green-900 dark:text-green-100">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-4 rounded-md bg-red-50 p-4 text-red-800 dark:bg-red-900 dark:text-red-100">{{ session('error') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Kode</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Harga</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Kategori</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($units as $unit)
                                    <tr>
                                        <td class="px-4 py-3">{{ $unit->kode_unit }}</td>
                                        <td class="px-4 py-3">{{ $unit->nama_unit }}</td>
                                        <td class="px-4 py-3">Rp{{ number_format($unit->price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $unit->status === 'tersedia' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100' : ($unit->status === 'disewa' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-100' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100') }}">
                                                {{ ucfirst($unit->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ $unit->categories->pluck('name')->join(', ') }}
                                        </td>
                                        <td class="px-4 py-3 text-right space-x-2">
                                            <a href="{{ route('admin.units.edit', $unit) }}" class="inline-flex items-center rounded-md bg-gray-100 px-3 py-1.5 text-sm font-medium text-gray-800 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600">Edit</a>
                                            <form action="{{ route('admin.units.destroy', $unit) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Hapus unit ini?')" class="inline-flex items-center rounded-md bg-red-100 px-3 py-1.5 text-sm font-medium text-red-800 hover:bg-red-200 dark:bg-red-900 dark:text-red-100 dark:hover:bg-red-800">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">Belum ada data unit.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@extends('layouts.admin') {{-- <-- Ini memberitahu Laravel untuk pakai "Bingkai" admin.blade.php --}}

@section('content') {{-- <-- Ini adalah "Foto" yang akan dimasukkan ke "Lubang" @yield('content') --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Manajemen Unit (Baju Adat)</h1>
        <a href="{{ route('admin.units.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
            + Tambah Unit Baru
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kode Unit</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Unit</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kategori</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($units as $unit)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $unit->kode_unit }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $unit->nama_unit }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($unit->status == 'tersedia')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Tersedia</span>
                            @elseif($unit->status == 'disewa')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Disewa</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Perawatan</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            @foreach($unit->categories as $category)
                                <span class="px-2 py-0.5 text-xs rounded-full bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-200 mr-1">{{ $category->name }}</span>
                            @endforeach
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.units.edit', $unit) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900">Edit</a>
                            <form action="{{ route('admin.units.destroy', $unit) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus unit ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 ml-4">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 text-center">Tidak ada data unit.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection