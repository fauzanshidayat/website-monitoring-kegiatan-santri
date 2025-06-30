@extends('layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-dark font-weight-medium mb-1">Data Pelanggaran</h3>
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
                    <a href="{{ route('data-pelanggaran.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Pelanggaran
                    </a>
                </div>

                <div class="table-responsive">
                    <table id="zero_config" class="table table-bordered table-striped table-sm">
                        <thead class="bg-dark text-white text-center">
                            <tr>
                                <th>No</th>
                                <th>Pelanggaran</th>
                                <th>Jenis Pelanggaran</th>
                                <th>Hukuman</th>
                                <th>Bag.Pengasuhan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pelanggaran as $index => $item)
                                <tr class="text-center">
                                    <td>{{ $pelanggaran->firstItem() + $index }}</td>
                                    <td>{{ $item->pelanggaran }}</td>
                                    <td class="text-capitalize">{{ $item->jenis_pelanggaran }}</td>
                                    <td>{{ $item->hukuman }}</td>
                                    <td>{{ $item->pengasuh->nama_lengkap ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('data-pelanggaran.show', $item->id) }}"
                                                class="btn btn-success btn-sm" title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('data-pelanggaran.edit', $item->id) }}"
                                                class="btn btn-primary btn-sm mx-1" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('data-pelanggaran.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus data pelanggaran ini?')">
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
                                    <td colspan="6">Belum ada data pelanggaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
