@extends('layouts1.app')

@section('content')
<div class="row">
    <!-- Config table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h1>Data Siswa</h1>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                    style="width: 100%">
                    <thead style="background-color: #e9f5ff;">
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            {{-- <th>NISN</th> --}}
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
                            <td>{{ $siswa->nis }}</td>
                            {{-- <td>{{ $siswa->nisn }}</td> --}}
                            <td>{{ $siswa->nama_siswa }}</td>
                            <td>{{ $siswa->jeniskelamin->jeniskelamin ?? '-' }}</td>
                            <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                            <td>{{ $siswa->program->program ?? '-' }}</td>
                            <td>
                                {{-- <a href="{{ route('siswas.edit', $siswa->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('siswas.show', $siswa->id) }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-eye"></i> Surat & Kartu
                                </a>
                                <a href="{{ route('siswa.riwayat.kelas', $siswa->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-history"></i> Riwayat Kelas
                                </a> --}}
                                @if($siswa->nis)
                                    <a href="{{ route('pembayaran.index', ['siswa_nis' => $siswa->nis]) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="fa fa-money-bill-wave"></i> Pembayaran
                                    </a>
                                    <a href="{{ route('tabungan.index', ['siswa_nis' => $siswa->nis]) }}"
                                        class="btn btn-secondary btn-sm">
                                        <i class="fas fa-wallet"></i> Tabungan
                                    </a>
                                @else
                                    <button class="btn btn-primary btn-sm" disabled title="NIS belum diisi">
                                        <i class="fa fa-money-bill-wave"></i> Pembayaran
                                    </button>
                                    <button class="btn btn-secondary btn-sm" disabled title="NIS belum diisi">
                                        <i class="fas fa-wallet"></i> Tabungan
                                    </button>
                                @endif
                                {{-- <form action="{{ route('siswas.destroy', $siswa->id) }}" method="POST"
                                    style="display:inline;">
                                    <form action="{{ route('siswas.destroy', $siswa->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </form> --}}
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
