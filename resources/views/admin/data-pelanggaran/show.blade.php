@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Detail Data Pelanggaran</h4>
            </div>
            <div class="card-body">

                {{-- Detail Data --}}
                <table class="table table-borderless table-striped">
                    <tr>
                        <th>Pelanggaran</th>
                        <td>{{ $dataPelanggaran->pelanggaran }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Pelanggaran</th>
                        <td>{{ ucfirst($dataPelanggaran->jenis_pelanggaran) }}</td>
                    </tr>
                    <tr>
                        <th>Hukuman</th>
                        <td>{{ $dataPelanggaran->hukuman }}</td>
                    </tr>
                    <tr>
                        <th>Bag.Pengasuhan</th>
                        <td>{{ $dataPelanggaran->pengasuh->nama_lengkap ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Dibuat Pada</th>
                        <td>{{ $dataPelanggaran->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diperbarui</th>
                        <td>{{ $dataPelanggaran->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>

                <a href="{{ route('data-pelanggaran.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
