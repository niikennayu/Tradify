<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Unit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($errors->any())
                        <div class="mb-6 rounded-md bg-red-50 p-4 text-red-800 dark:bg-red-900 dark:text-red-100">
                            <ul class="list-disc ps-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.units.update', $unit) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kode Unit</label>
                            <input type="text" name="kode_unit" value="{{ old('kode_unit', $unit->kode_unit) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white shadow-sm focus:border-red-500 focus:ring-red-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Unit</label>
                            <input type="text" name="nama_unit" value="{{ old('nama_unit', $unit->nama_unit) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white shadow-sm focus:border-red-500 focus:ring-red-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                            <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white shadow-sm focus:border-red-500 focus:ring-red-500">{{ old('description', $unit->description) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select name="status" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white shadow-sm focus:border-red-500 focus:ring-red-500" required>
                                <option value="tersedia" {{ old('status', $unit->status)==='tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="disewa" {{ old('status', $unit->status)==='disewa' ? 'selected' : '' }}>Disewa</option>
                                <option value="perawatan" {{ old('status', $unit->status)==='perawatan' ? 'selected' : '' }}>Perawatan</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
                            <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $unit->price) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white shadow-sm focus:border-red-500 focus:ring-red-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gambar (opsional)</label>
                            @if($unit->image_path)
                                <div class="mb-2">
                                    <img src="/{{ $unit->image_path }}" alt="{{ $unit->nama_unit }}" class="h-32 rounded border border-gray-200 dark:border-gray-700 object-cover">
                                </div>
                            @endif
                            <input type="file" name="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 dark:file:bg-gray-700 dark:file:text-gray-100">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: jpg, jpeg, png, webp. Maks 4MB.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                            <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-2">
                                @foreach($categories as $category)
                                    <label class="inline-flex items-center gap-2 text-sm">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="rounded border-gray-300 text-red-600 focus:ring-red-500" {{ in_array($category->id, old('categories', $unit->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        <span>{{ $category->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.units.index') }}" class="rounded-md bg-gray-100 px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600">Batal</a>
                            <button type="submit" class="inline-flex items-center rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Edit Unit: {{ $unit->nama_unit }}</h1>

    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <form action="{{ route('admin.units.update', $unit) }}" method="POST">
            @csrf
            @method('PUT') <!-- Penting untuk update -->
            <div class="space-y-6">
                
                <!-- Kode Unit (Req #8a) -->
                <div>
                    <label for="kode_unit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kode Unit (Wajib Unik)</label>
                    <input type="text" name="kode_unit" id="kode_unit" value="{{ old('kode_unit', $unit->kode_unit) }}" required
                           class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('kode_unit') border-red-500 @enderror">
                    @error('kode_unit')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Unit -->
                <div>
                    <label for="nama_unit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Unit</label>
                    <input type="text" name="nama_unit" id="nama_unit" value="{{ old('nama_unit', $unit->nama_unit) }}" required
                           class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('nama_unit') border-red-500 @enderror">
                    @error('nama_unit')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                              class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $unit->description) }}</textarea>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select name="status" id="status" required
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="tersedia" {{ old('status', $unit->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="perawatan" {{ old('status', $unit->status) == 'perawatan' ? 'selected' : '' }}>Perawatan</option>
                        <option value="disewa" {{ old('status', $unit->status) == 'disewa' ? 'selected' : '' }}>Disewa</option>
                    </select>
                </div>
                
                <!-- Kategori (Req #7) -->
                @php
                    $unitCategories = $unit->categories->pluck('id')->toArray();
                @endphp
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori (Bisa pilih lebih dari 1)</label>
                    <div class="mt-2 space-y-2 max-h-40 overflow-y-auto border border-gray-300 dark:border-gray-700 rounded-md p-4">
                        @forelse ($categories as $category)
                            <div class="flex items-center">
                                <input id="category_{{ $category->id }}" name="categories[]" type="checkbox" value="{{ $category->id }}"
                                       class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                                       {{ (is_array(old('categories')) && in_array($category->id, old('categories'))) || (empty(old('categories')) && in_array($category->id, $unitCategories)) ? 'checked' : '' }}>
                                <label for="category_{{ $category->id }}" class="ml-3 text-sm text-gray-700 dark:text-gray-300">{{ $category->name }}</label>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">Belum ada kategori. Buat kategori terlebih dahulu.</p>
                        @endforelse
                    </div>
                    @error('categories')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end">
                    <a href="{{ route('admin.units.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 mr-2">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Update Unit
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection