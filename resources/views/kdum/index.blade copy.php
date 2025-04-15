@extends('layouts1.app')

@section('content')
<div class="container">
    <h2>Data KDUM</h2>
    <a href="{{ route('kdums.create') }}" class="btn btn-primary mb-3">+ Tambah KDUM</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Siswa</th>
                <th>Kelas</th>
                <th>Tahun Pelajaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kdums as $kdum)
                <tr>
                    <td>{{ $kdum->siswa->nama_siswa ?? '-' }}</td>
                    <td>{{ $kdum->kelas->nama_kelas ?? '-' }}</td>
                    <td>{{ $kdum->tahunPelajaran->tahun ?? '-' }}</td>
                    <td>
                        <a href="{{ route('kdums.show', $kdum->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('kdums.edit', $kdum->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kdums.destroy', $kdum->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus data?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
