@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Detail Kompetensi: {{ $kdum->siswa->nama_siswa }}</h4>
    <form action="{{ route('kdum-details.update', [$kdum->id, $detail->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="kompetensi_ke">Kompetensi Ke</label>
            <input type="number" id="kompetensi_ke" name="kompetensi_ke" class="form-control" value="{{ old('kompetensi_ke', $detail->kompetensi_ke) }}" required>
        </div>

        <div class="form-group">
            <label for="kompetensi">Kompetensi</label>
            <input type="text" id="kompetensi" name="kompetensi" class="form-control" value="{{ old('kompetensi', $detail->kompetensi) }}" required>
        </div>

        <div class="form-group">
            <label for="nilai_id">Nilai</label>
            <select id="nilai_id" name="nilai_id" class="form-control" required>
                <option value="">Pilih Nilai</option>
                @foreach ($nilais as $nilai)
                    <option value="{{ $nilai->id }}" {{ old('nilai_id', $detail->nilai_id) == $nilai->id ? 'selected' : '' }}>
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
                    <option value="{{ $penyemak->id }}" {{ old('penyemak_id', $detail->penyemak_id) == $penyemak->id ? 'selected' : '' }}>
                        {{ $penyemak->guru->nama_guru }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('kdum-details.index', $kdum->id) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
