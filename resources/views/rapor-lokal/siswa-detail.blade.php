@extends('layouts1.app')

@section('content')
@php
function terbilang($x)
{
    $x = abs($x);
    $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
    $temp = "";

    if ($x < 12) {
        $temp = $angka[$x];
    } else if ($x < 20) {
        $temp = terbilang($x - 10) . " belas";
    } else if ($x < 100) {
        $temp = terbilang(floor($x / 10)) . " puluh " . terbilang($x % 10);
    } else if ($x < 200) {
        $temp = "seratus " . terbilang($x - 100);
    } else if ($x < 1000) {
        $temp = terbilang(floor($x / 100)) . " ratus " . terbilang($x % 100);
    } else if ($x < 2000) {
        $temp = "seribu " . terbilang($x - 1000);
    } else if ($x < 1000000) {
        $temp = terbilang(floor($x / 1000)) . " ribu " . terbilang($x % 1000);
    } else if ($x < 1000000000) {
        $temp = terbilang(floor($x / 1000000)) . " juta " . terbilang($x % 1000000);
    }

    return trim(preg_replace('/\s+/', ' ', $temp));
}
@endphp
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

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th>No</th>
                                <th>Mata Pelajaran</th>
                                <th>KKM</th>
                                <th>Nilai Mapel</th>
                                <th>Huruf</th>
                                <th>Predikat Mapel</th>
                                <th>Keterangan</th>
                                <th>Rata-rata</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rapor->details as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detail->mapel->mapel }}</td>
                                <td>{{ $detail->mapel->kkm }}</td>
                                <td>{{ $detail->jumlah ?? '-' }}</td>
                                <td>
                                    <span id="terbilang-{{ $detail->id }}">
                                        {{ $detail->jumlah ? ucwords(terbilang($detail->jumlah)) : '-' }}
                                    </span>
                                </td>
                                <td>{{ $detail->nilai->abjad ?? '-' }}</td>
                                <td>{{ $detail->keterangan ?? '-' }}</td>
                                <td>{{ $detail->rata_rata ?? '-' }}</td>
                            </tr>
                            @endforeach

                            @if($rapor->details->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center text-muted">Belum ada data detail.</td>
                            </tr>
                            @else
                            @php
                                $avg = collect($rapor->details)->pluck('jumlah')->filter()->avg();
                            @endphp
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Nilai Rata-rata Keseluruhan</td>
                                <td class="fw-bold">{{ number_format($avg) }}</td>
                                <td colspan="4"></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <p><strong>Nilai Spiritual:</strong> {{ $rapor->nilaiSpiritual->abjad ?? '-' }}</p>
                <p><strong>Deskripsi Spiritual:</strong> {{ $rapor->deskripsi_spiritual }}</p>

                <p><strong>Nilai Sosial:</strong> {{ $rapor->nilaiSosial->abjad ?? '-' }}</p>
                <p><strong>Deskripsi Sosial:</strong> {{ $rapor->deskripsi_sosial }}</p>

                <p><strong>Ekstrakurikuler:</strong> {{ $rapor->ekstrakurikuler->ekskul ?? '-' }}</p>
                <p><strong>Nilai Ekstrakurikuler:</strong> {{ $rapor->nilaiEkstra->abjad ?? '-' }}</p>

                <p><strong>Sakit:</strong> {{ $rapor->sakit ?? '-' }} Hari</p>
                <p><strong>Izin:</strong> {{ $rapor->izin ?? '-'}} Hari</p>
                <p><strong>Tanpa Keterangan:</strong> {{ $rapor->tanpa_keterangan ?? '-' }} Hari</p>

                <p><strong>Catatan:</strong> {{ $rapor->catatan }}</p>

                <p><strong>Keterangan:</strong> {{ $rapor->keterangan->ket ?? '-' }}</p>

                <p><strong>Wali Kelas:</strong> {{ $rapor->walikelas->nama_guru ?? '-' }}</p>
                <p><strong>Kepala Madrasah:</strong> {{ $rapor->kepalaMadrasah->nama_guru ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
