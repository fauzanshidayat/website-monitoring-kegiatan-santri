@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Detail Perizinan Pulang Santri</h4>
            </div>
            <div class="card-body">

                {{-- Detail Data --}}
                <table class="table table-borderless table-striped">
                    <tr>
                        <th>Nama Santri</th>
                        <td>{{ $izin->santri->nama_lengkap ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alasan</th>
                        <td>{{ $izin->alasan }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pulang</th>
                        <td>{{ \Carbon\Carbon::parse($izin->tanggal_pulang)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Kembali</th>
                        <td>{{ \Carbon\Carbon::parse($izin->tanggal_kembali)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @php
                                $statusColor = [
                                    'diajukan' => 'warning',
                                    'disetujui' => 'success',
                                    'ditolak' => 'danger',
                                ];
                            @endphp
                            <span class="badge badge-{{ $statusColor[$izin->status] ?? 'secondary' }}">
                                {{ ucfirst($izin->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Pengasuh Yang Memproses</th>
                        <td>{{ $izin->pengasuh->nama_lengkap ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Dibuat Pada</th>
                        <td>{{ $izin->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diperbarui</th>
                        <td>{{ $izin->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>

                <a href="{{ route('admin.perizinan-pulang.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
