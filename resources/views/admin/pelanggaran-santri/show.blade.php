@extends('layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-dark font-weight-medium mb-1">
                    Detail Pelanggaran - {{ $dataPelanggaran->jenis_pelanggaran }}
                </h3>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Informasi Pelanggaran:</h5>
                <ul>
                    <li><strong>Pelanggaran:</strong> {{ $dataPelanggaran->pelanggaran }}</li>
                    <li><strong>Jenis Pelanggaran:</strong> {{ $dataPelanggaran->jenis_pelanggaran }}</li>
                    <li><strong>Hukuman:</strong> {{ $dataPelanggaran->hukuman }}</li>
                    <li><strong>Bag. Pengasuhan:</strong> {{ $dataPelanggaran->pengasuh->nama_lengkap ?? '-' }}</li>
                </ul>

                <hr>

                <h5>Daftar Pelanggaran Santri</h5>

                <div class="table-responsive">
                    <table id="zero_config" class="table table-bordered table-striped table-sm">
                        <thead class="bg-dark text-white text-center">
                            <tr>
                                <th>No</th>
                                <th>Santri</th>
                                <th>Tanggal Melanggar</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pelanggaranList as $index => $pelanggaran)
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pelanggaran->santri->nama_lengkap }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pelanggaran->tanggal_melanggar)->format('d-m-Y') }}</td>
                                    <td>{{ $pelanggaran->keterangan ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="4">Belum ada data pelanggaran untuk jenis ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <a href="{{ route('admin.pelanggaran-santri.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
