{{-- resources/views/admin/laporan-hafalan/hasil.blade.php --}}
@extends('layouts.app')

@section('content')
    {{-- Breadcrumb --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-dark font-weight-medium mb-1">Laporan Data Hafalan</h3>
            </div>
        </div>
    </div>

    {{-- Kontainer Utama --}}
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                {{-- Tombol Cetak PDF --}}
                <form action="{{ route('admin.laporan-hafalan.pdf') }}" method="GET" target="_blank" class="mb-3">
                    <input type="hidden" name="data_kegiatan_id" value="{{ request('data_kegiatan_id') }}">
                    <input type="hidden" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
                    <input type="hidden" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}">
                    <button class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf"></i> Cetak PDF
                    </button>
                </form>

                {{-- Tabel Data Hafalan --}}
                <div class="table-responsive">
                    <table id="zero_config" class="table table-bordered table-striped table-hover table-sm">
                        <thead class="bg-dark text-white text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Santri</th>
                                <th>Jenis Hafalan</th>
                                <th>Kitab / Surah</th>
                                <th>Bab / Juz</th>
                                <th>Progres</th>
                                <th>Keterangan</th>
                                <th>Tanggal Hafalan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hafalan as $index => $item)
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->santri->nama_lengkap ?? '-' }}</td>
                                    <td>{{ ucfirst($item->jenis_hafalan) }}</td>
                                    <td>{{ $item->nama_kitab_surah }}</td>
                                    <td>{{ $item->bab_juz }}</td>
                                    <td>{{ $item->progres_belajar }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_menghafal)->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data hafalan dalam rentang tanggal ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
