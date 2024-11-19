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
        td {
            white-space: nowrap;
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
        .th-font-size {
            font-size: 14px;
        }
        .tr-font-size {
            font-size: 13px;
        }
        .mt-0 {
            margin-top: 0;
        }
        .mb-0 {
            margin-bottom: 0;
        }
        .m-0 {
            margin: 0;
        }
        /* * {
            box-sizing: border-box;
        } */
    </style>
</head>
<body>
    <div class="text-center">
        <img src="images/permasyarakatan.png" alt="Left Logo" class="logo-left" width="50">
        <h1 class="mb-0">Laporan Pengamanan Blok</h1>
        <img src="images/logo.png" alt="Right Logo" class="logo-right" width="50">
        @if (!empty($startDate) && !empty($endDate) && trim($startDate) != '' && trim($endDate) != '')
            @php
                $startDate = \Carbon\Carbon::parse($startDate)->translatedFormat('d/m/Y');
                $endDate = \Carbon\Carbon::parse($endDate)->translatedFormat('d/m/Y');
            @endphp
            <p class="mt-0">{{ $startDate }} - {{ $endDate }}</p>
        @else
            <br>
        @endif
    </div>
    <table>
        <thead>
            <tr class="th-font-size" style="line-height: 10px;">
                <th>WAKTU</th>
                <th>LOKASI</th>
                <th>PETUGAS</th>
                <th>BAGIAN</th>
                <th>JUMLAH WBP</th>
                <th>KEADAAN</th>
                <th>INFORTING</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr class="tr-font-size">
                    <td>{{ \Carbon\Carbon::parse($report->created_at)->translatedFormat('d M Y H:i:s') }}</td>
                    <td>{{ $report->lokasi }}</td>
                    <td>{{ $report->nama_lengkap }}</td>
                    <td>{{ $report->tim }}</td>
                    <td>{{ $report->jumlah_hunian }}</td>
                    <td>{{ $report->kondisi_sarpras }}</td>
                    <td>{!! $report->keterangan !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="tr-font-size" style="border: 1px solid black; padding: 8px 0 8px 8px; margin-bottom: 20px;">
        <p>Disposisi:</p>
    </div>
    <div class="tr-font-size" style="page-break-inside: avoid;">
        <div class="signature">
            <p class="m-0">Mengetahui,</p>
            <p class="m-0">Kalapas</p>
            <br><br><br>
            <p>____________________</p>
            <p class="m-0">Porman Siregar</p>
            <p class="m-0">NIP. 197105071994031001</p>
        </div>
        <div class="signature">
            <p class="m-0">Telah Diperiksa,</p>
            <p class="m-0">Ka.KPLP</p>
            <br><br><br>
            <p>____________________</p>
            <p class="m-0">Bambang Setiawan</p>
            <p class="m-0">NIP. 197712282000031001</p>
        </div>
    </div>
</body>
</html>
