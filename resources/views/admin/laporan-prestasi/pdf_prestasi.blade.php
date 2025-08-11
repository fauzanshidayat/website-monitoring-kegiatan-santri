<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Prestasi Santri</title>
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

        img {
            width: 100%;
            /* Mengatur lebar gambar agar tidak lebih lebar dari lebar kertas */
            max-width: 100%;
            /* Batas lebar gambar agar tidak terlalu besar */
            height: 150px;
        }
    </style>
</head>

<body>
    <img src="{{ public_path('assets/images/kop-surat.png') }}" alt="Kop Surat">
    <h2>Laporan Perizinan Pulang Santri</h2>
    <h4>Periode: {{ \Carbon\Carbon::parse($tanggal_mulai)->format('d M Y') }} -
        {{ \Carbon\Carbon::parse($tanggal_selesai)->format('d M Y') }}</h4>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Santri</th>
                <th>Jenis Prestasi</th>
                <th>Nama Prestasi</th>
                <th>Tingkat</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($prestasi as $index => $item)
                <tr class="text-center">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->santri->nama_lengkap ?? '-' }}</td>
                    <td>{{ $item->jenis_prestasi }}</td>
                    <td>{{ $item->nama_prestasi }}</td>
                    <td>{{ $item->tingkat }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_prestasi)->translatedFormat('d F Y') }}</td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="7">Belum ada data laporan prestasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
