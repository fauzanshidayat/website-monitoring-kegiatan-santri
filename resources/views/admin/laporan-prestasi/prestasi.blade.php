@extends('layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-dark font-weight-medium mb-1">Hasil Laporan Prestasi Santri</h3>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('admin.laporan-prestasi.pdf') }}" method="GET" target="_blank" class="mb-3">
                    <input type="hidden" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
                    <input type="hidden" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}">
                    <button class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i> Cetak PDF</button>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm text-center">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>No</th>
                                <th>Nama Santri</th>
                                <th>Jenis Prestasi</th>
                                <th>Nama Prestasi</th>
                                <th>Tingkat</th>
                                <th>Tanggal</th>
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
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="7">Belum ada data laporan prestasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
