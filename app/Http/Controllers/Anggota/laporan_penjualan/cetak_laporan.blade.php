@extends('anggota.layouts.master')

@section('content')
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h4>Laporan Penjualan</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="page-content-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="invoice-title">
                                        <h3 class="m-t-0">
                                            <img src="/morvin/dist/assets/images/Logo.png" alt="logo" height="40" />
                                        </h3>
                                        <h4 class="float-end font-size-16"><strong>Laporan Penjualan</strong></h4>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <address>
                                                <strong>Periode:</strong><br>
                                                {{ $date_start ?? 'Semua Tanggal' }} - {{ $date_end ?? 'Semua Tanggal' }}<br>
                                            </address>
                                        </div>
                                    </div>

                                    <div class="p-2">
                                        <h3 class="panel-title font-size-20"><strong>Detail Laporan</strong></h3>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Produk</th>
                                                    <th>Jumlah</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                    <th>Lokasi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $grand_total = 0;
                                                @endphp
                                                @foreach ($transaksi as $index => $item)
                                                    @php
                                                        $grand_total += $item->bayar;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') }}</td>
                                                        <td>{{ $item->nama_produk }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>Rp {{ number_format($item->bayar, 2, ',', '.') }}</td>
                                                        <td>{{ ucfirst($item->status) }}</td>
                                                        <td>{{ $item->nama_kabupaten }}, {{ $item->nama_prov }}</td>
                                                    </tr>
                                                @endforeach
                                                @if ($transaksi->isEmpty())
                                                    <tr>
                                                        <td colspan="7" class="text-center">Tidak ada data untuk ditampilkan</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td colspan="4" class="text-end"><strong>Grand Total:</strong></td>
                                                        <td colspan="3"><strong>Rp {{ number_format($grand_total, 2, ',', '.') }}</strong></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="d-print-none mo-mt-2">
                                        <div class="float-end">
                                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light">
                                                <i class="fa fa-print"></i> Cetak
                                            </a>
                                            <a href="{{ route('anggota.laporan') }}" class="btn btn-primary"> << Kembali</a>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end row -->
                        </div>
                    </div>
                </div>
            </div> <!-- end row -->
        </div>
    </div>
@endsection
