@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Detail Pengajuan Perizinan Pulang</h4>
            </div>
            <div class="card-body">

                {{-- Detail Data --}}
                <table class="table table-borderless table-striped">
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
                        <th>Pengasuh yang Menyetujui</th>
                        <td>{{ $perizinan->pengasuh->nama_lengkap ?? '-' }}</td>
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

                <a href="{{ route('perizinan-pulang.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
