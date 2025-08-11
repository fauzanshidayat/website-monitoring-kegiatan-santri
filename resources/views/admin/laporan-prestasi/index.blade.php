@extends('layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-dark font-weight-medium mb-1">Laporan Prestasi Santri</h3>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.laporan-prestasi') }}" method="POST" target="_blank">
                    @csrf
                    <div class="form-group">
                        <label>Tanggal Pulang Mulai</label>
                        <input type="date" name="tanggal_mulai" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pulang Selesai</label>
                        <input type="date" name="tanggal_selesai" class="form-control" required>
                    </div>
                    <button class="btn btn-primary"><i class="fas fa-search"></i> Lihat Laporan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
