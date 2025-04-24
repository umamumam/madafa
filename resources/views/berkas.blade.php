<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body {
        font-family: 'Times New Roman', Times, serif;
        font-size: 14px;
    }

    .container {
        width: 90%;
        margin: 0 auto;
    }

    h3 {
        text-align: center;
        margin-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    .table-sm td {
        padding: 4px 8px;
        vertical-align: top;
    }

    .table-borderless td {
        border: none !important;
    }

    .table-bordered,
    .table-bordered th,
    .table-bordered td {
        border: 1px solid #000;
    }

    .table-bordered th,
    .table-bordered td {
        padding: 5px;
    }

    .table-bordered th {
        background-color: #f2f2f2;
    }

    input[type="checkbox"] {
        transform: scale(1.1);
        margin: 0;
    }

    .row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-top: 30px;
    }

    .col-md-4 {
        width: 32%;
        text-align: center;
    }

    .col-md-4 p {
        margin: 3px 0;
        line-height: 1.2;
    }

    .mb-3 {
        margin-bottom: 0.75rem;
    }

    .mb-4 {
        margin-bottom: 1rem;
    }

    .mt-4 {
        margin-top: 1rem;
    }

    .mt-5 {
        margin-top: 2rem;
    }

    .page-break {
        page-break-after: always;
    }
</style>

