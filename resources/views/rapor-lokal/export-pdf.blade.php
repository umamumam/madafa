<?php
function terbilang($x)
{
    $x = abs($x);
    $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
    $temp = "";

    if ($x < 12) {
        $temp = $angka[$x];
    } else if ($x < 20) {
        $temp = terbilang($x - 10) . " belas";
    } else if ($x < 100) {
        $temp = terbilang(floor($x / 10)) . " puluh " . terbilang($x % 10);
    } else if ($x < 200) {
        $temp = "seratus " . terbilang($x - 100);
    } else if ($x < 1000) {
        $temp = terbilang(floor($x / 100)) . " ratus " . terbilang($x % 100);
    } else if ($x < 2000) {
        $temp = "seribu " . terbilang($x - 1000);
    } else if ($x < 1000000) {
        $temp = terbilang(floor($x / 1000)) . " ribu " . terbilang($x % 1000);
    } else if ($x < 1000000000) {
        $temp = terbilang(floor($x / 1000000)) . " juta " . terbilang($x % 1000000);
    }

    return trim(preg_replace('/\s+/', ' ', $temp));
}
function predikatNilai($nilai, $kkm) {
    if (is_null($nilai)) return '-';

    if ($kkm == 65) {
        if ($nilai <= 64) return 'D';
        if ($nilai <= 70) return 'C';
        if ($nilai <= 79) return 'B';
        return 'A';
    }

    return null;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rapor PDF</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        h3 { margin-bottom: 15px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <h3>Rapor Lokal - {{ $rapor->siswa->nama_siswa }}</h3>
    <p><strong>NIS:</strong> {{ $rapor->siswa->nis }}</p>
    <p><strong>Nama:</strong> {{ $rapor->siswa->nama_siswa }}</p>
    <p><strong>Jenis Kelamin:</strong> {{ $rapor->siswa->jenisKelamin->jeniskelamin ?? '-' }}</p>
    <p><strong>Kelas:</strong> {{ $rapor->kelas->nama_kelas }} ({{ $rapor->semester }} / {{ $rapor->semester == 1 ? 'Gasal' : 'Genap' }})</p>
    <p><strong>Tahun Pelajaran:</strong> {{ $rapor->tahunPelajaran->tahun }}</p>

    <h4>Nilai Mata Pelajaran</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>KKM</th>
                <th>Nilai Mapel</th>
                <th>Huruf</th>
                <th>Predikat Mapel</th>
                <th>Keterangan</th>
                <th>Rata-rata</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rapor->details as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->mapel->mapel }}</td>
                <td>{{ $detail->mapel->kkm }}</td>
                <td>{{ $detail->jumlah ?? '-' }}</td>
                <td>{{ $detail->jumlah ? ucwords(terbilang($detail->jumlah)) : '-' }}</td>
                <td>
                    @php
                        $kkm = $detail->mapel->kkm;
                        $nilai = $detail->jumlah;
                        $abjad = $kkm == 65 ? predikatNilai($nilai, $kkm) : ($detail->nilai->abjad ?? '-');
                    @endphp
                    {{ $abjad }}
                </td>
                <td>{{ $detail->keterangan ?? '-' }}</td>
                <td>{{ $detail->rata_rata ?? '-' }}</td>
            </tr>
            @endforeach

            @if($rapor->details->isEmpty())
            <tr>
                <td colspan="8" class="text-center text-muted">Belum ada data detail.</td>
            </tr>
            @else
            @php
                $avg = collect($rapor->details)->pluck('jumlah')->filter()->avg();
            @endphp
            <tr>
                <td colspan="3" class="text-right"><strong>Nilai Rata-rata Keseluruhan</strong></td>
                <td colspan="5" class="text-center">{{ number_format($avg) }}</td>
            </tr>
            @endif
        </tbody>
    </table>

    <h4>Nilai dan Keterangan Lainnya</h4>
    <table>
        <thead>
            <tr>
                <th colspan="2">Nilai dan Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Nilai Spiritual:</strong></td>
                <td>{{ $rapor->nilaiSpiritual->abjad ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Deskripsi Spiritual:</strong></td>
                <td>{{ $rapor->deskripsi_spiritual }}</td>
            </tr>
            <tr>
                <td><strong>Nilai Sosial:</strong></td>
                <td>{{ $rapor->nilaiSosial->abjad ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Deskripsi Sosial:</strong></td>
                <td>{{ $rapor->deskripsi_sosial }}</td>
            </tr>
            <tr>
                <td><strong>Ekstrakurikuler:</strong></td>
                <td>{{ $rapor->ekstrakurikuler->ekskul ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Nilai Ekstrakurikuler:</strong></td>
                <td>{{ $rapor->nilaiEkstra->abjad ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Sakit:</strong></td>
                <td>{{ $rapor->sakit ?? '-' }} Hari</td>
            </tr>
            <tr>
                <td><strong>Izin:</strong></td>
                <td>{{ $rapor->izin ?? '-'}} Hari</td>
            </tr>
            <tr>
                <td><strong>Tanpa Keterangan:</strong></td>
                <td>{{ $rapor->tanpa_keterangan ?? '-' }} Hari</td>
            </tr>
            <tr>
                <td><strong>Catatan:</strong></td>
                <td>{{ $rapor->catatan }}</td>
            </tr>
            <tr>
                <td><strong>Keterangan:</strong></td>
                <td>{{ $rapor->keterangan->ket ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Wali Kelas:</strong></td>
                <td>{{ $rapor->walikelas->nama_guru ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Kepala Madrasah:</strong></td>
                <td>{{ $rapor->kepalaMadrasah->nama_guru ?? '-' }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
