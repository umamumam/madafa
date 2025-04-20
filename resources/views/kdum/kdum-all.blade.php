<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KDUM PDF Semua</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 3px; }
        .no-border td {
            border: none;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

@foreach($kdums as $kdum)
    <h3 style="text-align: center;">LAPORAN HASIL PENILAIAN KDUM & HAFALAN PESERTA DIDIK MA DARUL FALAH</h3>
    <hr style="border: 0; border-top: 3px double #000;">

    <table class="no-border" style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="width: 100px;">NIS</td>
            <td style="width: 10px; text-align: center;">:</td>
            <td>{{ $kdum->siswa->nis }}</td>
        </tr>
        <tr>
            <td>Nama Siswa</td>
            <td style="text-align: center;">:</td>
            <td>{{ $kdum->siswa->nama_siswa }}</td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td style="text-align: center;">:</td>
            <td>
                {{ $kdum->siswa->kelas->nama_kelas ?? '-' }}
                ({{ $kdum->siswa->kelas->program->program ?? '-' }})
            </td>
        </tr>
        <tr>
            <td>Tahun Pelajaran</td>
            <td style="text-align: center;">:</td>
            <td>{{ $kdum->raporTerbaru->tahunPelajaran->tahun ?? '-' }}</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kompetensi Ubudiyah & Muamalah</th>
                <th>Nilai/Predikat</th>
                <th>Pembimbing/penyemak</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kdum->details as $index => $detail)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $detail->kompetensi->nama_kompetensi ?? '-' }}</td>
                <td style="text-align: center;">{{ $detail->nilai->abjad ?? '-' }}</td>
                <td>{{ $detail->penyemak->guru->nama_guru ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="no-border" style="margin-top: 20px;">
        <tr>
            <td style="width: 33%">&nbsp;</td>
            <td style="width: 33%">&nbsp;</td>
            <td style="width: 33%;">Sirahan, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td style="width: 33%">&nbsp;</td>
            <td style="width: 33%">&nbsp;</td>
            <td style="width: 33%">Petugas,</td>
        </tr>
        <tr>
            <td style="padding-top: 45px;">&nbsp;</td>
            <td style="padding-top: 45px;">&nbsp;</td>
            <td style="padding-top: 45px;">..................................</td>
        </tr>
    </table>

    @if (!$loop->last)
        <div class="page-break"></div>
    @endif
@endforeach

</body>
</html>
