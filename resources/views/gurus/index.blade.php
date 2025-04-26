@extends('layouts1.app')

@section('content')
<div class="row">
    <!-- Config table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h1>Data Guru</h1>
                <div class="d-flex flex-wrap gap-3 align-items-center mb-3">
                    <a href="{{ route('gurus.create') }}" class="btn btn-primary">
                        Tambah Guru
                    </a>

                    <a href="{{ asset('template/guru_import.xlsx') }}" class="btn btn-warning" target="_blank">
                        Download Template Guru
                    </a>

                    <form action="{{ route('guru.import') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center gap-2">
                        @csrf
                        <input type="file" name="file" class="form-control" required>
                        <button type="submit" class="btn btn-success">
                            Import
                        </button>
                    </form>
                </div>
                {{-- <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Tahun Pelajaran</button> --}}
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                    style="width: 100%">
                    <thead style="background-color: #e9f5ff;">
                        <tr>
                            <th>ID Guru</th>
                            <th>Nama</th>
                            <th>Foto</th>
                            <th>Jenis Kelamin</th>
                            <th>Pendidikan</th>
                            <th>Status</th>
                            <th>Mapel 1</th>
                            <th>Jabatan 1</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gurus as $guru)
                            <tr>
                                <td>{{ $guru->idguru }}</td>
                                <td>{{ $guru->nama_guru }}</td>
                                <td>
                                    @if($guru->foto)
                                        <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto" width="60">
                                    @else
                                        Tidak ada foto
                                    @endif
                                </td>
                                <td>{{ $guru->jenisKelamin->jeniskelamin ?? '-' }}</td>
                                <td>{{ $guru->pendidikanTerakhir->pendidikan ?? '-' }}</td>
                                <td>{{ $guru->statusGuru->status ?? '-' }}</td>
                                <td>{{ $guru->mapel1->mapel ?? '-' }}</td>
                                <td>{{ $guru->jabatan1->jabatan ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('gurus.edit', $guru->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('gurus.destroy', $guru->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
