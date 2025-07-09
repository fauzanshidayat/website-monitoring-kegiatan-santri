<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Perizinan Pulang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header,
        .footer {
            text-align: center;
        }

        .content {
            margin-top: 30px;
            line-height: 1.5;
        }

        .table {
            width: 100%;
            margin-top: 20px;
            border: 1px solid #000;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 8px;
            border: 1px solid #000;
            text-align: left;
        }

        .table th {
            background-color: #f4f4f4;
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
    <div class="header">
        <h2>Surat Perizinan Pulang</h2>
    </div>

    <div class="content">

        <table class="table">
            <tr>
                <th>Nama</th>
                <td>{{ $perizinan->santri->nama_lengkap }}</td>
            </tr>
            <tr>
                <th>Alasan</th>
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
                <td>{{ ucfirst($perizinan->status) }}</td>
            </tr>
        </table>

        <p>Demikian surat perizinan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
    </div>


</body>

</html>
