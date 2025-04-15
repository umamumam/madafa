@extends('layouts1.app')

@section('content')
<div class="container">
    <h4>Tambah Detail Kompetensi: {{ $kdum->siswa->nama_siswa }}</h4>
    <form action="{{ route('kdum-details.store', $kdum->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="kompetensi_ke">Kompetensi Ke</label>
            <input type="number" id="kompetensi_ke" name="kompetensi_ke" class="form-control" value="{{ old('kompetensi_ke') }}" required>
        </div>

        <div class="form-group">
            <label for="kompetensi">Kompetensi</label>
            <input type="text" id="kompetensi" name="kompetensi" class="form-control" value="{{ old('kompetensi') }}" required>
        </div>

        <div class="form-group">
            <label for="nilai_id">Nilai</label>
            <select id="nilai_id" name="nilai_id" class="form-control" required>
                <option value="">Pilih Nilai</option>
                @foreach ($nilais as $nilai)
                    <option value="{{ $nilai->id }}" {{ old('nilai_id') == $nilai->id ? 'selected' : '' }}>
                        {{ $nilai->abjad }} ({{ $nilai->keterangan }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="penyemak_id">Penyemak</label>
            <select id="penyemak_id" name="penyemak_id" class="form-control">
                <option value="">Pilih Penyemak (Opsional)</option>
                @foreach ($penyemaks as $penyemak)
                    <option value="{{ $penyemak->id }}" {{ old('penyemak_id') == $penyemak->id ? 'selected' : '' }}>
                        {{ $penyemak->guru->nama_guru }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kdum-details.index', $kdum->id) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
