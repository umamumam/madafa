<!DOCTYPE html>
<html>

<head>
    <title>Identitas Peserta Didik</title>
    <style>
        @page {
            margin: 0;
        }

        body {
            font-family: Times, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .biodata-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .biodata-table td,
        .biodata-table th {
            border: none;
            padding: 8px 12px;
            vertical-align: top;
        }

        .biodata-table .nomor {
            width: 30px;
            text-align: center;
            font-weight: bold;
        }

        .biodata-table .judul {
            width: 30%;
            font-weight: bold;
        }

        .biodata-table .isi {
            width: 70%;
        }

        .foto {
            width: 120px;
            text-align: center;
        }

        .foto img {
            width: 3cm;
            height: 4cm;
            object-fit: cover;
            border: 1px solid #000;
        }

        .kop-header {
            width: 100%;
            position: relative;
            top: 0;
            left: 0;
            margin: 0;
            padding: 0;
        }

        .kop-header img {
            width: 100%;
            height: auto;
            display: block;
        }

        .content {
            padding: 1.5cm;
        }
    </style>
</head>

<body>
    <div class="kop-header">
        <img src="kop dafa.jpg" alt="Kop Surat">
    </div>
    <div class="content">
        <h2>IDENTITAS PESERTA DIDIK</h2>
        <table class="biodata-table">
            <tr>
                <td>1</td>
                <td class="judul">Nama Peserta Didik</td>
                <td class="isi">: {{ $siswa->nama_siswa }}</td>
                <td class="foto" rowspan="7">
                    <img style="width: 3cm; height: 4cm;"
                        src="{{ public_path($siswa->foto ? 'storage/' . $siswa->foto : 'mantis/assets/images/user/avatar-5.jpg') }}"
                        alt="Foto siswa">
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td class="judul">NIS</td>
                <td class="isi">: {{ $siswa->nis }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td class="judul">NISN</td>
                <td class="isi">: {{ $siswa->nisn }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td class="judul">Tempat, Tgl. Lahir</td>
                <td class="isi">: {{ $siswa->tempat_lahir }}, {{
                    \Carbon\Carbon::parse($siswa->tgl_lahir)->format('d/m/Y')
                    }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td class="judul">Jenis Kelamin</td>
                <td class="isi">: {{ $siswa->jeniskelamin->jeniskelamin ?? '-' }}</td>
            </tr>
            <tr>
                <td>6</td>
                <td class="judul">Agama</td>
                <td class="isi">: Islam</td>
            </tr>
            <tr>
                <td>7</td>
                <td class="judul">Status dalam Keluarga</td>
                <td class="isi">: Anak Kandung</td>
            </tr>
            <tr>
                <td>8</td>
                <td class="judul">Anak Ke</td>
                <td class="isi" colspan="2">: {{ $siswa->anak_ke ?? '-' }}</td>
            </tr>
            <tr>
                <td>9</td>
                <td class="judul">Alamat Peserta Didik</td>
                <td class="isi" colspan="2">: {{ $siswa->alamat ?? '-' }}</td>
            </tr>
            <tr>
                <td>10</td>
                <td class="judul">Nomor Telepon Rumah/HP</td>
                <td class="isi" colspan="2">: {{ $siswa->no_hp ?? '-' }}</td>
            </tr>
            <tr>
                <td>11</td>
                <td class="judul">Sekolah Asal</td>
                <td class="isi" colspan="2">: {{ $siswa->asal_sekolah ?? '-' }}</td>
            </tr>
            <tr>
                <td rowspan="3">12</td>
                <td class="judul" colspan="3">Diterima di sekolah ini</td>
            </tr>
            <tr>
                <td>a. Di Kelas</td>
                <td colspan="2">: X</td>
            </tr>
            <tr>
                <td>b. Pada Tanggal</td>
                <td class="isi" colspan="2">: {{ \Carbon\Carbon::parse($siswa->created_at)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td rowspan="3">13</td>
                <td class="judul" colspan="3">Nama Orang Tua</td>
            </tr>
            <tr>
                <td>a. Ayah</td>
                <td colspan="2">: {{ $siswa->nama_ayah ?? '-' }}</td>
            </tr>
            <tr>
                <td>b. Ibu</td>
                <td colspan="2">: {{ $siswa->nama_ibu ?? '-' }}</td>
            </tr>
            <tr>
                <td>14</td>
                <td class="judul">Alamat Orang Tua</td>
                <td class="isi" colspan="2">: {{ $siswa->alamat ?? '-' }}</td>
            </tr>
            <tr>
                <td rowspan="3">15</td>
                <td class="judul" colspan="3">Pekerjaan Orang Tua</td>
            </tr>
            <tr>
                <td>a. Ayah</td>
                <td colspan="2">: {{ $siswa->pekerjaan_ayah ?? '-' }}</td>
            </tr>
            <tr>
                <td>b. Ibu</td>
                <td colspan="2">: {{ $siswa->pekerjaan_ibu ?? '-' }}</td>
            </tr>
            <tr>
                <td rowspan="3">16</td>
                <td class="judul">Nama Wali</td>
                <td class="isi" colspan="2">: {{ $siswa->nama_ayah ?? '-' }}</td>
            </tr>
            <tr>
                <td>a. Pekerjaan Wali</td>
                <td colspan="2">: {{ $siswa->pekerjaan_ayah ?? '-' }}</td>
            </tr>
            <tr>
                <td>b. Alamat Wali</td>
                <td colspan="2">: {{ $siswa->alamat ?? '-' }}</td>
            </tr>
        </table>
        <table style="width: 100%; text-align: left; margin-top: 30px;">
            <tr>
                <td width="33%">&nbsp;</td>
                <td width="33%">&nbsp;</td>
                <td width="33%">Sirahan, {{ date('d-m-Y') }}</td>
            </tr>
            <tr>
                <td width="33%">&nbsp;</td>
                <td width="33%">&nbsp;</td>
                <td width="33%">Kepala Madrasah <br><br><br><br><br><br></td>
            </tr>
            <tr>
                <td width="33%">&nbsp;</td>
                <td width="33%">&nbsp;</td>
                <td width="33%"><b><u>Muhammad Jamaluddin Umar, M.Pd.</u></b></td>
            </tr>
            <tr>
                <td width="33%">&nbsp;</td>
                <td width="33%">&nbsp;</td>
                <td width="33%">NIP.</td>
                {{-- <td width="33%">NIP. {{ $guru->niy_nip ?? '-' }}</td> --}}
            </tr>
        </table>
    </div>
</body>

</html>
