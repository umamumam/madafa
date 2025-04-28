<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Guru</title>
    <style>
        @page {
            margin: 0;
        }

        body {
            font-family: 'Times', sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .biodata-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .biodata-table td,
        .biodata-table th {
            padding: 10px 12px;
            font-size: 12px;
            border: none;
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
            width: 60%;
        }

        .foto {
            text-align: center;
            padding-left: 10px;
        }

        .foto img {
            width: 3cm;
            height: 4cm;
            object-fit: cover;
            border: 1px solid #000;
        }

        .biodata-table td[colspan="2"] {
            text-align: left;
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
    <h2>BIODATA PENDIDIK DAN TENAGA KEPENDIDIKAN</h2>
    <table class="biodata-table">
        <tr>
            <td>1</td>
            <td class="judul">Nomor Induk Pegawai</td>
            <td class="isi">: {{ $guru->niy_nip }}</td>
            <td class="foto" rowspan="7">
                <img style="width: 3cm; height: 4cm;"
                    src="{{ public_path($guru->foto ? 'storage/' . $guru->foto : 'mantis/assets/images/user/avatar-5.jpg') }}"
                    alt="Foto Guru">
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td class="judul">Nomor Induk Kependudukan</td>
            <td class="isi">: {{ $guru->nik }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td class="judul">Nama Lengkap</td>
            <td class="isi">: {{ $guru->nama_guru }}</td>
        </tr>
        <tr>
            <td>4</td>
            <td class="judul">Jenis Kelamin</td>
            <td class="isi">: {{ $guru->jeniskelamin->jeniskelamin ?? '-' }}</td>
        </tr>
        <tr>
            <td>5</td>
            <td class="judul">Tempat, Tgl. Lahir</td>
            <td class="isi">: {{ $guru->tempat_lahir }}, {{ \Carbon\Carbon::parse($guru->tgl_lahir)->format('d/m/Y') }}
            </td>
        </tr>
        <tr>
            <td>6</td>
            <td class="judul">Alamat</td>
            <td class="isi">: {{ $guru->alamat ?? '-' }}</td>
        </tr>
        <tr>
            <td>7</td>
            <td class="judul">No. HP</td>
            <td class="isi">: {{ $guru->no_hp ?? '-' }}</td>
        </tr>
        <tr>
            <td>8</td>
            <td class="judul">Pendidikan</td>
            <td class="isi" colspan="2">: {{ $guru->inst_pend_terakhir ?? '-' }}</td>
        </tr>
        {{-- <tr>
            <td>9</td>
            <td class="judul">Inst. Pendidikan Terakhir</td>
            <td class="isi" colspan="2">: {{ $guru->inst_pend_terakhir ?? '-' }}</td>
        </tr> --}}
        <tr>
            <td>9</td>
            <td class="judul">Status Pendidik</td>
            <td class="isi" colspan="2">: {{ $guru->statusGuru->status ?? '-' }}</td>
        </tr>
        {{-- <tr>
            <td>9</td>
            <td class="judul">Nama Satuan</td>
            <td class="isi" colspan="2">: MA Darul Falah</td>
        </tr> --}}
        <tr>
            <td>10</td>
            <td class="judul">Tahun Masuk</td>
            <td class="isi" colspan="2">: {{ \Carbon\Carbon::parse($guru->tmt_sk_awal)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td>11</td>
            <td class="judul"> No.NUPTK/NPK</td>
            <td class="isi" colspan="2">: {{ $guru->npk_nuptk_pegid ?? '-' }}</td>
        </tr>
        <tr>
            <td rowspan="4">12</td>
            <td class="judul">Pengampu Mapel</td>
        </tr>
        <tr>
            <td>a. Mapel Utama</td>
            <td class="isi" colspan="2" style="font-family: Arial, Helvetica, sans-serif">: {{ $guru->mapel1->mapel ??
                '-' }}</td>
        </tr>
        <tr>
            <td>b. Mapel Kedua</td>
            <td class="isi" colspan="2" style="font-family: Arial, Helvetica, sans-serif">: {{ $guru->mapel2->mapel ??
                '-' }}</td>
        </tr>
        <tr>
            <td>c. Mapel Ketiga</td>
            <td class="isi" colspan="2" style="font-family: Arial, Helvetica, sans-serif">: {{ $guru->mapel3->mapel ??
                '-' }}</td>
        </tr>
    </table>
    </div>
</body>

</html>
