@extends('layouts1.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Detail Rapor Lokal</h4>
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $rapor->siswa->nama_siswa }}</p>
                <p><strong>Kelas:</strong> {{ $rapor->kelas->nama_kelas }}</p>
                <p><strong>Tahun Pelajaran:</strong> {{ $rapor->tahunPelajaran->tahun }}</p>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th>No</th>
                                <th>Mata Pelajaran</th>
                                <th>Nilai</th>
                                <th>Predikat</th>
                                <th>Jumlah</th>
                                <th>Rata-rata</th>
                                <th>Aksi</th>
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
                                <td>
                                    <form action="{{ route('rapor-lokal.detail.update', $detail->id) }}" method="POST" class="d-flex gap-2">
                                        @csrf
                                        @method('PUT')
                                        <select name="nilai_id" class="form-select form-select-sm">
                                            <option value="">Nilai</option>
                                            @foreach(App\Models\Nilai::all() as $nilai)
                                            <option value="{{ $nilai->id }}" @selected($detail->nilai_id == $nilai->id)>{{ $nilai->angka }}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" name="predikat" class="form-control form-control-sm" placeholder="Predikat" value="{{ $detail->predikat }}">
                                        <input type="number" name="jumlah" class="form-control form-control-sm" placeholder="Jumlah" value="{{ $detail->jumlah }}">
                                        <input type="number" name="rata_rata" step="0.01" class="form-control form-control-sm" placeholder="Rata-rata" value="{{ $detail->rata_rata }}">
                                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @if($rapor->details->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data detail.</td>
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
