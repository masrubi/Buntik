<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table th, table td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        table th { background-color: #f4f4f4; }
        .footer { margin-top: 20px; text-align: center; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Penjualan</h1>
        <p>Periode: Semua Waktu</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Produk</th>
                <th>Quantity</th>
                <th>Total Bayar</th>
                <th>Kota Pengiriman</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi as $trx)
                <tr>
                    <td>#P00{{ $trx->id_pesanan }}</td>
                    <td>{{ $trx->nama_produk }}</td>
                    <td>{{ $trx->quantity }}</td>
                    <td>Rp {{ number_format($trx->bayar, 2, ',', '.') }}</td>
                    <td>{{ $trx->nama_kota }}, {{ $trx->nama_prov }}</td>
                    <td>{{ $trx->updated_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>&copy; {{ date('Y') }} - Sistem Penjualan</p>
    </div>

    <script>
        window.onload = function () {
            window.print();
        };
    </script>
</body>
</html>
