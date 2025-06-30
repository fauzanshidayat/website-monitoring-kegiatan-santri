@extends('layouts.app')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            @php
                $user = Auth::user();
                if ($user->role === 'admin') {
                    $namaLengkap = 'Administrator';
                } elseif ($user->role === 'pengurus' && $user->pengurus) {
                    $namaLengkap = $user->pengurus->nama_lengkap;
                } elseif ($user->role === 'pengasuh' && $user->pengasuh) {
                    $namaLengkap = $user->pengasuh->nama_lengkap;
                } elseif ($user->role === 'santri' && $user->santri) {
                    $namaLengkap = $user->santri->nama_lengkap;
                } else {
                    $namaLengkap = $user->username;
                }
            @endphp
            <div class="col-7 align-self-center">
                <h3 class="page-title text-dark text-wrap">
                    Selamat Datang <b>{{ $namaLengkap }}</b>, di Website Sistem Monitoring
                    Kegiatan Santri Pondok Pesantren Modern Nurul Alami
                </h3>
            </div>

        </div>
    </div>
    <div class="container-fluid">
        <!-- *************************************************************** -->
        <!-- Start First Cards -->
        <!-- *************************************************************** -->
        <div class="card-group">
            {{-- Total Hafalan --}}
            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium">{{ $totalHafalan }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 text-truncate">Total Hafalan</h6>
                        </div>
                        <div class="ml-auto">
                            <span class="opacity-7 text-muted"><i data-feather="book-open"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Pelanggaran --}}
            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium">{{ $totalPelanggaran }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 text-truncate">Total Pelanggaran</h6>
                        </div>
                        <div class="ml-auto">
                            <span class="opacity-7 text-muted"><i data-feather="alert-triangle"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Perizinan Pulang --}}
            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium">{{ $totalPerizinan }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 text-truncate">Total Izin Pulang</h6>
                        </div>
                        <div class="ml-auto">
                            <span class="opacity-7 text-muted"><i data-feather="log-out"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
