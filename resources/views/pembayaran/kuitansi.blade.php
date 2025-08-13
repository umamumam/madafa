<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Kuitansi Pembayaran</title>
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
            /* sedikit dirapatkan */
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
            /* lebih rapat */
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
            /* dirapatkan */
            margin-top: 8px;
            width: fit-content;
        }

        .footer {
            margin-top: 20px;
            /* dirapatkan */
            display: flex;
            justify-content: space-between;
        }

        .footer .right {
            text-align: right;
        }

        .catatan {
            font-size: 10px;
            margin-top: 6px;
            /* lebih rapat */
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
            /* dirapatkan */
        }

        .pt-1 {
            padding-top: 3px;
        }

        .garis {
            border-top: 1px solid #000;
            margin-top: 4px;
            width: 200px;
        }

        /* Tambahan spacing tweak di kolom kiri */
        .left-column div>br {
            line-height: 12px;
            /* rapat antar <br> */
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
                        No. : <br>
                        <span class="bold">{{ $pembayaran->siswa->nis }}</span><br>
                        <span class="bold">{{ $pembayaran->siswa->kelas ? $pembayaran->siswa->kelas->nama_kelas : ''
                            }}</span><br><br>
                        <span class="bold">{{ strtoupper($pembayaran->siswa->nama_siswa) }}</span><br><br>
                        {{ $pembayaran->keterangan }}<br><br>
                        <hr>
                        <div class="bold italic">{{ number_format($total, 0, ',', '.') }}</div>
                        <hr>
                        <div class="pt-1">
                            <i>{{ $pembayaran->guru->nama_guru ?? 'Petugas Belum Dipilih' }}</i><br>
                            {{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->format('d/m/Y') }}
                        </div>
                    </div>
                </td>

                <!-- Kolom kanan -->
                <td class="right-column">
                    <div class="judul-kuitansi">K U I T A N S I</div>
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 30%;">NIS</td>
                            <td>: {{ $pembayaran->siswa->nis }}</td>
                        </tr>
                        <tr>
                            <td>Nama & Kelas</td>
                            <td>: <span class="bold">{{ strtoupper($pembayaran->siswa->nama_siswa) }} {{
                                    $pembayaran->siswa->kelas ? $pembayaran->siswa->kelas->nama_kelas : '' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: {{ $pembayaran->siswa->alamat }}</td>
                        </tr>
                        <tr>
                            <td>Guna Membayar</td>
                            <td>: {{ $pembayaran->keterangan }}</td>
                        </tr>
                    </table>

                    <div class="mt-2 bold">Jumlah Bayar Cash/Transfer</div>
                    <div class="box-nominal">
                        <span class="nominal-besar">Rp{{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <div class="footer">
                        <div></div>
                        <div class="right">
                            Sirahan, {{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->format('d F Y') }}<br>
                            Penerima,<br><br><br>
                            {{ $pembayaran->petugas ?? 'Petugas Belum Dipilih' }}
                        </div>
                    </div>

                    <div class="catatan">|Pembiayaan|masdafa|{{ $tahun_pelajaran }}</div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
