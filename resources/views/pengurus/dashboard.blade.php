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
            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium">{{ $totalKegiatan }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">
                                Jumlah Kegiatan yang Diampu
                            </h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted">
                                <i data-feather="book-open"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium">{{ $totalHafalan }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">
                                Total Hafalan dari Santri
                            </h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted">
                                <i data-feather="clipboard"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
