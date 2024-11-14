<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengamanan Blok</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .signature {
            width: 50%;
            float: left;
            text-align: center;
            margin-top: 10px;
        }
        .text-center {
            text-align: center;
            position: relative;
        }
        .logo-left {
            position: absolute;
            left: 0;
            top: 0;
        }
        .logo-right {
            position: absolute;
            right: 0;
            top: 0;
        }
    </style>
</head>
<body>
    <div class="text-center">
        <img src="images/permasyarakatan.png" alt="Left Logo" class="logo-left" width="100">
        <h1>Laporan Pengamanan Blok</h1>
        <img src="images/logo.png" alt="Right Logo" class="logo-right" width="100">
        <p>{{ $startDate }} - {{ $endDate }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>TITIK KONTROL</th>
                <th>JUMLAH HUNIAN</th>
                <th>WAKTU</th>
                <th>PETUGAS</th>
                <th>BAGIAN</th>
                <th>KONDISI SARPRAS</th>
                <th>LAPORAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->lokasi }}</td>
                    <td>{{ $report->jumlah_hunian }}</td>
                    <td>{{ \Carbon\Carbon::parse($report->created_at)->translatedFormat('l, d F Y H:i') }}</td>
                    <td>{{ $report->nama_lengkap }}</td>
                    <td>{{ $report->tim }}</td>
                    <td>{{ $report->kondisi_sarpras }}</td>
                    <td>{{ $report->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="border: 1px solid black; padding: 8px; width: 100%; margin-bottom: 20px;">
        <p>Disposisi:</p>
    </div>
    <div style="page-break-inside: avoid;">
        <div class="signature">
            <p>Mengetahui,</p>
            <p>Kalapas</p>
            <br><br>
            <p>____________________</p>
            <p>Porman Siregar</p>
            <p>NIP. 197105071994031001</p>
        </div>
        <div class="signature">
            <p>Telah Diperiksa,</p>
            <p>Ka.KPLP</p>
            <br><br>
            <p>____________________</p>
            <p>Bambang Setiawan</p>
            <p>NIP. 197712282000031001</p>
        </div>
    </div>
</body>
</html>
