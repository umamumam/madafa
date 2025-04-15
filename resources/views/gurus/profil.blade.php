@extends('layouts1.app')

@section('content')
<div class="container">
    <h2>Profil Guru</h2>
    <div class="card mt-4">
        <div class="card-body row">
            <!-- Kolom Kiri (Foto) -->
            <div class="col-md-4 text-center">
                @if ($guru->foto)
                    <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru" class="img-fluid rounded" style="max-height: 250px;">
                @else
                    <p>Tidak ada foto</p>
                @endif
            </div>

            <!-- Kolom Kanan (Data Guru) -->
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tr>
                        <th>ID Guru</th>
                        <td>{{ $guru->idguru }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $guru->nama_guru }}</td>
                    </tr>
                    <tr>
                        <th>Tempat, Tanggal Lahir</th>
                        <td>{{ $guru->tempat_lahir }}, {{ \Carbon\Carbon::parse($guru->tgl_lahir)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $guru->jeniskelamin->jeniskelamin ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $guru->alamat }}</td>
                    </tr>
                    <tr>
                        <th>Mata Pelajaran 1</th>
                        <td>{{ $guru->mapel1->nama_mapel ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Mata Pelajaran 2</th>
                        <td>{{ $guru->mapel2->nama_mapel ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jabatan 1</th>
                        <td>{{ $guru->jabatan1->nama_jabatan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jabatan 2</th>
                        <td>{{ $guru->jabatan2->nama_jabatan ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
