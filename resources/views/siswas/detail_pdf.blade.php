<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulir Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h4 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 6px; vertical-align: top; }
        .table-bordered td { border: 1px solid #000; }
        .mt-4 { margin-top: 30px; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .signature { width: 45%; display: inline-block; }
    </style>
</head>
<body>

    <h4>FORMULIR PESERTA DIDIK BARU</h4>

    <table>
        <tr>
            <td width="30%">NISN</td>
            <td>: {{ $siswa->nisn }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: {{ $siswa->nik }}</td>
        </tr>
        <tr>
            <td>Nama Lengkap</td>
            <td>: {{ $siswa->nama_siswa }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: {{ $siswa->jeniskelamin->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td>Tempat, Tanggal Lahir</td>
            <td>: {{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>: {{ $siswa->agama }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ $siswa->alamat }}</td>
        </tr>
        <tr>
            <td>Nama Ayah</td>
            <td>: {{ $siswa->nama_ayah }}</td>
        </tr>
        <tr>
            <td>Nama Ibu</td>
            <td>: {{ $siswa->nama_ibu }}</td>
        </tr>
        <tr>
            <td>Asal Sekolah</td>
            <td>: {{ $siswa->asal_sekolah }}</td>
        </tr>
        <tr>
            <td>No HP</td>
            <td>: {{ $siswa->nohp }}</td>
        </tr>
    </table>

    <div class="mt-4">
        <div class="signature text-left">
            <p>Orang Tua/Wali</p>
            <br><br><br>
            <p>____________________</p>
        </div>

        <div class="signature text-right" style="float: right;">
            <p>Yang Mengisi</p>
            <br><br><br>
            <p>____________________</p>
        </div>
    </div>

</body>
</html>
