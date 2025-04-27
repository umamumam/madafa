@extends('layouts1.app')

@section('content')
<div class="row">
    <!-- Config table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h4 class="mb-0">Data KDUM</h4>

                <div class="d-flex flex-wrap gap-2 align-items-center">
                    <a href="{{ route('kdum.export.all') }}" target="_blank" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf"></i> Cetak Semua PDF
                    </a>

                    <a href="{{ asset('template/template_kdum.xlsx') }}" class="btn btn-warning btn-sm" target="_blank">
                        <i class="fas fa-download"></i> Template KDUM
                    </a>

                    <form action="{{ route('kdum.import') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center gap-2">
                        @csrf
                        <input type="file" name="file" class="form-control form-control-sm" required>
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-upload"></i> Import KDUM
                        </button>
                    </form>
                </div>
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
                            <td>{{ $kdum->siswa->kelas->nama_kelas ?? '-' }}</td>
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
