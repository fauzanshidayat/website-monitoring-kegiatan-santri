<!DOCTYPE html>
<html>

<head>
    <title>Laporan Hafalan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }

        th {
            background-color: #eee;
        }

        /* Mengatur gambar untuk menyesuaikan ukuran kertas A4 landscape */
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
    <!-- Gambar Kop Surat dengan ukuran yang sudah disesuaikan -->
    <img src="{{ public_path('assets/images/kop-surat.png') }}" alt="Kop Surat">

    <h2 align="center">Laporan Hafalan Santri</h2>
    <p><strong>Kegiatan:</strong> {{ $dataKegiatan->kegiatan }}</p>
    <p><strong>Periode:</strong> {{ $tanggal_mulai }} s/d {{ $tanggal_selesai }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Santri</th>
                <th>Jenis Hafalan</th>
                <th>Kitab / Surah</th>
                <th>Bab / Juz</th>
                <th>Progres</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hafalan as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->santri->nama_lengkap ?? '-' }}</td>
                    <td>{{ ucfirst($item->jenis_hafalan) }}</td>
                    <td>{{ $item->nama_kitab_surah }}</td>
                    <td>{{ $item->bab_juz }}</td>
                    <td>{{ $item->progres_belajar }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_menghafal)->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
