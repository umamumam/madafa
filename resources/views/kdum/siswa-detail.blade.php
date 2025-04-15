@extends('layouts1.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Kompetensi KDUM - {{ $kdum->siswa->nama_siswa }}</h4>
            </div>
            <div class="card-body">
                <p><strong>Nis:</strong> {{ $kdum->siswa->nis ?? '-' }}</p>
                <p><strong>Nama Siswa:</strong> {{ $kdum->siswa->nama_siswa ?? '-' }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $kdum->siswa->jenisKelamin->jeniskelamin ?? '-' }}</p>
                <p><strong>Kelas:</strong> {{ $kdum->kelas->nama_kelas ?? '-' }} ({{ $kdum->kelas->program->program ?? '-' }})</p>
                <p><strong>Tahun Pelajaran:</strong> {{ $kdum->tahunPelajaran->tahun ?? '-' }}</p>

                <div style="overflow-x:auto;">
                    <table class="display table table-striped table-hover dt-responsive nowrap" style="width: 100%;">
                        <thead style="background-color: #e9f5ff;">
                            <tr>
                                <th>No</th>
                                <th>Kompetensi</th>
                                <th>Nilai</th>
                                <th>Penyemak</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kdum->details as $detail)
                            <tr>
                                <td>{{ $detail->kompetensi->urutan }}</td>
                                <td>{{ $detail->kompetensi->nama_kompetensi }}</td>
                                <td>{{ $detail->nilai->abjad ?? '-' }}</td>
                                <td>{{ $detail->penyemak->guru->nama_guru ?? '-' }}</td>
                            </tr>
                            @endforeach

                            @if(count($kdum->details) == 0)
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada detail kompetensi.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
