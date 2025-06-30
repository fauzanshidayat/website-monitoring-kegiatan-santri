@extends('layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-dark font-weight-medium mb-1">Kegiatan Hafalan Saya</h3>
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

                <div class="table-responsive">
                    <table id="zero_config" class="table table-bordered table-striped table-sm">
                        <thead class="bg-dark text-white text-center">
                            <tr>
                                <th>No</th>
                                <th>Kegiatan</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Pengajar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kegiatan as $index => $item)
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->kegiatan }}</td>
                                    <td>{{ $item->hari }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->jam)->format('H:i') }}</td>
                                    <td>{{ $item->pengurus->nama_lengkap ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('santri.hafalan-saya.show', $item->id) }}"
                                            class="btn btn-info btn-sm" title="Lihat Hafalan Saya">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="6">Belum ada kegiatan hafalan yang tercatat untuk Anda.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
