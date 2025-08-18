<!DOCTYPE html>
<html>
<head>
    <title>Laporan KDUM Peserta Didik</title>
    <style>
        @page {
            size: 330mm 215mm;
            margin: 10mm 2mm;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h4 {
            margin: 0;
        }
        .table-container {
            width: 100%;
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        thead {
            background-color: #f2f2f2;
        }
        th {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h4>Laporan KDUM Peserta Didik</h4>
        <p>Tahun Pelajaran: {{ $tahunPelajaran->tahun }}</p>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">NIS</th>
                    <th rowspan="2">Nama Siswa</th>
                    <th rowspan="2">Kelas</th>
                    <th colspan="{{ $kompetensiList->count() }}">Nilai KDUM</th>
                </tr>
                <tr>
                    @foreach ($kompetensiList as $index => $kompetensi)
                    <th>Nilai {{ $index + 1 }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse ($siswas as $index => $siswa)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $siswa->nis }}</td>
                    <td>{{ $siswa->nama_siswa }}</td>
                    <td>{{ $siswa->kelas->nama_kelas ?? 'N/A' }}</td>
                    @if ($siswa->kdums->isNotEmpty())
                    @php
                    $kdum = $siswa->kdums->first();
                    $nilaiKompetensi = [];
                    foreach ($kdum->details as $detail) {
                    if (isset($detail->kompetensi) && isset($detail->nilai)) {
                    $nilaiKompetensi[$detail->kompetensi->id] = $detail->nilai->abjad;
                    }
                    }
                    @endphp
                    @foreach ($kompetensiList as $kompetensi)
                    <td style="text-align: center;">{{ $nilaiKompetensi[$kompetensi->id] ?? '-' }}</td>
                    @endforeach
                    @else
                    <td colspan="{{ $kompetensiList->count() }}" style="text-align: center;">-</td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="{{ 4 + $kompetensiList->count() }}" style="text-align: center;">
                        Tidak ada data siswa yang ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
