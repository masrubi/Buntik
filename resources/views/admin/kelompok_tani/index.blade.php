@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Daftar Kelompok Tani</h1>

    <!-- Flash Message -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Table -->
    <div class="card shadow">
        <div class="card-body">
            <a href="{{ route('kelompok_tani.create') }}" class="btn btn-primary mb-3">Tambah Kelompok Tani</a>
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Kelompok</th>
                        <th>Lokasi</th>
                        <th>Modal Gedung</th>
                        <th>Modal Awal Pupuk</th>
                        <th>Modal Awal Bibit</th>
                        <th>Modal Operasional</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kelompokTani as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_kelompok }}</td>
                        <td>{{ $item->lokasi }}</td>
                        <td>@currency($item->modal_gedung)</td>
                        <td>@currency($item->modal_awal_pupuk)</td>
                        <td>@currency($item->modal_awal_bibit)</td>
                        <td>@currency($item->modal_operasional)</td>
                        <td>
                            <a href="{{ route('kelompok_tani.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('kelompok_tani.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $kelompokTani->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
