@extends('layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-dark font-weight-medium mb-1">Hasil Laporan Perizinan Pulang</h3>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('admin.laporan-perizinan-pulang.pdf') }}" method="GET" target="_blank" class="mb-3">
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
                                <th>Alasan</th>
                                <th>Tanggal Pulang</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th>Disetujui Oleh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($perizinan as $index => $izin)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $izin->santri->nama_lengkap ?? '-' }}</td>
                                    <td>{{ $izin->alasan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($izin->tanggal_pulang)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($izin->tanggal_kembali)->format('d M Y') }}</td>
                                    <td>
                                        @if ($izin->status == 'disetujui')
                                            <span class="badge badge-success">Disetujui</span>
                                        @elseif ($izin->status == 'ditolak')
                                            <span class="badge badge-danger">Ditolak</span>
                                        @else
                                            <span class="badge badge-warning text-dark">Diajukan</span>
                                        @endif
                                    </td>
                                    <td>{{ $izin->pengasuh->nama_lengkap ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Tidak ada data perizinan dalam rentang tanggal ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
