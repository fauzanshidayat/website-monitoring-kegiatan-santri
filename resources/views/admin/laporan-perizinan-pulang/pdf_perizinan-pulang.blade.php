<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Perizinan Pulang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h2,
        h4 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 6px;
            text-align: center;
        }

        .badge {
            padding: 3px 6px;
            border-radius: 3px;
            color: white;
            font-weight: bold;
            display: inline-block;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .badge-warning {
            background-color: #ffc107;
            color: black;
        }
    </style>
</head>

<body>

    <h2>Laporan Perizinan Pulang Santri</h2>
    <h4>Periode: {{ \Carbon\Carbon::parse($tanggal_mulai)->format('d M Y') }} -
        {{ \Carbon\Carbon::parse($tanggal_selesai)->format('d M Y') }}</h4>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Santri</th>
                <th>Alasan</th>
                <th>Tanggal Pulang</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Disetujui Oleh</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($perizinan as $index => $izin)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $izin->santri->nama_lengkap ?? '-' }}</td>
                    <td>{{ $izin->alasan }}</td>
                    <td>{{ \Carbon\Carbon::parse($izin->tanggal_pulang)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($izin->tanggal_kembali)->format('d M Y') }}</td>
                    <td>
                        @if ($izin->status == 'disetujui')
                            <span class="badge badge-success">Disetujui</span>
                        @elseif ($izin->status == 'ditolak')
                            <span class="badge badge-danger">Ditolak</span>
                        @else
                            <span class="badge badge-warning">Diajukan</span>
                        @endif
                    </td>
                    <td>{{ $izin->pengasuh->nama_lengkap ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak ada data perizinan dalam rentang tanggal ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
