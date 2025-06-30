@extends('layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-dark font-weight-medium mb-1">Detail Hafalan - {{ $dataKegiatan->kegiatan }}</h3>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Informasi Kegiatan:</h5>
                <ul>
                    <li><strong>Hari:</strong> {{ $dataKegiatan->hari }}</li>
                    <li><strong>Jam:</strong> {{ \Carbon\Carbon::parse($dataKegiatan->jam)->format('H:i') }}</li>
                    <li><strong>Pengajar:</strong> {{ $dataKegiatan->pengurus->nama_lengkap ?? '-' }}</li>
                </ul>

                <hr>

                <h5>Daftar Hafalan Santri</h5>

                <div class="table-responsive">
                    <table id="zero_config" class="table table-bordered table-striped table-sm">
                        <thead class="bg-dark text-white text-center">
                            <tr>
                                <th>No</th>
                                <th>Santri</th>
                                <th>Jenis Hafalan</th>
                                <th>Nama Kitab/Surah</th>
                                <th>Bab/Juz</th>
                                <th>Progres</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Aksi</th> <!-- Tambah kolom aksi -->
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hafalanList as $index => $hafalan)
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $hafalan->santri->nama_lengkap }}</td>
                                    <td>{{ ucfirst($hafalan->jenis_hafalan) }}</td>
                                    <td>{{ $hafalan->nama_kitab_surah }}</td>
                                    <td>{{ $hafalan->bab_juz }}</td>
                                    <td>{{ $hafalan->progres_belajar }}</td>
                                    <td>{{ \Carbon\Carbon::parse($hafalan->tanggal_menghafal)->format('d-m-Y') }}</td>
                                    <td>{{ $hafalan->keterangan ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('pengurus.hafalan.edit', $hafalan->id) }}"
                                                class="btn btn-primary btn-sm mb-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('pengurus.hafalan.destroy', $hafalan->id) }}"
                                                method="POST" style="display:inline-block;"
                                                onsubmit="return confirm('Yakin ingin menghapus data hafalan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm ml-2" type="submit">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="9">Belum ada data hafalan untuk kegiatan ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('pengurus.hafalan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
