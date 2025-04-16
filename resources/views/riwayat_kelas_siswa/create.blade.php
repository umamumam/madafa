@extends('layouts1.app')

@section('content')
<div class="container">
    <h2>Tambah Riwayat Kelas Siswa</h2>
    <form action="{{ route('riwayat_kelas_siswa.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="siswa_id">Siswa</label>
            <select name="siswa_id" class="form-control" required>
                <option value="">Pilih Siswa</option>
                @foreach($siswas as $siswa)
                    <option value="{{ $siswa->id }}">{{ $siswa->nama_siswa }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="kelas_id">Kelas</label>
            <select name="kelas_id" class="form-control" required>
                <option value="">Pilih Kelas</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tahun_pelajaran_id">Tahun Pelajaran</label>
            <select name="tahun_pelajaran_id" class="form-control" required>
                <option value="">Pilih Tahun Pelajaran</option>
                @foreach($tahunPelajarans as $tp)
                    <option value="{{ $tp->id }}">{{ $tp->tahun }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="semester">Semester</label>
            <select name="semester" class="form-control" required>
                <option value="">Pilih Semester</option>
                <option value="1">1 (Ganjil)</option>
                <option value="2">2 (Genap)</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection
