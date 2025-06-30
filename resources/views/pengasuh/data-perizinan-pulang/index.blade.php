@extends('layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-dark font-weight-medium mb-1">Data Pengajuan Perizinan Pulang</h3>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                {{-- Notifikasi berhasil --}}
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
                                <th>Santri</th>
                                <th>Alasan</th>
                                <th>Tgl Pulang</th>
                                <th>Tgl Kembali</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->santri->nama_lengkap ?? '-' }}</td>
                                    <td>{{ $item->alasan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pulang)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</td>
                                    <td>
                                        @if ($item->status === 'diajukan')
                                            <span class="badge badge-warning">Diajukan</span>
                                        @elseif ($item->status === 'disetujui')
                                            <span class="badge badge-success">Disetujui</span>
                                        @else
                                            <span class="badge badge-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('pengasuh.perizinan-pulang.show', $item->id) }}"
                                            class="btn btn-info btn-sm" title="Lihat Detail & Ubah Status">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="7">Belum ada pengajuan perizinan pulang.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
