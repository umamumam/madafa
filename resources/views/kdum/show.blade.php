@extends('layouts1.app')

@section('content')
<h4>Detail Siswa: {{ $kdum->siswa->nama_siswa }}</h4>

<p><strong>NIS:</strong> {{ $kdum->siswa->nis }}</p>
<p><strong>Kelas:</strong> {{ $kdum->kelas->nama ?? '-' }}</p>
<p><strong>Tahun Pelajaran:</strong> {{ $kdum->tahunPelajaran->nama ?? '-' }}</p>

<table class="table table-bordered table-sm">
    <thead>
        <tr>
            <th>No</th>
            <th>Kompetensi</th>
            <th>Nilai</th>
            <th>Penyemak</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kdum->details as $index => $detail)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $detail->kompetensi->nama_kompetensi }}</td>
            <td>{{ $detail->nilai->nama ?? '-' }}</td>
            <td>{{ $detail->penyemak->nama ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('kdum.index') }}" class="btn btn-secondary">Kembali</a>
@endsection
