<!-- resources/views/riwayat_kelas_siswa/mass-update.blade.php -->

@extends('layouts1.app')

@section('content')
<div class="container">
    <h4>Naik Kelas Massal</h4>

    <form method="POST" action="{{ route('riwayatkelas.mass.store') }}">
        @csrf

        <div class="form-group">
            <label for="kelas_asal_id">Kelas Asal</label>
            <select name="kelas_asal_id" class="form-control" required>
                <option value="">-- Pilih Kelas Asal --</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="kelas_tujuan_id">Kelas Tujuan</label>
            <select name="kelas_tujuan_id" class="form-control" required>
                <option value="">-- Pilih Kelas Tujuan --</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tahun_pelajaran_id">Tahun Pelajaran</label>
            <select name="tahun_pelajaran_id" class="form-control" required>
                @foreach($tahunPelajarans as $tp)
                    <option value="{{ $tp->id }}">{{ $tp->tahun }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="semester">Semester</label>
            <select name="semester" class="form-control" required>
                <option value="1">Ganjil</option>
                <option value="2">Genap</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Naikkan Semua Siswa</button>
    </form>
</div>
@endsection
