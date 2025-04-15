<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rapor PDF</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h3>Rapor Lokal - {{ $rapor->siswa->nama_siswa }}</h3>
    <p><strong>NIS:</strong> {{ $rapor->siswa->nis }}</p>
    <p><strong>Kelas:</strong> {{ $rapor->kelas->nama_kelas }}</p>
    <p><strong>Tahun Pelajaran:</strong> {{ $rapor->tahunPelajaran->tahun }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>Nilai</th>
                <th>Predikat</th>
                <th>Jumlah</th>
                <th>Rata-rata</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rapor->details as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->mapel->mapel }}</td>
                <td>{{ $detail->nilai->abjad ?? '-' }}</td>
                <td>{{ $detail->keterangan ?? '-' }}</td>
                <td>{{ $detail->jumlah ?? '-' }}</td>
                <td>{{ $detail->rata_rata ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
