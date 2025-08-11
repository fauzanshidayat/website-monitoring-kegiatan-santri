@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Detail Prestasi Santri</h4>
            </div>
            <div class="card-body">

                {{-- Detail Data Prestasi --}}
                <table class="table table-borderless table-striped">
                    <tr>
                        <th>Nama Santri</th>
                        <td>{{ $prestasi->santri->nama_lengkap ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Prestasi</th>
                        <td>{{ $prestasi->jenis_prestasi }}</td>
                    </tr>
                    <tr>
                        <th>Nama Prestasi</th>
                        <td>{{ $prestasi->nama_prestasi }}</td>
                    </tr>
                    <tr>
                        <th>Tingkat</th>
                        <td>{{ $prestasi->tingkat }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Prestasi</th>
                        <td>{{ \Carbon\Carbon::parse($prestasi->tanggal_prestasi)->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>{{ $prestasi->keterangan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Dibuat Pada</th>
                        <td>{{ $prestasi->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diperbarui</th>
                        <td>{{ $prestasi->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>

                <a href="{{ route('prestasi.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
