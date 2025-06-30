@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Detail Pengajuan Perizinan Pulang</h4>
            </div>
            <div class="card-body">

                {{-- Notifikasi --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                {{-- Detail Data --}}
                <table class="table table-borderless table-striped">
                    <tr>
                        <th>Nama Santri</th>
                        <td>{{ $perizinan->santri->nama_lengkap ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alasan Pulang</th>
                        <td>{{ $perizinan->alasan }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pulang</th>
                        <td>{{ \Carbon\Carbon::parse($perizinan->tanggal_pulang)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Kembali</th>
                        <td>{{ \Carbon\Carbon::parse($perizinan->tanggal_kembali)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if ($perizinan->status === 'diajukan')
                                <span class="badge badge-warning">Diajukan</span>
                            @elseif ($perizinan->status === 'disetujui')
                                <span class="badge badge-success">Disetujui</span>
                            @else
                                <span class="badge badge-danger">Ditolak</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Pengasuh yang Memproses</th>
                        <td>{{ Auth::user()->pengasuh->nama_lengkap ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Dibuat Pada</th>
                        <td>{{ $perizinan->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diperbarui</th>
                        <td>{{ $perizinan->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>

                {{-- Form Update Status --}}
                @if ($perizinan->status === 'diajukan')
                    <form action="{{ route('pengasuh.perizinan-pulang.updateStatus', $perizinan->id) }}" method="POST"
                        class="mt-4">
                        @csrf
                        <div class="form-group">
                            <label for="status">Ubah Status Pengajuan</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="disetujui">Disetujui</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </form>
                @endif

                <a href="{{ route('pengasuh.perizinan-pulang.index') }}" class="btn btn-secondary mt-3">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
