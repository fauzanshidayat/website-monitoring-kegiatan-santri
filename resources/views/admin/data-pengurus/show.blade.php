@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Detail Pengurus</h4>
            </div>
            <div class="card-body">

                {{-- Foto Pengurus --}}
                @if ($pengurus->photo)
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $pengurus->photo) }}" alt="Foto Pengurus" class="img-thumbnail"
                            width="150">
                    </div>
                @endif

                {{-- Detail Data --}}
                <table class="table table-borderless table-striped">
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $pengurus->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $pengurus->user->username }}</td>
                    </tr>
                    <tr>
                        <th>NIP</th>
                        <td>{{ $pengurus->nip }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $pengurus->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ \Carbon\Carbon::parse($pengurus->tanggal_lahir)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td>{{ $pengurus->telepon ?? '-' }}</td>
                    </tr>
                </table>

                <a href="{{ route('pengurus.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
