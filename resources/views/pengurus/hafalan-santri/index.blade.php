@extends('layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-dark font-weight-medium mb-1">Kegiatan yang Anda Ampu</h3>
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
                                <th>Pengurus/Pengajar</th>
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
                                    <td>{{ $item->pengurus->nama_lengkap ?? '-' }}</td> {{-- ✅ Tampilkan nama pengurus --}}
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('pengurus.hafalan.create', $item->id) }}"
                                                class="btn btn-success btn-sm " title="Catat Hafalan">
                                                <i class="fas fa-book"></i>
                                            </a>
                                            <a href="{{ route('pengurus.hafalan.show', $item->id) }}"
                                                class="btn btn-info btn-sm ml-2" title="Lihat Hafalan">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="6">Belum ada kegiatan yang Anda ampu.</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
