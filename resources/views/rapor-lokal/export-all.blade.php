<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Semua Rapor</title>
    <style>
        body {
            font-family: 'Amiri', sans-serif;
            font-size: 12px;
            margin: 10px;
            line-height: 1.2;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 5px 0;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .no-border td {
            border: none;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>

    @php
    function terbilang($x) {
    $x = abs($x);
    $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
    if ($x < 12) return $angka[$x]; if ($x < 20) return terbilang($x - 10) . " belas" ; if ($x < 100) return
        terbilang(floor($x / 10)) . " puluh " . terbilang($x % 10); if ($x < 200) return "seratus " . terbilang($x -
        100); if ($x < 1000) return terbilang(floor($x / 100)) . " ratus " . terbilang($x % 100); if ($x < 2000)
        return "seribu " . terbilang($x - 1000); if ($x < 1000000) return terbilang(floor($x / 1000)) . " ribu " .
        terbilang($x % 1000); if ($x < 1000000000) return terbilang(floor($x / 1000000)) . " juta " . terbilang($x %
        1000000); return '' ; } function predikatNilai($nilai, $kkm) { if (is_null($nilai)) return '-' ; if ($kkm==65) {
        if ($nilai <=64) return 'D' ; if ($nilai <=70) return 'C' ; if ($nilai <=79) return 'B' ; return 'A' ; }
        return '-' ; } @endphp @foreach($rapors as $rapor) <hr style="margin: 0; border: 2px solid #000000;">
        <table class="no-border" style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 2px; width: 15%;">Nama</td>
                <td style="padding: 2px; width: 1%;">:</td>
                <td style="padding: 2px; width: 44%;"><b>{{ $rapor->siswa->nama_siswa }}</b></td>

                <td style="padding: 2px; width: 15%;">Kelas / Semester</td>
                <td style="padding: 2px; width: 1%;">:</td>
                <td style="padding: 2px; width: 24%;">{{ $rapor->kelas->nama_kelas }} / {{ $rapor->semester == 1 ?
                    'Gasal' :
                    'Genap' }}</td>
            </tr>
            <tr>
                <td style="padding: 2px;">NIS/NISN</td>
                <td style="padding: 2px;">:</td>
                <td style="padding: 2px;">{{ $rapor->siswa->nis }} / {{ $rapor->siswa->nisn }}</td>

                <td style="padding: 2px;">Peminatan</td>
                <td style="padding: 2px;">:</td>
                <td style="padding: 2px;">{{ $rapor->kelas->program->program }}</td>
            </tr>
            <tr>
                <td style="padding: 2px;">Madrasah</td>
                <td style="padding: 2px;">:</td>
                <td style="padding: 2px;">MA DARUL FALAH</td>

                <td style="padding: 2px;">Tahun Pelajaran</td>
                <td style="padding: 2px;">:</td>
                <td style="padding: 2px;">{{ $rapor->tahunPelajaran->tahun }}</td>
            </tr>
        </table>
        <hr style="margin: 5px 0; border: 2px solid #000000;">

        <b>A. NILAI PENGETAHUAN</b><br>
        <label>&nbsp;&nbsp;&nbsp;&nbsp;KKM SATUAN KELAS : 69</label>
        <table style="margin-left: 15px; margin-right: 15px;">
            <thead>
                <tr>
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center; width: 30%;">Mata Pelajaran</th>
                    <th style="text-align: center;">KKM Mapel</th>
                    <th style="text-align: center;">Nilai Mapel</th>
                    <th style="text-align: center; width: 25%;">Huruf</th>
                    <th style="text-align: center;">Predikat Mapel</th>
                    <th style="text-align: center;">Rata<sup>2</sup> Kelas</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                $total = 0;
                $count = 0;
                @endphp
                @foreach($rapor->details as $detail)
                @if(!Str::contains(Str::lower($detail->mapel->mapel), 'faroid'))
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $detail->mapel->mapel }}</td>
                    <td class="text-center">{{ $detail->mapel->kkm }}</td>
                    <td class="text-center">{{ $detail->jumlah ?? '-' }}</td>
                    <td>{{ $detail->jumlah ? ucwords(terbilang($detail->jumlah)) : '-' }}</td>
                    <td class="text-center">
                        @php
                        $kkm = $detail->mapel->kkm;
                        $nilai = $detail->jumlah;
                        $abjad = $kkm == 65 ? predikatNilai($nilai, $kkm) : ($detail->nilai->abjad ?? '-');
                        @endphp
                        {{ $abjad }}
                    </td>
                    <td class="text-center">{{ $detail->rata_rata ?? '-' }}</td>
                </tr>
                @php
                if ($detail->jumlah) {
                $total += $detail->jumlah;
                $count++;
                }
                @endphp
                @endif
                @endforeach
                <tr>
                    <td colspan="3"><strong>Nilai Rata-rata</strong></td>
                    <td class="text-center">{{ $count > 0 ? number_format($total / $count, 2) : '-' }}</td>
                    <td>{{ $count > 0 ? ucwords(terbilang(round($total / $count))) : '-' }}</td>
                    <td colspan="2"></td>
                </tr>
            </tbody>
        </table>

        <b>B. NILAI HAFALAN</b>
        <table style="margin-left: 15px; margin-right: 15px;">
            <tbody>
                @php $no = 1; @endphp
                @foreach($rapor->details as $detail)
                @if(Str::contains(Str::lower($detail->mapel->mapel), 'faroid'))
                <tr>
                    <td style="text-align: center; width: 4%;">{{ $no++ }}</td>
                    <td style="width: 30%;">{{ $detail->mapel->mapel }}</td>
                    <td style="text-align: center; width: 10.5%;">{{ $detail->mapel->kkm }}</td>
                    <td style="text-align: center; width: 10%;">{{ $detail->jumlah ?? '-' }}</td>
                    <td style="width: 25%;">{{ $detail->jumlah ? ucwords(terbilang($detail->jumlah)) : '-' }}</td>
                    <td style="text-align: center; width: 11%;">
                        @php
                        $kkm = $detail->mapel->kkm;
                        $nilai = $detail->jumlah;
                        $abjad = $kkm == 65 ? predikatNilai($nilai, $kkm) : ($detail->nilai->abjad ?? '-');
                        @endphp
                        {{ $abjad }}
                    </td>
                    <td style="text-align: center; width: 9.5%;">{{ $detail->rata_rata ?? '-' }}</td>
                </tr>
                @endif
                @endforeach
                @php
                $filtered = collect($rapor->details)->filter(fn($d) =>
                Str::contains(Str::lower($d->mapel->mapel), 'faroid')
                );
                @endphp
                @if($filtered->isEmpty())
                <tr>
                    <td colspan="8" class="text-center text-muted">Belum ada data detail hafalan (faroid).</td>
                </tr>
                @else
                @php
                $avg = $filtered->pluck('jumlah')->filter()->avg();
                @endphp
                @endif
            </tbody>
        </table>
        <b>c. SIKAP SPIRITUAL</b>
        <table style="margin-left: 15px; margin-right: 15px;">
            <thead>
                <tr>
                    <th style="text-align: center; width: 15%;">Predikat</th>
                    <th style="text-align: center; width: 85%;">Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">{{ $rapor->nilaiSpiritual->keterangan ?? '-' }}</td>
                    <td>{{ $rapor->deskripsi_spiritual }}</td>
                </tr>
            </tbody>
        </table>
        <b>d. SIKAP SOSIAL</b>
        <table style="margin-left: 15px; margin-right: 15px;">
            <thead>
                <tr>
                    <th style="text-align: center; width: 15%;">Predikat</th>
                    <th style="text-align: center; width: 85%;">Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">{{ $rapor->nilaiSosial->keterangan ?? '-' }}</td>
                    <td>{{ $rapor->deskripsi_sosial }}</td>
                </tr>
            </tbody>
        </table>
        <b>e. PENGEMBANGAN DIRI</b>
        <table style="margin-left: 15px; margin-right: 15px;">
            <thead>
                <tr>
                    <th style="text-align: center; width: 4%;">No</th>
                    <th>Jenis Ekstra</th>
                    <th style="text-align: center; width: 15%;">Predikat</th>
                    <th style="text-align: center;">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                <tr>
                    <td style="text-align: center;">{{ $no++ }}</td>
                    <td>{{ $rapor->ekstrakurikuler->ekskul ?? '-' }}</td>
                    <td style="text-align: center;">{{ $rapor->nilaiEkstra->keterangan ?? '-' }}</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align: center;">{{ $no++ }}</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align: center;">{{ $no++ }}</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align: center;">{{ $no++ }}</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>
        <b>F. KETIDAKHADIRAN</b>
        <table style="width: 100%; border-collapse: collapse; margin-left: 15px; margin-right: 15px;">
            <thead>
                <tr>
                    <th style="text-align: center; width: 7%; border: 1px solid #000;">No</th>
                    <th style="text-align: center; width: 30%; border: 1px solid #000;">Alasan</th>
                    <th style="text-align: center; width: 25%; border: 1px solid #000;">Keterangan</th>
                    <td colspan="2" style="width: 8%; border: none;"></td>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                <tr>
                    <td style="text-align: center; border: 1px solid #000;">{{ $no++ }}</td>
                    <td style="border: 1px solid #000;">Sakit</td>
                    <td style="border: 1px solid #000;">{{ $rapor->sakit ?? '-' }} Hari</td>
                    <td style="border: none;">&nbsp;</td>
                    <td rowspan="3" id="keputusan-cell" style="border: none;">
                        @if(!empty($rapor->ket->ket))
                            <b>Keputusan</b><br>
                            <label>
                                Berdasarkan hasil yang dicapai pada semester 1 dan 2,<br>
                                peserta didik dinyatakan:<br>
                                <b>{{ $rapor->ket->ket }}</b>
                            </label>
                            <script>
                                document.getElementById('keputusan-cell').style.display = 'table-cell';
                            </script>
                        @else
                            <script>
                                document.getElementById('keputusan-cell').style.display = 'none';
                            </script>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; border: 1px solid #000;">{{ $no++ }}</td>
                    <td style="border: 1px solid #000;">Izin</td>
                    <td style="border: 1px solid #000;">{{ $rapor->izin ?? '-' }} Hari</td>
                </tr>
                <tr>
                    <td style="text-align: center; border: 1px solid #000;">{{ $no++ }}</td>
                    <td style="border: 1px solid #000;">Tanpa Keterangan</td>
                    <td style="border: 1px solid #000;">{{ $rapor->tanpa_keterangan ?? '-' }} Hari</td>
                </tr>
            </tbody>
        </table>

        <b>G. CATATAN WALI KELAS</b><br>
        <table style="margin-left: 15px; margin-right: 15px;">
            <tr>
                <td>{{ $rapor->catatan }}</td>
            </tr>
        </table>
        <table class="no-border">
            <tr>
                <td style="width: 33%">&nbsp;</td>
                <td style="width: 33%">&nbsp;</td>
                <td style="width: 33%; text-align: center;">Sirahan, {{ date('d F Y') }}</td>
            </tr>
            <tr>
                <td style="width: 33%; text-align: center;">Orang Tua / Wali, <br>Peserta Didik</td>
                <td style="width: 33%; text-align: center;">Mengetahui, <br> Kepala Madrasah</td>
                <td style="width: 33%; text-align: center;">Wali Kelas</td>
            </tr>
            <tr>
                <td style="width: 33%; padding-top: 45px; text-align: center;">__________________________________</td>
                <td style="width: 33%; padding-top: 45px; text-align: center;">{{ $rapor->kepalaMadrasah->nama_guru ?? '-' }}</td>
                <td style="width: 33%; padding-top: 45px; text-align: center;">{{ $rapor->walikelas->nama_guru ?? '-' }}</td>
            </tr>
        </table>
        <div class="page-break"></div>
        @endforeach

</body>

</html>
