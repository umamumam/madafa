@extends('layouts1.app')

@section('content')
<div class="row">
    <!-- Config table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3>Laporan Data Guru</h3>
                {{-- <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Tahun Pelajaran</button> --}}
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                    style="width: 100%">
                    <thead style="background-color: #e9f5ff;">
                        <tr>
                            <th>ID Guru</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Pendidikan</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Mapel 1</th>
                            <th>Mapel 2</th>
                            <th>Mapel 3</th>
                            <th>Jabatan 1</th>
                            <th>Jabatan 2</th>
                            <th>Jabatan 3</th>
                            {{-- <th>Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gurus as $guru)
                            <tr>
                                <td>{{ $guru->idguru }}</td>
                                <td>{{ $guru->nama_guru }}</td>
                                <td>{{ $guru->jenisKelamin->jeniskelamin ?? '-' }}</td>
                                <td>{{ $guru->pendidikanTerakhir->pendidikan ?? '-' }}</td>
                                <td>{{ $guru->alamat ?? '-' }}</td>
                                <td>{{ $guru->statusGuru->status ?? '-' }}</td>
                                <td>{{ $guru->mapel1->mapel ?? '-' }}</td>
                                <td>{{ $guru->mapel2->mapel ?? '-' }}</td>
                                <td>{{ $guru->mapel3->mapel ?? '-' }}</td>
                                <td>{{ $guru->jabatan1->jabatan ?? '-' }}</td>
                                <td>{{ $guru->jabatan2->jabatan ?? '-' }}</td>
                                <td>{{ $guru->jabatan3->jabatan ?? '-' }}</td>
                                {{-- <td>
                                    <a href="{{ route('gurus.edit', $guru->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="{{ route('gurus.show', $guru->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i> Detail
                                    </a>
                                    <form action="{{ route('gurus.destroy', $guru->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
