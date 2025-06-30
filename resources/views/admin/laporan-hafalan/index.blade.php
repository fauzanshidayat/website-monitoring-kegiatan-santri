{{-- resources/views/admin/laporan-hafalan/index.blade.php --}}
@extends('layouts.app')

@section('content')
    {{-- Breadcrumb / Header --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-dark font-weight-medium mb-1">Laporan Hafalan</h3>
            </div>
        </div>
    </div>

    {{-- Container Utama --}}
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                {{-- Alert jika ada pesan sukses --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                {{-- Form Laporan --}}
                <h4 class="card-title">Laporan Hafalan Berdasarkan Kegiatan</h4>
                <form action="{{ route('admin.laporan-hafalan') }}" method="POST" target="_blank">
                    @csrf

                    <div class="form-group">
                        <label for="data_kegiatan_id">Pilih Kegiatan</label>
                        <select name="data_kegiatan_id" id="data_kegiatan_id" class="form-control" required>
                            <option value="">-- Pilih Kegiatan --</option>
                            @foreach ($dataKegiatan as $item)
                                <option value="{{ $item->id }}">{{ $item->kegiatan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Lihat Laporan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
