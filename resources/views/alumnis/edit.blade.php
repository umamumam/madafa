@extends('layouts1.app')

@section('content')
<div class="container">
    <h1>Edit Data Alumni</h1>

    <form action="{{ route('alumnis.update', $alumni->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Siswa</label>
            <input type="text" name="nama_siswa" class="form-control" value="{{ old('nama_siswa', $alumni->nama_siswa) }}" required>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>NIS</label>
                <input type="text" name="nis" class="form-control" value="{{ old('nis', $alumni->nis) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label>NISN</label>
                <input type="text" name="nisn" class="form-control" value="{{ old('nisn', $alumni->nisn) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label>NIK Siswa</label>
                <input type="text" name="nik_siswa" class="form-control" value="{{ old('nik_siswa', $alumni->nik_siswa) }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Foto (URL atau Path)</label>
            <input type="text" name="foto" class="form-control" value="{{ old('foto', $alumni->foto) }}">
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Jenis Kelamin</label>
                <input type="text" name="jeniskelamin" class="form-control" value="{{ old('jeniskelamin', $alumni->jeniskelamin) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $alumni->tempat_lahir) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir', $alumni->tgl_lahir) }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Kelas</label>
            <input type="text" name="kelas" class="form-control" value="{{ old('kelas', $alumni->kelas) }}">
        </div>

        <div class="mb-3">
            <label>Program</label>
            <input type="text" name="program" class="form-control" value="{{ old('program', $alumni->program) }}">
        </div>

        <div class="mb-3">
            <label>Anak ke-</label>
            <input type="number" name="anak_ke" class="form-control" value="{{ old('anak_ke', $alumni->anak_ke) }}">
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>No KK</label>
                <input type="text" name="no_kk" class="form-control" value="{{ old('no_kk', $alumni->no_kk) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label>NIK Ayah</label>
                <input type="text" name="nik_ayah" class="form-control" value="{{ old('nik_ayah', $alumni->nik_ayah) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label>Nama Ayah</label>
                <input type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah', $alumni->nama_ayah) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Pendidikan Ayah</label>
                <input type="text" name="pendidikan_ayah" class="form-control" value="{{ old('pendidikan_ayah', $alumni->pendidikan_ayah) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>Pekerjaan Ayah</label>
                <input type="text" name="pekerjaan_ayah" class="form-control" value="{{ old('pekerjaan_ayah', $alumni->pekerjaan_ayah) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>NIK Ibu</label>
                <input type="text" name="nik_ibu" class="form-control" value="{{ old('nik_ibu', $alumni->nik_ibu) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label>Nama Ibu</label>
                <input type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu', $alumni->nama_ibu) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label>Pendidikan Ibu</label>
                <input type="text" name="pendidikan_ibu" class="form-control" value="{{ old('pendidikan_ibu', $alumni->pendidikan_ibu) }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Pekerjaan Ibu</label>
            <input type="text" name="pekerjaan_ibu" class="form-control" value="{{ old('pekerjaan_ibu', $alumni->pekerjaan_ibu) }}">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>HP Siswa</label>
                <input type="text" name="hp_siswa" class="form-control" value="{{ old('hp_siswa', $alumni->hp_siswa) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>HP Orang Tua</label>
                <input type="text" name="hp_ortu" class="form-control" value="{{ old('hp_ortu', $alumni->hp_ortu) }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control">{{ old('alamat', $alumni->alamat) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Kode Pos</label>
            <input type="text" name="kode_pos" class="form-control" value="{{ old('kode_pos', $alumni->kode_pos) }}">
        </div>

        <div class="mb-3">
            <label>Asal Sekolah</label>
            <input type="text" name="asal_sekolah" class="form-control" value="{{ old('asal_sekolah', $alumni->asal_sekolah) }}">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>NPSN</label>
                <input type="text" name="npsn" class="form-control" value="{{ old('npsn', $alumni->npsn) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>NSM</label>
                <input type="text" name="nsm" class="form-control" value="{{ old('nsm', $alumni->nsm) }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Alamat Sekolah</label>
            <textarea name="alamat_sekolah" class="form-control">{{ old('alamat_sekolah', $alumni->alamat_sekolah) }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>No KIP</label>
                <input type="text" name="no_kip" class="form-control" value="{{ old('no_kip', $alumni->no_kip) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label>No KKS</label>
                <input type="text" name="no_kks" class="form-control" value="{{ old('no_kks', $alumni->no_kks) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label>No PKH</label>
                <input type="text" name="no_pkh" class="form-control" value="{{ old('no_pkh', $alumni->no_pkh) }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('alumnis.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
