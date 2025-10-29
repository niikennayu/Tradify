@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Dashboard Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="p-6 bg-white rounded-xl shadow-md text-center">
            <h2 class="text-lg font-semibold text-gray-700">Total Produk</h2>
            <p class="text-3xl font-bold mt-2">{{ $produkCount ?? 0 }}</p>
        </div>

        <div class="p-6 bg-white rounded-xl shadow-md text-center">
            <h2 class="text-lg font-semibold text-gray-700">Total Kategori</h2>
            <p class="text-3xl font-bold mt-2">{{ $kategoriCount ?? 0 }}</p>
        </div>

        <div class="p-6 bg-white rounded-xl shadow-md text-center">
            <h2 class="text-lg font-semibold text-gray-700">Total User</h2>
            <p class="text-3xl font-bold mt-2">{{ $userCount ?? 0 }}</p>
        </div>

        <div class="p-6 bg-white rounded-xl shadow-md text-center">
            <h2 class="text-lg font-semibold text-gray-700">Total Booking</h2>
            <p class="text-3xl font-bold mt-2">{{ $bookingCount ?? 0 }}</p>
        </div>
    </div>
@endsection
