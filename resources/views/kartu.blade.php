<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kartu Ujian MA Darul Falah</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: 'times', serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }

        .container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding: 10px;
            gap: 10px;
            box-sizing: border-box;
            height: auto;
            page-break-inside: avoid;
        }

        .logo-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 5px;
        }

        .logo {
            width: 50px;
            height: auto;
            margin-right: 10px;
        }

        .title-text {
            margin-left: 10px;
        }

        h2,
        h3 {
            margin: 2px 0;
        }

        p {
            margin: 2px 0;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        td,
        th {
            border: 1px solid #000;
            padding: 2px;
            text-align: left;
        }

        .photo-box {
            width: 80px;
            height: 100px;
            border: 1px solid #000;
            text-align: center;
            line-height: 100px;
            font-size: 12px;
            margin-top: 5px;
        }

        .signature {
            margin-top: 20px;
            text-align: right;
            font-size: 12px;
        }

        .keterangan {
            font-size: 12px;
            margin-top: 8px;
        }

        /* Remove border from the logo section */
        .logo-section {
            border: none;
        }
    </style>
</head>

<body>
    <table width="100%" style="border-collapse: collapse; padding: 10px;">
        <tr>
            <!-- Kartu Peserta -->
            <td style="width: 50%; vertical-align: top; padding-right: 5px;">
                <table style="width: 100%; border: none;" class="logo-section">
                    <tr>
                        <td style="width: 50px; vertical-align: top; border: none;">
                            <img src="logo.png" alt="Logo" style="width: 50px;">
                        </td>
                        <td style="text-align: left; vertical-align: middle; border: none;">
                            <h4 style="margin: 0;">PANITIA PPDB TAHUN PELAJARAN {{ $riwayat->tahunPelajaran->tahun }}</h4>
                            <h3 style="margin: 0;">MA DARUL FALAH</h3>
                            <h4 style="margin: 0;">Sirahan Cluwak Pati</h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border: none;">Alamat : Jln. Raya Tayu Jepara Km. 18 Sirahan Cluwak Pati
                            Telp. (0291) 4277748</td>
                    </tr>
                </table>
                <hr>
                <h4 style="text-align: center;">KARTU PESERTA UJIAN KOMPETENSI SISWA BARU</h4>
                <table style="width: 95%; font-size: 12px; margin: 10px; border: none; border-collapse: collapse;">
                    <tr style="border: none;">
                        <td style="width: 15%; vertical-align: top; border: none;"><strong>Nomor</strong></td>
                        <td style="width: 2%; vertical-align: top; border: none;">:</td>
                        <td style="border: none;">{{ $siswa->no_pendaftaran ?? '-' }}</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="vertical-align: top; border: none;"><strong>Nama</strong></td>
                        <td style="vertical-align: top; border: none;">:</td>
                        <td style="border: none;">{{ $siswa->nama_siswa }}</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="vertical-align: top; border: none;"><strong>Alamat</strong></td>
                        <td style="vertical-align: top; border: none;">:</td>
                        <td style="border: none;">{{ $siswa->alamat }}</td>
                    </tr>
                </table>

                @php
                $path = storage_path('app/public/' . $siswa->foto);
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                @endphp

                <table style="width: 100%; border: none; border-collapse: collapse; margin-top: 10px;">
                    <tr style="border: none;">
                        <td style="width: 50%; border: none; vertical-align: top;">
                            <img src="{{ $base64 }}" alt="Foto Siswa"
                                style="width: 3cm; height: 4cm; margin-left:10px;">
                        </td>
                        <td style="border: none; text-align: left; vertical-align: top;">
                            <br>
                            <div style="font-size: 12px;">
                                Sirahan, {{ $tanggal }}<br>
                                Ketua Panitia,<br><br><br><br><br>
                                <strong>Muhammad Aziz, M.Pd.</strong>
                            </div>
                        </td>
                    </tr>
                </table>

            </td>

            <!-- Jadwal Ujian -->
            <td style="width: 50%; vertical-align: top; padding-left: 5px;">
                <br>
                <h4 style="text-align: center;">
                    JADWAL UJIAN KOMPETENSI SISWA BARU <br>
                    MA DARUL FALAH SIRAHAN CLUWAK PATI <br>
                    TAHUN PELAJARAN 2024/2025
                </h4>
                <table>
                    <thead>
                        <tr>
                            <th style="text-align: center; width: 3%;">No</th>
                            <th style="text-align: center; width: 20%;">Hari/ Tanggal</th>
                            <th style="text-align: center; width: 5%;">Jam Ke</th>
                            <th style="text-align: center; width: 17%;">Waktu</th>
                            <th style="text-align: center; width: 15%;">Mapel</th>
                            <th style="text-align: center;">Materi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ujian as $index => $ujianItem)
                            <!-- Untuk Ujian pertama dengan id 1 -->
                            @if($index == 0)
                                <tr>
                                    <td rowspan="2" style="text-align: center;">{{ $index + 1 }}</td>
                                    <td rowspan="2">{{ \Carbon\Carbon::parse($ujianItem->tanggal)->locale('id')->translatedFormat('l, d F Y') }}</td>
                                    <td style="text-align: center;">1</td>
                                    <td>07:30 - 09:00</td>
                                    <td>Fiqih</td>
                                    <td>Fathul Qorib (Ubudiyah dan Muamalah)</td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">2</td>
                                    <td>09:30 - 11:00</td>
                                    <td>Bahasa Arab</td>
                                    <td>Bhs. Arab MTs, Nahwu/Sorof Alfiyah Ibnu Malik</td>
                                </tr>
                            @endif

                            <!-- Untuk Ujian kedua dengan id 2 -->
                            @if($index == 1)
                                <tr>
                                    <td rowspan="2" style="text-align: center;">{{ $index + 1 }}</td>
                                    <td rowspan="2">{{ \Carbon\Carbon::parse($ujianItem->tanggal)->locale('id')->translatedFormat('l, d F Y') }}</td>
                                    <td style="text-align: center;">1</td>
                                    <td>07:30 - 09:00</td>
                                    <td>BTA</td>
                                    <td>Al Qur’an Juz 30</td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">2</td>
                                    <td>09:30 - 11:00</td>
                                    <td>Wawancara</td>
                                    <td>Minat, Bakat, Kepribadian, Spiritual & Sosial</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>

                </table>
                <div class="keterangan">
                    <b>Keterangan :</b><br>
                    * Kartu ini harus dibawa selama ujian seleksi berlangsung. <br>
                    * Apabila kartu ini rusak, hilang atau ketinggalan harus segera melaporkannya kepada panitia ujian.
                </div>
                <div style="text-align: right; font-size: 10px; margin-top: 20px;">PPDB MASDAFA {{ $riwayat->tahunPelajaran->tahun }}</div>
            </td>
        </tr>
    </table>
</body>

</html>
