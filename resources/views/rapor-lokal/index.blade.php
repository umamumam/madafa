@extends('layouts1.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Rapor Lokal</h4>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                    style="width: 100%">
                    <thead style="background-color: #e9f5ff;">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
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
