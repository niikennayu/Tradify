<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Riwayat - {{ $user->name }}</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        h1 { font-size: 20px; text-align: center; }
        h2 { font-size: 16px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; font-size: 12px; }
        th { background-color: #f2f2f2; }
        @media print {
            body { margin: 0; }
            a[href] { display: none; }
            button { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <h1>Laporan Riwayat Peminjaman (Req #16)</h1>
    
    <h2>Informasi Peminjam</h2>
    <p style="font-size: 14px; margin: 0;"><strong>Nama:</strong> {{ $user->name }}</p>
    <p style="font-size: 14px; margin: 0;"><strong>Email:</strong> {{ $user->email }}</p>
    <p style="font-size: 14px; margin: 0;"><strong>No. HP:</strong> {{ $user->phone_number ?? '-' }}</p>
    <p style="font-size: 14px; margin: 0;"><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d M Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Unit (Kode)</th>
                <th>Tgl Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rentals as $index => $rental)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        {{ $rental->unit->nama_unit ?? 'Unit Dihapus' }}
                        ({{ $rental->unit->kode_unit ?? 'N/A' }})
                    </td>
                    <td>{{ \Carbon\Carbon::parse($rental->rental_date)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($rental->due_date)->format('d M Y') }}</td>
                    <td>{{ $rental->return_date ? \Carbon\Carbon::parse($rental->return_date)->format('d M Y') : '-' }}</td>
                    <td>{{ $rental->status }}</td>
                    <td>Rp {{ number_format($rental->fine_amount, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada riwayat peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>