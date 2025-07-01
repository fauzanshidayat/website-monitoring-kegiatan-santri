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
            {{-- Total Kelas --}}
            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium">{{ $totalKelas }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 text-truncate">Total Kelas</h6>
                        </div>
                        <div class="ml-auto">
                            <span class="opacity-7 text-muted"><i data-feather="book"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Pengurus --}}
            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium">{{ $totalPengurus }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 text-truncate">Total Pengurus</h6>
                        </div>
                        <div class="ml-auto">
                            <span class="opacity-7 text-muted"><i data-feather="users"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Pengasuh --}}
            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium">{{ $totalPengasuh }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 text-truncate">Total Pengasuh</h6>
                        </div>
                        <div class="ml-auto">
                            <span class="opacity-7 text-muted"><i data-feather="user-check"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-group mt-3">
            {{-- Total Santri --}}
            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium">{{ $totalSantri }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 text-truncate">Total Santri</h6>
                        </div>
                        <div class="ml-auto">
                            <span class="opacity-7 text-muted"><i data-feather="user"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Kegiatan --}}
            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium">{{ $totalKegiatan }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 text-truncate">Total Data Kegiatan</h6>
                        </div>
                        <div class="ml-auto">
                            <span class="opacity-7 text-muted"><i data-feather="activity"></i></span>
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
                            <h6 class="text-muted font-weight-normal mb-0 text-truncate">Total Data Pelanggaran</h6>
                        </div>
                        <div class="ml-auto">
                            <span class="opacity-7 text-muted"><i data-feather="alert-circle"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
