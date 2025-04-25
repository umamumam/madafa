@extends('layouts1.app')

@section('content')
<style>
    .biodata-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .biodata-table td, .biodata-table th {
        padding: 8px 10px;
        font-size: 14px;
        border: 1px solid #ccc;
        vertical-align: top;
    }

    .biodata-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .biodata-table .nomor {
        width: 30px;
        text-align: center;
        font-weight: bold;
    }

    .biodata-table .judul {
        width: 20%;
        font-weight: bold;
    }

    .biodata-table .isi {
        width: 80%;
    }

    .foto-box {
        width: 3cm;
        height: 4cm;
        border: 1px solid #000;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: bold;
        margin: 0;
    }

    .foto {
        width: 120px;
        text-align: center;
        padding-left: 10px;
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
    }

    .card-body {
        padding: 20px;
    }
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="card profile-wave-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h2 class="mb-0">IDENTITAS PESERTA DIDIK</h2>
                <a href="{{ route('profil.identitassiswa.pdf') }}" class="btn btn-primary d-flex align-items-center" target="_blank">
                    <i class="fas fa-print me-2"></i> Cetak PDF
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="biodata-table">
                            <tr>
                                <td class="nomor">1</td>
                                <td class="judul">Nama Peserta Didik</td>
                                <td class="isi">: {{ $siswa->nama_siswa }}</td>
                                <td class="foto" rowspan="7">
                                    <img class="rounded" style="width: 3cm; height: 4cm; object-fit: cover; border: 1px solid #ccc;"
                                    src="{{ asset($siswa->foto ? 'storage/' . $siswa->foto : 'mantis/assets/images/user/avatar-5.jpg') }}"
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
                                <td class="isi">: {{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tgl_lahir)->format('d/m/Y') }}</td>
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
                                {{-- <td class="isi" colspan="2">: MA Darul Falah</td> --}}
                            </tr>
                            <tr>
                                <td>a. Di Kelas</td>
                                <td colspan="2">: X</td>
                                {{-- <td class="isi" colspan="2">: {{ \Carbon\Carbon::parse($siswa->tmt_sk_awal)->format('d/m/Y') }}</td> --}}
                            </tr>
                            <tr>
                                <td>b. Pada Tanggal</td>
                                <td class="isi" colspan="2">: {{ \Carbon\Carbon::parse($siswa->created_at)->format('d/m/Y') }}</td>
                                {{-- <td class="isi" colspan="2">: {{ $siswa->statussiswa->status ?? '-' }}</td> --}}
                            </tr>
                            <tr>
                                <td rowspan="3">13</td>
                                <td class="judul" colspan="3">Nama Orang Tua</td>
                                {{-- <td class="isi" colspan="2">: MA Darul Falah</td> --}}
                            </tr>
                            <tr>
                                <td>a. Ayah</td>
                                <td colspan="2">: {{ $siswa->nama_ayah ?? '-' }}</td>
                                {{-- <td class="isi" colspan="2">: {{ \Carbon\Carbon::parse($siswa->tmt_sk_awal)->format('d/m/Y') }}</td> --}}
                            </tr>
                            <tr>
                                <td>b. Ibu</td>
                                <td colspan="2">: {{ $siswa->nama_ibu ?? '-' }}</td>
                                {{-- <td class="isi" colspan="2">: {{ $siswa->statussiswa->status ?? '-' }}</td> --}}
                            </tr>
                            <tr>
                                <td>14</td>
                                <td class="judul">Alamat Orang Tua</td>
                                <td class="isi" colspan="2">: {{ $siswa->alamat ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td rowspan="3">15</td>
                                <td class="judul" colspan="3">Pekerjaan Orang Tua</td>
                                {{-- <td class="isi" colspan="2">: MA Darul Falah</td> --}}
                            </tr>
                            <tr>
                                <td>a. Ayah</td>
                                <td colspan="2">: {{ $siswa->pekerjaan_ayah ?? '-' }}</td>
                                {{-- <td class="isi" colspan="2">: {{ \Carbon\Carbon::parse($siswa->tmt_sk_awal)->format('d/m/Y') }}</td> --}}
                            </tr>
                            <tr>
                                <td>b. Ibu</td>
                                <td colspan="2">: {{ $siswa->pekerjaan_ibu ?? '-' }}</td>
                                {{-- <td class="isi" colspan="2">: {{ $siswa->statussiswa->status ?? '-' }}</td> --}}
                            </tr>
                            <tr>
                                <td rowspan="3">16</td>
                                <td class="judul">Pekerjaan Orang Tua</td>
                                <td class="isi" colspan="2">: {{ $siswa->nama_ayah ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>a. Pekerjaan Wali</td>
                                <td colspan="2">: {{ $siswa->pekerjaan_ayah ?? '-' }}</td>
                                {{-- <td class="isi" colspan="2">: {{ \Carbon\Carbon::parse($siswa->tmt_sk_awal)->format('d/m/Y') }}</td> --}}
                            </tr>
                            <tr>
                                <td>b. Alamat Wali</td>
                                <td colspan="2">: {{ $siswa->alamat ?? '-' }}</td>
                                {{-- <td class="isi" colspan="2">: {{ $siswa->statussiswa->status ?? '-' }}</td> --}}
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
