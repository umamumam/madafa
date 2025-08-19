<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Data Siswa</title>
    <style>
        @page {
            size: A4 landscape;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
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
        .header h2 {
            font-size: 12pt;
            margin-top: 0;
        }
        .table-laporan {
            width: 100%;
            border-collapse: collapse;
        }
        .table-laporan th, .table-laporan td {
            border: 1px solid #000;
            padding: 6px; /* Mengurangi padding agar muat */
            text-align: left;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Laporan Data Siswa</h1>
            @if ($kelas)
                <h2>Kelas: {{ $kelas->nama_kelas }}</h2>
            @else
                <h2>Semua Kelas</h2>
            @endif
        </div>

        <table class="table-laporan">
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">No</th>
                    <th class="text-center" style="width: 10%;">NIS</th>
                    <th class="text-center" style="width: 15%;">Nama Siswa</th>
                    <th class="text-center" style="width: 10%;">Jenis Kelamin</th>
                    <th class="text-center" style="width: 15%;">Tempat, Tgl. Lahir</th>
                    <th class="text-center" style="width: 10%;">Nama Ayah</th>
                    <th class="text-center" style="width: 15%;">Alamat</th>
                    <th class="text-center" style="width: 10%;">Kelas</th>
                    <th class="text-center" style="width: 10%;">Program</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswas as $key => $siswa)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $siswa->nis ?? '-' }}</td>
                        <td>{{ $siswa->nama_siswa }}</td>
                        <td>{{ $siswa->jeniskelamin->jeniskelamin ?? '-' }}</td>
                        <td>
                            @if ($siswa->tempat_lahir || $siswa->tgl_lahir)
                                {{ $siswa->tempat_lahir ?? '' }}{{ $siswa->tempat_lahir && $siswa->tgl_lahir ? ', ' : '' }}{{ $siswa->tgl_lahir ? \Carbon\Carbon::parse($siswa->tgl_lahir)->translatedFormat('d F Y') : '' }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $siswa->nama_ayah ?? '-' }}</td>
                        <td>{{ $siswa->alamat ?? '-' }}</td>
                        <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                        <td>{{ $siswa->program->program ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
