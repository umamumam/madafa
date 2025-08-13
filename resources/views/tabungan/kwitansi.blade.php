<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Kuitansi Tabungan</title>
    <style>
        @page {
            margin: 0.5cm;
        }
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            padding: 0;
            margin-right: 20px;
        }

        .container {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .left-column {
            width: 30%;
            border-right: 1px solid black;
            vertical-align: top;
            padding-right: 8px;
        }

        .right-column {
            width: 70%;
            padding-left: 8px;
            vertical-align: top;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        .italic {
            font-style: italic;
        }

        .judul-kuitansi {
            text-align: center;
            font-weight: bold;
            letter-spacing: 5px;
            margin-bottom: 6px;
            margin-top: 2px;
        }

        .box-nominal {
            border: 1px solid #000;
            background: repeating-linear-gradient(45deg,
                    #f0f0f0,
                    #f0f0f0 5px,
                    #fff 5px,
                    #fff 10px);
            padding: 8px;
            margin-top: 8px;
            width: fit-content;
        }

        .footer {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .footer .right {
            text-align: right;
        }

        .catatan {
            font-size: 10px;
            margin-top: 6px;
            border-top: 1px solid #000;
            padding-top: 2px;
        }

        .nominal-besar {
            font-style: italic;
            font-weight: bold;
            font-size: 16px;
        }

        .mt-2 {
            margin-top: 6px;
        }

        .pt-1 {
            padding-top: 3px;
        }

        .garis {
            border-top: 1px solid #000;
            margin-top: 4px;
            width: 200px;
        }

        .left-column div>br {
            line-height: 12px;
        }
    </style>

</head>

<body>
    <div class="container">
        <table>
            <tr>
                <!-- Kolom kiri -->
                <td class="left-column text-center">
                    <div class="text-left">
                        No. : {{ $tabungan->id }}<br>
                        <span class="bold">{{ $siswa->nis }}</span><br>
                        <span class="bold">{{ $siswa->kelas ? $siswa->kelas->nama_kelas : '' }}</span><br><br>
                        <span class="bold">{{ strtoupper($siswa->nama_siswa) }}</span><br><br>
                        {{-- Keterangan pembayaran tidak ada di tabungan, jadi ini bisa dikosongkan atau dihapus --}}
                        <br><br>
                        <hr>
                        <div class="bold italic">Rp{{ number_format($tabungan->jumlah_setor, 0, ',', '.') }}</div>
                        <hr>
                        <div class="pt-1">
                            <i>{{ $petugasPencatat }}</i><br>
                            {{ \Carbon\Carbon::parse($tabungan->tgl_setor)->format('d/m/Y') }}
                        </div>
                    </div>
                </td>

                <!-- Kolom kanan -->
                <td class="right-column">
                    <div class="judul-kuitansi">SLIP STORAN</div>
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 30%;">NIS</td>
                            <td>: {{ $siswa->nis }}</td>
                        </tr>
                        <tr>
                            <td>Nama & Kelas</td>
                            <td>: <span class="bold">{{ strtoupper($siswa->nama_siswa) }} {{
                                    $siswa->kelas ? $siswa->kelas->nama_kelas : '' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: {{ $siswa->alamat ?? '-' }}</td>
                        </tr>
                        {{-- Bagian "Guna Membayar" dihapus --}}
                    </table>

                    <div class="mt-2 bold">Jumlah Setor Cash/Transfer</div>
                    <div class="box-nominal">
                        <span class="nominal-besar">Rp{{ number_format($tabungan->jumlah_setor, 0, ',', '.') }}</span>
                    </div>

                    <div class="mt-2 bold">Saldo Setelah Setor</div>
                    <div class="box-nominal">
                        <span class="nominal-besar">Rp{{ number_format($saldoSetelahSetorIni, 0, ',', '.') }}</span>
                    </div>

                    <div class="footer">
                        <div></div>
                        <div class="right">
                            Sirahan, {{ \Carbon\Carbon::parse($tabungan->tgl_setor)->format('d F Y') }}<br>
                            Penerima,<br><br><br>
                            {{ $petugasPencatat }}
                        </div>
                    </div>

                    <div class="catatan">|Tabungan|masdafa|{{ $tahunPelajaran->tahun ?? '-' }}</div>
                </td>
            </tr>
        </table>
    </div>

    @php
        // Fungsi terbilang sederhana (Anda bisa menggunakan package jika lebih kompleks)
        function terbilang($angka) {
            $angka = abs($angka);
            $baca = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas');
            $temp = '';
            if ($angka < 12) {
                $temp = ' ' . $baca[$angka];
            } elseif ($angka < 20) {
                $temp = terbilang($angka - 10) . ' belas';
            } elseif ($angka < 100) {
                $temp = terbilang($angka / 10) . ' puluh' . terbilang($angka % 10);
            } elseif ($angka < 200) {
                $temp = ' seratus' . terbilang($angka - 100);
            } elseif ($angka < 1000) {
                $temp = terbilang($angka / 100) . ' ratus' . terbilang($angka % 100);
            } elseif ($angka < 2000) {
                $temp = ' seribu' . terbilang($angka - 1000);
            } elseif ($angka < 1000000) {
                $temp = terbilang($angka / 1000) . ' ribu' . terbilang($angka % 1000);
            } elseif ($angka < 2000000000) { // Diperbaiki untuk rentang yang lebih besar
                $temp = terbilang($angka / 1000000) . ' juta' . terbilang($angka % 1000000);
            } elseif ($angka < 1000000000000) {
                $temp = terbilang($angka / 1000000000) . ' milyar' . terbilang(fmod($angka, 1000000000));
            } elseif ($angka < 1000000000000000) {
                $temp = terbilang($angka / 1000000000000) . ' triliun' . terbilang(fmod($angka, 1000000000000));
            }
            return $temp;
        }
    @endphp
</body>

</html>
