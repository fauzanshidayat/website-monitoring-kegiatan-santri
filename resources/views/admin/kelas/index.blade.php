@extends('layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Kelas</h3>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- basic table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mx-4 mt-2" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <!-- Tombol Tambah -->
                    <div class="p-4">
                        <a href="" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#modalTambahKelas">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                    </div>
                    <!-- Modal Tambah Kelas -->
                    <div class="modal fade" id="modalTambahKelas" tabindex="-1" role="dialog"
                        aria-labelledby="modalTambahKelasLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="" method="POST">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTambahKelasLabel">Tambah Kelas</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nama_kelas">Nama Kelas</label>
                                            <input type="text" name="nama_kelas" class="form-control" id="nama_kelas"
                                                required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-sm table-striped table-bordered ">
                                <thead class="bg-dark">
                                    <tr class="text-center text-white">
                                        <th>No</th>
                                        <th>Nama Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data_kelas as $index => $kelas)
                                        <tr class="text-center align-middle">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $kelas->nama_kelas }}</td>
                                            <td>
                                                {{-- <a href="#" class="btn btn-success btn-sm" title="Lihat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-primary btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a> --}}
                                                <form action="{{ route('kelas.destroy', $kelas->id) }}" method="POST"
                                                    style="display:inline-block;"
                                                    onsubmit="return confirm('Yakin ingin menghapus kelas ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="3">Belum ada data kelas.</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
