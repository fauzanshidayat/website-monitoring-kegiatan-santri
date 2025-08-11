@extends('layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-dark font-weight-medium mb-1">Data Prestasi Santri</h3>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="mb-2">
                    <a href="{{ route('prestasi.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Prestasi
                    </a>
                </div>

                <div class="table-responsive">
                    <table id="zero_config" class="table table-bordered table-striped table-sm">
                        <thead class="bg-dark text-white text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Santri</th>
                                <th>Jenis Prestasi</th>
                                <th>Nama Prestasi</th>
                                <th>Tingkat</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($prestasi as $index => $item)
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->santri->nama_lengkap ?? '-' }}</td>
                                    <td>{{ $item->jenis_prestasi }}</td>
                                    <td>{{ $item->nama_prestasi }}</td>
                                    <td>{{ $item->tingkat }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_prestasi)->translatedFormat('d F Y') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('prestasi.show', $item->id) }}" class="btn btn-success btn-sm"
                                                title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('prestasi.edit', $item->id) }}"
                                                class="btn btn-primary btn-sm mx-1" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('prestasi.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="7">Belum ada data prestasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
