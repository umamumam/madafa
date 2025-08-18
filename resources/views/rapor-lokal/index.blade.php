@extends('layouts1.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h4 class="mb-0">Data Rapor Lokal</h4>
                <div class="d-flex align-items-center gap-2">
                    <form action="{{ route('rapor-lokal.index') }}" method="GET" class="d-flex align-items-center gap-2">
                        <select name="kelas_id" class="form-select form-select-sm">
                            <option value="">Semua Kelas</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}" {{ $selectedKelasId == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-filter"></i>
                        </button>
                    </form>
                    <a href="{{ route('rapor-lokal.export-all') }}" target="_blank" class="btn btn-sm btn-danger"><i class="fas fa-file-pdf"></i> Ekspor Semua PDF</a>
                </div>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                    style="width: 100%">
                    <thead style="background-color: #e9f5ff;">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Semester</th>
                            <th>Tahun Pelajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($raporLokals as $rapor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $rapor->siswa->nama_siswa }}</td>
                            <td>{{ $rapor->kelas->nama_kelas }}</td>
                            <td>{{ $rapor->semester }}</td>
                            <td>{{ $rapor->tahunPelajaran->tahun }}</td>
                            <td>
                                <a href="{{ route('rapor-lokal.detail', $rapor->id) }}" class="btn btn-sm btn-info">Detail</a>
                                <a href="{{ route('rapor-lokal.export', $rapor->id) }}" class="btn btn-sm btn-danger" target="_blank">PDF</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data rapor.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
