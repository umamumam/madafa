<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KDUM PDF</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 4px; }
    </style>
</head>
<body>

    <h3>Data KDUM Siswa</h3>

    <p><strong>Nama:</strong> {{ $kdum->siswa->nama_siswa }}</p>
    <p><strong>Kelas:</strong> {{ $kdum->siswa->kelas->nama_kelas ?? '-' }} ({{ $kdum->siswa->kelas->program->program ?? '-' }})</p>
    <p><strong>Tahun Pelajaran:</strong> {{ $kdum->raporTerbaru->tahunPelajaran->tahun }}</p>

    <h4>Detail Kompetensi</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kompetensi</th>
                <th>Nilai</th>
                <th>Penyemak</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kdum->details as $index => $detail)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $detail->kompetensi->nama_kompetensi ?? '-' }}</td>
                <td>{{ $detail->nilai->abjad ?? '-' }}</td>
                <td>{{ $detail->penyemak->guru->nama_guru ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
