<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pelanggaran Santri</title>
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
    </style>
</head>

<body>

    <h2>Laporan Pelanggaran Santri</h2>
    <h4>Periode: {{ \Carbon\Carbon::parse($tanggal_mulai)->format('d M Y') }} -
        {{ \Carbon\Carbon::parse($tanggal_selesai)->format('d M Y') }}</h4>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Santri</th>
                <th>Pelanggaran</th>
                <th>Jenis Pelanggaran</th>
                <th>Hukuman</th>
                <th>Keterangan</th>
                <th>Tanggal Pelanggaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pelanggaran as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->santri->nama_lengkap ?? '-' }}</td>
                    <td>{{ $item->dataPelanggaran->pelanggaran ?? '-' }}</td>
                    <td>{{ $item->dataPelanggaran->jenis_pelanggaran ?? '-' }}</td>
                    <td>{{ $item->dataPelanggaran->hukuman ?? '-' }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_melanggar)->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Tidak ada data pelanggaran dalam rentang tanggal ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
