@extends('layouts1.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Rapor - {{ $rapor->siswa->nama_siswa }}</h4>
            </div>
            <div class="card-body">
                <p><strong>NIS:</strong> {{ $rapor->siswa->nis }}</p>
                <p><strong>Nama:</strong> {{ $rapor->siswa->nama_siswa }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $rapor->siswa->jenisKelamin->jeniskelamin ?? '-' }}</p>
                <p><strong>Kelas:</strong> {{ $rapor->kelas->nama_kelas }}</p>
                <p><strong>Tahun Pelajaran:</strong> {{ $rapor->tahunPelajaran->tahun }}</p>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai</th>
                            <th>Predikat</th>
                            <th>Jumlah</th>
                            <th>Rata-rata</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rapor->details as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail->mapel->mapel }}</td>
                            <td>{{ $detail->nilai->abjad ?? '-' }}</td>
                            <td>{{ $detail->keterangan ?? '-' }}</td>
                            <td>{{ $detail->jumlah ?? '-' }}</td>
                            <td>{{ $detail->rata_rata ?? '-' }}</td>
                        </tr>
                        @endforeach
                        @if($rapor->details->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection
