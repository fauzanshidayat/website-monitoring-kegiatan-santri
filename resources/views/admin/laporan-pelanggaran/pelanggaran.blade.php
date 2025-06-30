@extends('layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-dark font-weight-medium mb-1">Hasil Laporan Pelanggaran</h3>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('admin.laporan-pelanggaran.pdf') }}" method="GET" target="_blank" class="mb-3">
                    <input type="hidden" name="data_pelanggaran_id" value="{{ request('data_pelanggaran_id') }}">
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
                                <th>Pelanggaran</th>
                                <th>Jenis Pelanggaran</th>
                                <th>Hukuman</th>
                                <th>Keterangan</th>
                                <th>Tanggal Pelanggaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pelanggaran as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->santri->nama_lengkap ?? '-' }}</td>
                                    <td>{{ $item->dataPelanggaran->pelanggaran ?? '-' }}</td>
                                    <td>{{ $item->dataPelanggaran->jenis_pelanggaran ?? '-' }}</td>
                                    <td>{{ $item->dataPelanggaran->hukuman ?? '-' }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_melanggar)->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Tidak ada data pelanggaran dalam rentang tanggal ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
