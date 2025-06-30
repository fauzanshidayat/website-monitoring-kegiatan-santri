@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Detail Data Kegiatan</h4>
            </div>
            <div class="card-body">

                {{-- Detail Data --}}
                <table class="table table-borderless table-striped">
                    <tr>
                        <th>Kegiatan</th>
                        <td>{{ $dataKegiatan->kegiatan }}</td>
                    </tr>
                    <tr>
                        <th>Hari</th>
                        <td>{{ $dataKegiatan->hari }}</td>
                    </tr>
                    <tr>
                        <th>Jam</th>
                        <td>{{ \Carbon\Carbon::parse($dataKegiatan->jam)->format('H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Pengurus/Pengajar</th>
                        <td>{{ $dataKegiatan->pengurus->nama_lengkap ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Dibuat Pada</th>
                        <td>{{ $dataKegiatan->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diperbarui</th>
                        <td>{{ $dataKegiatan->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>

                <a href="{{ route('data-kegiatan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
