@extends('layouts1.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Detail KDUM</h4>
            </div>
            <div class="card-body">
                <p><strong>Siswa:</strong> {{ $kdum->siswa->nama_siswa }}</p>
                <p><strong>Kelas:</strong> {{ $kdum->kelas->nama_kelas ?? '-' }}</p>
                <p><strong>Tahun Pelajaran:</strong> {{ $kdum->tahunPelajaran->tahun ?? '-' }}</p>

                <div style="overflow-x:auto;">
                    <table class="display table table-striped table-hover dt-responsive nowrap" style="width: 100%;">
                        <thead style="background-color: #e9f5ff;">
                            <tr>
                                <th style="width: 50px;">No</th>
                                {{-- <th>Urutan</th> --}}
                                <th>Kompetensi</th>
                                <th>Nilai</th>
                                <th>Penyemak</th>
                                <th style="width: 200px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kdum->details as $detail)
                            <tr>
                                {{-- <td>{{ $loop->iteration }}</td> --}}
                                <td>{{ $detail->kompetensi->urutan }}</td>
                                <td>{{ $detail->kompetensi->nama_kompetensi }}</td>
                                <td>{{ $detail->nilai->abjad ?? '-' }}</td>
                                <td>{{ $detail->penyemak->guru->nama_guru ?? '-' }}</td>
                                <td>
                                    <form action="{{ route('kdumdetail.update', $detail->id) }}" method="POST" class="d-flex flex-wrap align-items-center gap-2">
                                        @csrf
                                        @method('PUT')

                                        <select name="nilai_id" class="form-select form-select-sm" style="width: auto;">
                                            <option value="">Nilai</option>
                                            @foreach(App\Models\Nilai::all() as $nilai)
                                            <option value="{{ $nilai->id }}" @selected($detail->nilai_id == $nilai->id)>
                                                {{ $nilai->abjad }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <select name="penyemak_id" class="form-select form-select-sm" style="width: auto;">
                                            <option value="">Penyemak</option>
                                            @foreach($penyemaks as $penyemak)
                                            <option value="{{ $penyemak->id }}" @selected($detail->penyemak_id == $penyemak->id)>
                                                {{ $penyemak->guru->nama_guru }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                            @if(count($kdum->details) == 0)
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada detail kompetensi.</td>
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
