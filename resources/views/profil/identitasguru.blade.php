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
                <h2 class="mb-0">BIODATA PENDIDIK DAN TENAGA KEPENDIDIKAN</h2>
                <a href="{{ route('profil.identitasguru.pdf') }}" class="btn btn-primary d-flex align-items-center" target="_blank">
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
                                <td class="judul">NIY/NIP</td>
                                <td class="isi">: {{ $guru->niy_nip }}</td>
                                <td class="foto" rowspan="7">
                                    <img class="rounded" style="width: 3cm; height: 4cm; object-fit: cover; border: 1px solid #ccc;"
                                    src="{{ asset($guru->foto ? 'storage/' . $guru->foto : 'mantis/assets/images/user/avatar-5.jpg') }}"
                                    alt="Foto Guru">
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="judul">NIK</td>
                                <td class="isi">: {{ $guru->nik }}</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td class="judul">Nama Guru</td>
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
                                <td class="isi">: {{ $guru->tempat_lahir }}, {{ \Carbon\Carbon::parse($guru->tgl_lahir)->format('d/m/Y') }}</td>
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
                                <td class="judul">Pendidikan Terakhir</td>
                                <td class="isi" colspan="2">{{ $guru->inst_pend_terakhir ?? '-' }}</td>
                            </tr>
                            {{-- <tr>
                                <td>9</td>
                                <td class="judul">Pendidikan Non Formal</td>
                                <td class="isi" colspan="2">
                                    : PONPES AL-ANWAR Sarang<br>
                                    &nbsp;&nbsp;MA Darul Falah
                                </td>
                            </tr> --}}
                            <tr>
                                <td>9</td>
                                <td class="judul">Nama Satuan</td>
                                <td class="isi" colspan="2">: MA Darul Falah</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td class="judul">TMT SK Awal</td>
                                <td class="isi" colspan="2">: {{ \Carbon\Carbon::parse($guru->tmt_sk_awal)->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td class="judul">Status Pendidik</td>
                                <td class="isi" colspan="2">: {{ $guru->statusGuru->status ?? '-' }}</td>
                            </tr>
                            {{-- <tr>
                                <td>12</td>
                                <td class="judul">NPK</td>
                                <td class="isi" colspan="2">: {{ $guru->npk_nuptk_pegid ?? '-' }}</td>
                            </tr> --}}
                            <tr>
                                <td>12</td>
                                <td class="judul">NUPTK/PEG.ID</td>
                                <td class="isi" colspan="2">: {{ $guru->npk_nuptk_pegid ?? '-' }}</td>
                            </tr>
                            {{-- <tr>
                                <td>13</td>
                                <td class="judul">NRG</td>
                                <td class="isi" colspan="2">: 142392176007</td>
                            </tr> --}}
                            <tr>
                                <td>13</td>
                                <td class="judul">Mapel Utama</td>
                                <td class="isi" colspan="2">: {{ $guru->mapel1->mapel ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>14</td>
                                <td class="judul">Mapel Kedua</td>
                                <td class="isi" colspan="2">: {{ $guru->mapel2->mapel ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>15</td>
                                <td class="judul">Mapel Ketiga</td>
                                <td class="isi" colspan="2">: {{ $guru->mapel3->mapel ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
