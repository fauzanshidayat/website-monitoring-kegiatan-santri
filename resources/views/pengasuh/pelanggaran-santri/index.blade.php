@extends('layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-dark font-weight-medium mb-1">Data Pelanggaran yang Anda Kelola</h3>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="zero_config" class="table table-bordered table-striped table-sm">
                        <thead class="bg-dark text-white text-center">
                            <tr>
                                <th>No</th>
                                <th>Pelanggaran</th>
                                <th>Jenis Pelanggaran</th>
                                <th>Hukuman</th>
                                <th>Pengasuh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dataPelanggaran as $index => $item)
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->pelanggaran }}</td>
                                    <td>{{ ucfirst($item->jenis_pelanggaran) }}</td>
                                    <td>{{ $item->hukuman }}</td>
                                    <td>{{ $item->pengasuh->nama_lengkap ?? '-' }}</td> {{-- ✅ Tampilkan nama pengasuh --}}
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('pengasuh.pelanggaran.create', $item->id) }}"
                                                class="btn btn-success btn-sm" title="Catat Pelanggaran">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </a>
                                            <a href="{{ route('pengasuh.pelanggaran.show', $item->id) }}"
                                                class="btn btn-info btn-sm ml-2" title="Lihat Pelanggaran">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="6">Belum ada data pelanggaran yang Anda kelola.</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
