@extends('layouts1.app')

@section('content')
<div class="row">
    <!-- Config table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h1>Data Siswa</h1>
                <a href="{{ route('siswas.create') }}" class="btn btn-primary">Tambah Siswa</a>
                <a href="{{ url('riwayat-kelas/mass-update') }}" class="btn btn-danger">Update Kelas</a>
                {{-- <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Tahun Pelajaran</button> --}}
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                    style="width: 100%">
                    <thead style="background-color: #e9f5ff;">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>NIS</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Jenis Kelamin</th>
                            <th>Kelas</th>
                            <th>Program</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswas as $key => $siswa)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    @if ($siswa->foto)
                                    <img src="{{ $siswa->foto ? asset('storage/' . str_replace('public/', '', $siswa->foto)) : asset('images/default.png') }}" alt="Foto Siswa" width="100">

                                        {{-- <img src="{{ asset('storage/' . $siswa->foto) }}" alt="Foto" width="60" height="60" style="object-fit: cover; border-radius: 5px;"> --}}
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td>{{ $siswa->nis }}</td>
                                <td>{{ $siswa->nisn }}</td>
                                <td>{{ $siswa->nama_siswa }}</td>
                                <td>{{ $siswa->jeniskelamin->jeniskelamin ?? '-' }}</td>
                                <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                                <td>{{ $siswa->program->program ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('siswas.edit', $siswa->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="{{ route('siswa.riwayat.kelas', $siswa->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-history"></i> Riwayat Kelas
                                    </a>
                                    <form action="{{ route('siswas.destroy', $siswa->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
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
