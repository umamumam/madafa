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
@php
function predikatNilai($nilai, $kkm) {
    if (is_null($nilai)) return '-';

    if ($kkm == 65) {
        if ($nilai <= 64) return 'D';
        if ($nilai <= 70) return 'C';
        if ($nilai <= 79) return 'B';
        return 'A';
    }

    return null; // Biarkan pakai default dari DB jika bukan kkm 65
}
@endphp
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Rapor - {{ $rapor->siswa->nama_siswa }}</h4>
                <a href="{{ route('rapor-lokal.export', $rapor->id) }}" class="btn btn-danger btn-sm w-auto" target="_blank">
                    <i class="fa fa-file-pdf"></i> Export PDF
                </a>
            </div>
            <form method="GET" action="{{ route('rapor-lokal.siswa') }}">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="kelas_id"><strong>Pilih Kelas:</strong></label>
                            <select name="kelas_id" id="kelas_id" class="form-control" onchange="this.form.submit()">
                                <option value="">Pilih Kelas</option>
                                @foreach($kelasList as $kelas)
                                    <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                        {{ $kelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="semester"><strong>Pilih Semester:</strong></label>
                            <select name="semester" id="semester" class="form-control" onchange="this.form.submit()">
                                <option value="1" {{ $semester == 1 ? 'selected' : '' }}>Semester 1 (Gasal)</option>
                                <option value="2" {{ $semester == 2 ? 'selected' : '' }}>Semester 2 (Genap)</option>
                            </select>
                        </div>

                    </div>
                </div>
            </form>


            <div class="card-body">
                <p><strong>NIS:</strong> {{ $rapor->siswa->nis }}</p>
                <p><strong>Nama:</strong> {{ $rapor->siswa->nama_siswa }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $rapor->siswa->jenisKelamin->jeniskelamin ?? '-' }}</p>
                <p><strong>Kelas:</strong> {{ $rapor->kelas->nama_kelas }} ({{ $rapor->semester }} / {{ $rapor->semester == 1 ? 'Gasal' : 'Genap' }})</p>
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
                                <td>
                                    @php
                                        $kkm = $detail->mapel->kkm;
                                        $nilai = $detail->jumlah;
                                        $abjad = $kkm == 65 ? predikatNilai($nilai, $kkm) : ($detail->nilai->abjad ?? '-');
                                    @endphp
                                    {{ $abjad }}
                                </td>
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

                <!-- Tabel untuk nilai spiritual, sosial, ekstrakurikuler, dsb -->
                <div class="table-responsive mt-4">
                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th colspan="2">Nilai dan Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Nilai Spiritual:</strong></td>
                                <td>{{ $rapor->nilaiSpiritual->abjad ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Deskripsi Spiritual:</strong></td>
                                <td>{{ $rapor->deskripsi_spiritual }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nilai Sosial:</strong></td>
                                <td>{{ $rapor->nilaiSosial->abjad ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Deskripsi Sosial:</strong></td>
                                <td>{{ $rapor->deskripsi_sosial }}</td>
                            </tr>
                            <tr>
                                <td><strong>Ekstrakurikuler:</strong></td>
                                <td>{{ $rapor->ekstrakurikuler->ekskul ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nilai Ekstrakurikuler:</strong></td>
                                <td>{{ $rapor->nilaiEkstra->abjad ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Sakit:</strong></td>
                                <td>{{ $rapor->sakit ?? '-' }} Hari</td>
                            </tr>
                            <tr>
                                <td><strong>Izin:</strong></td>
                                <td>{{ $rapor->izin ?? '-'}} Hari</td>
                            </tr>
                            <tr>
                                <td><strong>Tanpa Keterangan:</strong></td>
                                <td>{{ $rapor->tanpa_keterangan ?? '-' }} Hari</td>
                            </tr>
                            <tr>
                                <td><strong>Catatan:</strong></td>
                                <td>{{ $rapor->catatan }}</td>
                            </tr>
                            <tr>
                                <td><strong>Keterangan:</strong></td>
                                <td>{{ $rapor->keterangan->ket ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Wali Kelas:</strong></td>
                                <td>{{ $rapor->walikelas->nama_guru ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Kepala Madrasah:</strong></td>
                                <td>{{ $rapor->kepalaMadrasah->nama_guru ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
