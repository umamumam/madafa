@extends('layouts1.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            {{-- Bagian Header dengan Filter dan Tombol Cetak --}}
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h4 class="mb-0">Laporan Data Siswa</h4>
                <div class="d-flex align-items-center gap-2">
                    <form action="{{ route('laporan.siswa') }}" method="GET" class="d-flex align-items-center gap-2">
                        <select name="kelas_id" class="form-select form-select-sm">
                            <option value="">Semua Kelas</option>
                            @foreach ($kelas as $k)
                            <option value="{{ $k->id }}" {{ $selectedKelasId==$k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-filter"></i>
                        </button>
                    </form>
                    {{-- <a href="{{ route('cetak.laporan.siswa', ['kelas_id' => $selectedKelasId]) }}" target="_blank"
                        class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf"></i> Cetak ke PDF
                    </a> --}}
                </div>
            </div>

            {{-- Bagian Body dengan Tabel Data --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                        style="width: 100%">
                        <thead style="background-color: #e9f5ff;">
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                {{-- <th>NISN</th> --}}
                                <th>Nama Siswa</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat, Tgl. Lahir</th>
                                <th>Nama Ortu</th>
                                <th>Alamat</th>
                                <th>Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswas as $key => $siswa)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                {{-- <td class="text-center">
                                    @if ($siswa->foto)
                                    <img src="{{ Storage::url($siswa->foto) }}" alt="Foto Siswa" class="rounded-circle"
                                        width="50" height="50" style="object-fit: cover;">
                                    @else
                                    <img src="{{ asset('images/default.png') }}" alt="Default Foto"
                                        class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                                    @endif
                                </td> --}}
                                <td>{{ $siswa->nis ?? '-' }}</td>
                                {{-- <td>{{ $siswa->nisn ?? '-' }}</td> --}}
                                <td>{{ $siswa->nama_siswa }}</td>
                                <td>{{ $siswa->jeniskelamin->jeniskelamin ?? '-' }}</td>
                                <td>
                                    @if ($siswa->tempat_lahir || $siswa->tgl_lahir)
                                    {{ $siswa->tempat_lahir ?? '' }}{{ $siswa->tempat_lahir && $siswa->tgl_lahir ? ', '
                                    : '' }}{{ $siswa->tgl_lahir ?
                                    \Carbon\Carbon::parse($siswa->tgl_lahir)->translatedFormat('d F Y') : '' }}
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>{{ $siswa->nama_ayah ?? '-' }}</td>
                                <td>{{ $siswa->alamat ?? '-' }}</td>
                                <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
