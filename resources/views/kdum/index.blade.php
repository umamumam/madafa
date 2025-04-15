@extends('layouts1.app')

@section('content')
<div class="row">
    <!-- Config table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Data KDUM</h4>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                {{-- <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari Nama Kelas..."> --}}
                <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                    style="width: 100%">
                    <thead style="background-color: #e9f5ff;">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Tahun Pelajaran</th>
                            <th style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kdums as $kdum)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kdum->siswa->nama_siswa }}</td>
                            <td>{{ $kdum->kelas->nama_kelas ?? '-' }}</td>
                            <td>{{ $kdum->tahunPelajaran->tahun ?? '-' }}</td>
                            <td>
                                <a href="{{ route('kdum.detail', $kdum->id) }}" class="btn btn-sm btn-info">Detail</a>
                                <a href="{{ route('kdum.export', $kdum->id) }}" class="btn btn-sm btn-danger" target="_blank">PDF</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada data KDUM.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Config table end -->
</div>

@endsection
