@extends('layouts1.app')

@section('content')
<div class="container">
    <h1>Detail Rapor Lokal</h1>

    <div class="form-group">
        <label for="siswa_id">Siswa</label>
        <input type="text" class="form-control" value="{{ $raporLokal->siswa->nama }}" readonly>
    </div>

    <div class="form-group">
        <label for="kelas_id">Kelas</label>
        <input type="text" class="form-control" value="{{ $raporLokal->kelas->nama }}" readonly>
    </div>

    <div class="form-group">
        <label for="tahun_pelajaran_id">Tahun Pelajaran</label>
        <input type="text" class="form-control" value="{{ $raporLokal->tahunPelajaran->nama }}" readonly>
    </div>

    <div class="form-group">
        <label for="ekstrakurikuler_id">Ekstrakurikuler</label>
        <input type="text" class="form-control" value="{{ $raporLokal->ekstrakurikuler->nama }}" readonly>
    </div>

    <div class="form-group">
        <label for="nilai_spiritual_id">Nilai Spiritual</label>
        <input type="text" class="form-control" value="{{ $raporLokal->nilaiSpiritual->abjad }}" readonly>
    </div>

    <div class="form-group">
        <label for="nilai_sosial_id">Nilai Sosial</label>
        <input type="text" class="form-control" value="{{ $raporLokal->nilaiSosial->abjad }}" readonly>
    </div>

    <div class="form-group">
        <label for="nilai_ekstra_id">Nilai Ekstrakurikuler</label>
        <input type="text" class="form-control" value="{{ $raporLokal->nilaiEkstra->abjad }}" readonly>
    </div>

    <div class="form-group">
        <label for="catatan">Catatan</label>
        <textarea class="form-control" readonly>{{ $raporLokal->catatan }}</textarea>
    </div>

    <a href="{{ route('rapor-lokal.index') }}" class="btn btn-primary">Kembali ke Daftar</a>
</div>
@endsection
