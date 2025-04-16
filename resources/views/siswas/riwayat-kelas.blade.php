@extends('layouts1.app')

@section('content')
<div class="container">
    <h3>Riwayat Kelas: {{ $siswa->nama_siswa }}</h3>
    <a href="{{ route('riwayat_kelas_siswa.create') }}" class="btn btn-info btn-sm">
        <i class="fa fa-history"></i> Riwayat
    </a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kelas</th>
                <th>Tahun Pelajaran</th>
                <th>Semester</th>
                <th>Dibuat Pada</th>
            </tr>
        </thead>
        <tbody>
            @forelse($siswa->riwayatKelas as $riwayat)
                <tr>
                    <td>{{ $riwayat->kelas->nama_kelas ?? '-' }}</td>
                    <td>{{ $riwayat->tahunPelajaran->tahun ?? '-' }}</td>
                    <td>Semester {{ $riwayat->semester }}</td>
                    <td>{{ $riwayat->created_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada riwayat kelas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
