@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Dashboard Rental Aktif</h1>

    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Unit (Baju Adat)</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Peminjam</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tgl Pinjam</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jatuh Tempo</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($activeRentals as $rental)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ $rental->unit->nama_unit ?? 'Unit Dihapus' }}
                            <span class="block text-xs text-gray-500">{{ $rental->unit->kode_unit ?? '' }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            {{ $rental->user->name ?? 'User Dihapus' }}
                            <span class="block text-xs text-gray-500">{{ $rental->user->email ?? '' }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ \Carbon\Carbon::parse($rental->rental_date)->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300
                            @if(\Carbon\Carbon::now()->isAfter($rental->due_date)) text-red-500 font-bold @endif">
                            {{ \Carbon\Carbon::parse($rental->due_date)->format('d M Y') }}
                            @if(\Carbon\Carbon::now()->isAfter($rental->due_date))
                                (Terlambat)
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form action="{{ route('admin.rentals.return', $rental) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin unit ini dikembalikan?');">
                                @csrf
                                <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-md hover:bg-green-600 text-xs">
                                    Proses Pengembalian
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 text-center">Tidak ada data unit yang sedang dipinjam.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection