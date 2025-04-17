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
            <div class="card-header">
                <h4>Detail Rapor Lokal</h4>
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $rapor->siswa->nama_siswa }}</p>
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
                                <th>Aksi</th>
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
                                {{-- <td>{{ $detail->nilai->abjad ?? '-' }}</td> --}}
                                <td>
                                    @php
                                        $hurufPredikat = predikatNilai($detail->jumlah, $detail->mapel->kkm);
                                    @endphp
                                    {{ $hurufPredikat ?? ($detail->nilai->abjad ?? '-') }}
                                </td>
                                <td>{{ $detail->keterangan ?? '-' }}</td>
                                <td>{{ $detail->rata_rata ?? '-' }}</td>
                                <td>
                                    <form action="{{ route('rapor-lokal.detail.update', $detail->id) }}" method="POST" class="d-flex gap-2">
                                        @csrf
                                        @method('PUT')
                                        <select name="nilai_id" class="form-select form-select-sm">
                                            <option value="">Nilai</option>
                                            @foreach(App\Models\Nilai::all() as $nilai)
                                            <option value="{{ $nilai->id }}" @selected($detail->nilai_id == $nilai->id)>{{ $nilai->abjad }}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" name="predikat" class="form-control form-control-sm" placeholder="Predikat" value="{{ $detail->predikat }}">
                                        <input type="number" name="jumlah" class="form-control form-control-sm" placeholder="Nilai Mapel" value="{{ $detail->jumlah }}">
                                        <input type="number" name="rata_rata" step="0.01" class="form-control form-control-sm" placeholder="Rata-rata" value="{{ $detail->rata_rata }}">
                                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                            @if($rapor->details->isEmpty())
                            <tr>
                                <td colspan="9" class="text-center">Belum ada data detail.</td>
                            </tr>
                            @else
                            @php
                                $avg = collect($rapor->details)->pluck('jumlah')->filter()->avg();
                            @endphp
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Nilai Rata-rata Keseluruhan</td>
                                <td class="fw-bold">{{ number_format($avg) }}</td>
                                <td colspan="7"></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <form action="{{ route('rapor-lokal.update', $rapor->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nilai_spiritual_id">Nilai Spiritual</label>
                        <select name="nilai_spiritual_id" class="form-select">
                            <option value="">Pilih</option>
                            @foreach($nilais as $nilai)
                                <option value="{{ $nilai->id }}" @selected($rapor->nilai_spiritual_id == $nilai->id)>{{ $nilai->abjad }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi_spiritual">Deskripsi Spiritual</label>
                        <textarea name="deskripsi_spiritual" class="form-control">{{ $rapor->deskripsi_spiritual }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="nilai_sosial_id">Nilai Sosial</label>
                        <select name="nilai_sosial_id" class="form-select">
                            <option value="">Pilih</option>
                            @foreach($nilais as $nilai)
                                <option value="{{ $nilai->id }}" @selected($rapor->nilai_sosial_id == $nilai->id)>{{ $nilai->abjad }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi_sosial">Deskripsi Sosial</label>
                        <textarea name="deskripsi_sosial" class="form-control">{{ $rapor->deskripsi_sosial }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="ekstrakurikuler_id">Ekstrakurikuler</label>
                        <select name="ekstrakurikuler_id" class="form-select">
                            <option value="">Pilih</option>
                            @foreach($ekstras as $ekstra)
                                <option value="{{ $ekstra->id }}" @selected($rapor->ekstrakurikuler_id == $ekstra->id)>{{ $ekstra->ekskul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nilai_ekstra_id">Nilai Ekstrakurikuler</label>
                        <select name="nilai_ekstra_id" class="form-select">
                            <option value="">Pilih</option>
                            @foreach($nilais as $nilai)
                                <option value="{{ $nilai->id }}" @selected($rapor->nilai_ekstra_id == $nilai->id)>{{ $nilai->abjad }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sakit">Sakit</label>
                        <input type="number" name="sakit" class="form-control" value="{{ $rapor->sakit }}">
                    </div>
                    <div class="mb-3">
                        <label for="izin">Izin</label>
                        <input type="number" name="izin" class="form-control" value="{{ $rapor->izin }}">
                    </div>
                    <div class="mb-3">
                        <label for="tanpa_keterangan">Tanpa Keterangan</label>
                        <input type="number" name="tanpa_keterangan" class="form-control" value="{{ $rapor->tanpa_keterangan }}">
                    </div>
                    <div class="mb-3">
                        <label for="catatan">Catatan</label>
                        <textarea name="catatan" class="form-control">{{ $rapor->catatan }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="ket_id">Keterangan</label>
                        <select name="ket_id" class="form-select">
                            <option value="">Pilih</option>
                            @foreach($keterangans as $ket)
                                <option value="{{ $ket->id }}" @selected($rapor->ket_id == $ket->id)>
                                    {{ $ket->ket }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="walikelas_id">Wali Kelas</label>
                        <select name="walikelas_id" class="form-select">
                            <option value="">Pilih</option>
                            @foreach($gurus as $guru)
                                <option value="{{ $guru->id }}" @selected($rapor->walikelas_id == $guru->id)>{{ $guru->nama_guru }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kepala_madrasah_id">Kepala Madrasah</label>
                        <select name="kepala_madrasah_id" class="form-select">
                            <option value="">Pilih</option>
                            @foreach($gurus as $guru)
                                <option value="{{ $guru->id }}" @selected($rapor->kepala_madrasah_id == $guru->id)>{{ $guru->nama_guru }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
