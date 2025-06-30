@extends('layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-dark font-weight-medium mb-1">Data Kegiatan</h3>
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
                    <a href="{{ route('data-kegiatan.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Kegiatan
                    </a>
                </div>

                <div class="table-responsive">
                    <table id="zero_config" class="table table-bordered table-striped table-sm">
                        <thead class="bg-dark text-white text-center">
                            <tr>
                                <th>No</th>
                                <th>Kegiatan</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Pengurus/Pengajar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dataKegiatan as $index => $item)
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->kegiatan }}</td>
                                    <td>{{ $item->hari }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->jam)->format('H:i') }}</td>
                                    <td>{{ $item->pengurus->nama_lengkap ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('data-kegiatan.show', $item->id) }}"
                                                class="btn btn-success btn-sm" title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('data-kegiatan.edit', $item->id) }}"
                                                class="btn btn-primary btn-sm mx-1" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('data-kegiatan.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
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
                                    <td colspan="6">Belum ada data kegiatan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
