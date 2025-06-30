@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Detail Santri</h4>
            </div>
            <div class="card-body">

                {{-- Foto Santri --}}
                @if ($santri->photo)
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $santri->photo) }}" alt="Foto Santri" class="img-thumbnail"
                            width="150">
                    </div>
                @endif

                {{-- Detail Data --}}
                <table class="table table-borderless table-striped">
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $santri->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $santri->user->username }}</td>
                    </tr>
                    <tr>
                        <th>NIS</th>
                        <td>{{ $santri->nis }}</td>
                    </tr>
                    <tr>
                        <th>NISN</th>
                        <td>{{ $santri->nisn ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td>{{ $santri->kelas->nama_kelas ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $santri->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ \Carbon\Carbon::parse($santri->tanggal_lahir)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $santri->alamat }}</td>
                    </tr>
                    <tr>
                        <th>Wali Santri</th>
                        <td>{{ $santri->wali_santri }}</td>
                    </tr>
                    <tr>
                        <th>No HP Wali Santri</th>
                        <td>{{ $santri->no_hp_wali_santri }}</td>
                    </tr>
                </table>

                <a href="{{ route('santri.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
