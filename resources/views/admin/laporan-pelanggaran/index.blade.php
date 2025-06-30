@extends('layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-dark font-weight-medium mb-1">Laporan Pelanggaran Santri</h3>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.laporan-pelanggaran') }}" method="POST" target="_blank">
                    @csrf
                    <div class="form-group">
                        <label for="data_pelanggaran_id">Pilih Jenis Pelanggaran</label>
                        <select name="data_pelanggaran_id" class="form-control" required>
                            <option value="">-- Pilih Jenis --</option>
                            @foreach ($dataPelanggaran as $item)
                                <option value="{{ $item->id }}">{{ $item->pelanggaran }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="form-control" required>
                    </div>
                    <button class="btn btn-primary"><i class="fas fa-search"></i> Lihat Laporan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
