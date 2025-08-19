<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Data Guru</title>
    <style>
        @page {
            size: 215mm 330mm landscape;
            margin: 10mm 2mm;
        }
        body {
            font-family: 'Amiri', 'Times New Roman', 'Arial', sans-serif;
            font-size: 10pt;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 16pt;
            margin-bottom: 5px;
        }
        .table-laporan {
            width: 100%;
            border-collapse: collapse;
        }
        .table-laporan th, .table-laporan td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
            word-wrap: break-word;
        }
        .table-laporan th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .page-break {
            page-break-after: always;
        }
        .text-center {
            text-align: center;
        }
        .arabic-text {
            font-family: 'Amiri', 'Traditional Arabic', 'Arial Unicode MS', 'Tahoma', sans-serif;
            direction: rtl;
            text-align: right;
            unicode-bidi: embed;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Laporan Data Guru</h1>
        </div>

        <table class="table-laporan">
            <thead>
                <tr>
                    <th class="text-center" style="width: 8%;">ID Guru</th>
                    <th class="text-center" style="width: 15%;">Nama</th>
                    <th class="text-center" style="width: 8%;">Jenis Kelamin</th>
                    <th class="text-center" style="width: 10%;">Pendidikan</th>
                    <th class="text-center" style="width: 15%;">Alamat</th>
                    <th class="text-center" style="width: 8%;">Status</th>
                    <th class="text-center" style="width: 8%;">Mapel 1</th>
                    <th class="text-center" style="width: 8%;">Mapel 2</th>
                    <th class="text-center" style="width: 8%;">Mapel 3</th>
                    <th class="text-center" style="width: 8%;">Jabatan 1</th>
                    <th class="text-center" style="width: 8%;">Jabatan 2</th>
                    <th class="text-center" style="width: 8%;">Jabatan 3</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gurus as $guru)
                    <tr>
                        <td class="text-center">{{ $guru->idguru }}</td>
                        <td>{{ $guru->nama_guru }}</td>
                        <td>{{ $guru->jenisKelamin->jeniskelamin ?? '-' }}</td>
                        <td style="text-align: center">{{ $guru->pendidikanTerakhir->pendidikan ?? '-' }}</td>
                        <td>{{ $guru->alamat ?? '-' }}</td>
                        <td>{{ $guru->statusGuru->status ?? '-' }}</td>
                        <td class="arabic-text">{{ $guru->mapel1->mapel ?? '-' }}</td>
                        <td class="arabic-text">{{ $guru->mapel2->mapel ?? '-' }}</td>
                        <td class="arabic-text">{{ $guru->mapel3->mapel ?? '-' }}</td>
                        <td>{{ $guru->jabatan1->jabatan ?? '-' }}</td>
                        <td>{{ $guru->jabatan2->jabatan ?? '-' }}</td>
                        <td>{{ $guru->jabatan3->jabatan ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