<body>
    <div class="container mt-4">
        <h3 class="text-center mb-4">FORMULIR PESERTA DIDIK BARU</h3>

        <table class="table table-sm table-borderless mb-4 mt-5">
            <tr>
                <td width="2%">1.</td>
                <td width="25%">No Pendaftaran</td>
                <td width="2%">:</td>
                <td>{{ $siswa->no_pendaftaran ?? '-' }}</td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Nama Siswa</td>
                <td>:</td>
                <td>{{ $siswa->nama_siswa }}</td>
            </tr>
            <tr>
                <td>3.</td>
                <td>NISN</td>
                <td>:</td>
                <td>{{ $siswa->nis }}</td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $siswa->jeniskelamin->jeniskelamin ?? '-' }}</td>
            </tr>
            <tr>
                <td>5.</td>
                <td>Tempat & Tgl. Lahir</td>
                <td>:</td>
                <td>{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tgl_lahir)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td>6.</td>
                <td>Nama Ayah</td>
                <td>:</td>
                <td>{{ $siswa->nama_ayah }}</td>
            </tr>
            <tr>
                <td>7.</td>
                <td>Nama Ibu</td>
                <td>:</td>
                <td>{{ $siswa->nama_ibu }}</td>
            </tr>
            <tr>
                <td>8.</td>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $siswa->alamat }}</td>
            </tr>
            <tr>
                <td>9.</td>
                <td>Telp./HP Peserta</td>
                <td>:</td>
                <td>{{ $siswa->hp_siswa }}</td>
            </tr>
            <tr>
                <td>10.</td>
                <td>Telp./HP Orang Tua</td>
                <td>:</td>
                <td>{{ $siswa->hp_ortu }}</td>
            </tr>
        </table>

        {{-- Tabel Kelengkapan Berkas --}}
        <h4 class="mb-3">KELENGKAPAN BERKAS DAN PERSYARATAN</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%" style="text-align: center;">No</th>
                    <th>Jenis Berkas</th>
                    <th width="15%" style="text-align: center;">Cek List</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">1</td>
                    <td>Kartu NISN / surat keterangan dari Madrasah/Sekolah Asal</td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">2</td>
                    <td>Fotocopy Ijazah dan SKHUN dilegalisir 2 lembar</td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">3</td>
                    <td>Fotocopy Nilai Raport Kelas 7,8 & 9 MTs/SMP dilegalisir 2 lembar</td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">4</td>
                    <td>Pas Foto 3 x 4 sebanyak 2 lembar</td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">5</td>
                    <td>Fotocopy Akte Kelahiran 2 lembar</td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">6</td>
                    <td>Foto copy Kartu Keluarga (KK) 2 Lembar</td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">7</td>
                    <td>Foto copy KTP Orang Tua/Wali 2 lembar</td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">8</td>
                    <td>Foto copy Kartu Jaminan Sosial (KIP/KIS/PKH/KKS) 2 lembar</td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">9</td>
                    <td>Uang Infaq Madrasah Rp. 800.000 / Terbayar Rp</td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">10</td>
                    <td>Lain-Lain …</td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
            </tbody>
        </table>

        {{-- Tanda Tangan --}}
        <table style="width: 100%; text-align: center; margin-top: 40px;">
            <tr>
                <td width="33%">&nbsp;</td>
                <td width="33%">&nbsp;</td>
                <td width="33%">Sirahan, {{ date('d-m-Y') }}</td>
            </tr>
            <tr>
                <td width="33%">
                    Petugas<br><br><br><br><br>
                    (........................)
                </td>
                <td width="33%">
                    Orang Tua / Wali<br><br><br><br><br>
                    (........................)
                </td>
                <td width="33%">
                    Peserta Didik Baru<br><br><br><br><br>
                    (........................)
                </td>
            </tr>
        </table>
        <div class="page-break"></div>
        <h3 class="text-center mb-4">SURAT PERNYATAAN PESERTA DIDIK BARU <br>
            TAHUN PELAJARAN 2023/2024</h3>
        <div class="mt-5" style="font-size: 16px;">
            <p>Yang bertanda tangan di bawah ini, saya :</p>
            <table style="margin-left: 30px;">
                <tr>
                    <td width="25%">Nama Siswa</td>
                    <td width="2%">:</td>
                    <td>{{ $siswa->nama_siswa }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{ $siswa->jeniskelamin->jeniskelamin ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Tempat & Tgl. Lahir</td>
                    <td>:</td>
                    <td>{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tgl_lahir)->translatedFormat('d F
                        Y') }}</td>
                </tr>
                <tr>
                    <td>Alamat siswa</td>
                    <td>:</td>
                    <td>{{ $siswa->alamat }}</td>
                </tr>
            </table>
            <p>Orang tua/wali murid : </p>
            <table style="margin-left: 30px;">
                <tr>
                    <td width="25%">Nama Orang Tua/wali</td>
                    <td width="2%">:</td>
                    <td>{{ $siswa->nama_ayah }}</td>
                </tr>
                <tr>
                    <td>Alamat Orang Tua/wali</td>
                    <td>:</td>
                    <td>{{ $siswa->alamat }}</td>
                </tr>
            </table>
            <p>Menyatakan dengan sesungguhnya, bahwa saya :</p>
            <ol style="text-align: justify">
                <li>Berniat menuntut ilmu di Perguruan Islam Darul Falah Sirahan ini hanya semata-mata karena Allah SWT.
                </li>
                <li>Bersedia untuk mentaati segala peraturan yang berlaku di Madrasah Darul Falah Sirahan.</li>
                <li>Bersedia menerima segala bentuk sanksi jika suatu saat saya melanggar aturan yang sudah ditetapkan
                    oleh madrasah.</li>
                <li>Bersedia membayar segala bentuk kontribusi/iuran yang telah ditentukan oleh pihak madrasah.</li>
                <li>Menerima segala bentuk keputusan hasil tes seleksi masuk dari Panitia Penerimaan Siswa Baru.</li>
                <li>Bersedia menjaga nama baik dan menjalin hubungan kerjasama yang baik dengan pihak Madrasah.</li>
            </ol>
            <p>Demikian surat pernyataan ini untuk dapat dipergunakan sebagaimana mestinya.</p>
            <table style="width: 100%; text-align: center; margin-top: 40px;">
                <tr>
                    <td width="33%">Mengetahui</td>
                    <td width="33%">&nbsp;</td>
                    <td width="33%">Sirahan, {{ date('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td width="33%">
                        Orang Tua / Wali<br><br><br><br><br>
                        ........................
                    </td>
                    <td style="text-align: right" width="33%">
                        <div
                            style="width: 100px; height: 60px; border: 2px solid rgb(210, 210, 210); background-color: rgba(255, 255, 255, 0.2); display: inline-block; vertical-align: top; margin-top: 10px; margin-left: 10px;">
                        </div>
                    </td>
                    <td width="33%">
                        Yang membuat pernyataan<br><br><br><br><br>
                        ........................
                    </td>
                </tr>
            </table>
        </div>
        <div class="page-break"></div>
        <div class="card">
            <img src="logo.png" alt="Logo" width="50px;">
        </div>
    </div>
</body>

</html>
