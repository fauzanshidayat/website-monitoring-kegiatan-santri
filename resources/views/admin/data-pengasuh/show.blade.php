@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Detail Pengasuh</h4>
            </div>
            <div class="card-body">

                {{-- Foto Pengasuh --}}
                @if ($pengasuh->photo)
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $pengasuh->photo) }}" alt="Foto Pengasuh" class="img-thumbnail"
                            width="150">
                    </div>
                @endif

                {{-- Detail Data --}}
                <table class="table table-borderless table-striped">
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $pengasuh->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $pengasuh->user->username }}</td>
                    </tr>
                    <tr>
                        <th>NIP</th>
                        <td>{{ $pengasuh->nip }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $pengasuh->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ \Carbon\Carbon::parse($pengasuh->tanggal_lahir)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td>{{ $pengasuh->telepon ?? '-' }}</td>
                    </tr>
                </table>

                <a href="{{ route('pengasuh.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
