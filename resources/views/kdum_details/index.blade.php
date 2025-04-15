@extends('layouts1.app')

@section('content')
<div class="container">
    <h4>Detail Kompetensi: {{ $kdum->siswa->nama_siswa }}</h4>
    <a href="{{ route('kdum-details.create', $kdum->id) }}" class="btn btn-primary mb-3">Tambah Kompetensi</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kompetensi Ke</th>
                <th>Kompetensi</th>
                <th>Nilai</th>
                <th>Penyemak</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $detail)
                <tr>
                    <td>{{ $detail->kompetensi_ke }}</td>
                    <td>{{ $detail->kompetensi }}</td>
                    <td>{{ $detail->nilai->abjad }} ({{ $detail->nilai->keterangan }})</td>
                    <td>{{ $detail->penyemak->guru->nama_guru ?? '-' }}</td>
                    <td>
                        <a href="{{ route('kdum-details.edit', [$kdum->id, $detail->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('kdum-details.destroy', [$kdum->id, $detail->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
