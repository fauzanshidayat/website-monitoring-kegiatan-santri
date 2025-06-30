@extends('layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-dark font-weight-medium mb-1">Detail Pelanggaran -
                    {{ $dataPelanggaran->pelanggaran }}</h3>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Informasi Pelanggaran:</h5>
                <ul>
                    <li><strong>Jenis Pelanggaran:</strong> {{ ucfirst($dataPelanggaran->jenis_pelanggaran) }}</li>
                    <li><strong>Hukuman:</strong> {{ $dataPelanggaran->hukuman }}</li>
                    <li><strong>Pengasuh:</strong> {{ $dataPelanggaran->pengasuh->nama_lengkap ?? '-' }}</li>
                </ul>

                <hr>

                <h5>Daftar Pelanggaran Santri</h5>

                <div class="table-responsive">
                    <table id="zero_config" class="table table-bordered table-striped table-sm">
                        <thead class="bg-dark text-white text-center">
                            <tr>
                                <th>No</th>
                                <th>Santri</th>
                                <th>Tanggal Melanggar</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pelanggaranList as $index => $pelanggaran)
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pelanggaran->santri->nama_lengkap }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pelanggaran->tanggal_melanggar)->format('d-m-Y') }}</td>
                                    <td>{{ $pelanggaran->keterangan ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('pengasuh.pelanggaran.edit', $pelanggaran->id) }}"
                                                class="btn btn-primary btn-sm mb-1" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('pengasuh.pelanggaran.destroy', $pelanggaran->id) }}"
                                                method="POST" style="display:inline-block;"
                                                onsubmit="return confirm('Yakin ingin menghapus data pelanggaran ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm ml-2" type="submit" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="5">Belum ada data pelanggaran untuk kategori ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <a href="{{ route('pengasuh.pelanggaran.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
