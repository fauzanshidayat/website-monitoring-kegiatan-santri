@extends('layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-dark font-weight-medium mb-1">Data Perizinan Pulang Santri</h3>
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
                                <th>Nama Santri</th>
                                <th>Alasan</th>
                                <th>Tgl Pulang</th>
                                <th>Tgl Kembali</th>
                                <th>Status</th>
                                <th>Pengasuh Yang Memproses</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dataPerizinan as $index => $izin)
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $izin->santri->nama_lengkap ?? '-' }}</td>
                                    <td>{{ Str::limit($izin->alasan, 30) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($izin->tanggal_pulang)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($izin->tanggal_kembali)->format('d-m-Y') }}</td>
                                    <td>
                                        @php
                                            $statusColor = [
                                                'diajukan' => 'warning',
                                                'disetujui' => 'success',
                                                'ditolak' => 'danger',
                                            ];
                                        @endphp
                                        <span class="badge badge-{{ $statusColor[$izin->status] ?? 'secondary' }}">
                                            {{ ucfirst($izin->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $izin->pengasuh->nama_lengkap ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('admin.perizinan-pulang.show', $izin->id) }}"
                                            class="btn btn-success btn-sm" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="8">Belum ada data perizinan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
