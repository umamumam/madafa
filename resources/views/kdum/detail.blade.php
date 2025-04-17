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
                <p><strong>Kelas:</strong> {{ $kdum->siswa->kelas->nama_kelas ?? '-' }}</p>
                <p><strong>Tahun Pelajaran:</strong> {{ $kdum->raporTerbaru->tahunPelajaran->tahun ?? '-' }}</p>

                <div style="overflow-x:auto;">
                    <table class="display table table-striped table-hover dt-responsive nowrap" style="width: 100%;">
                        <thead style="background-color: #e9f5ff;">
                            <tr>
                                <th style="width: 50px;">No</th>
                                {{-- <th>Urutan</th> --}}
                                <th>Kompetensi</th>
                                <th>Nilai</th>
                                <th>Penyemak</th>
                                <th style="width: 300px;">Aksi</th>
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

                                        {{-- <select name="penyemak_id" class="form-select form-select-sm" style="width: auto;">
                                            <option value="">Penyemak</option>
                                            @foreach($penyemaks as $penyemak)
                                            <option value="{{ $penyemak->id }}" @selected($detail->penyemak_id == $penyemak->id)>
                                                {{ $penyemak->guru->nama_guru }}
                                            </option>
                                            @endforeach
                                        </select> --}}
                                        <div class="position-relative" style="width: 300px;">
                                            <input type="text" class="form-control form-control-sm" id="penyemak_input_{{ $detail->id }}"
                                                name="penyemak_input" placeholder="Ketik nama penyemak..."
                                                value="{{ $detail->penyemak->guru->nama_guru ?? '' }}" oninput="filterPenyemak({{ $detail->id }})"
                                                autocomplete="off">
                                            <input type="hidden" name="penyemak_id" id="penyemak_id_{{ $detail->id }}" value="{{ $detail->penyemak_id }}">
                                            <ul id="penyemak_list_{{ $detail->id }}" class="dropdown-menu show"
                                                style="display: none; width: 100%; position: absolute; z-index: 999; max-height: 200px; overflow-y: auto;">
                                                @foreach($penyemaks as $penyemak)
                                                <li class="penyemak_item_{{ $detail->id }}">
                                                    <a href="javascript:void(0);" class="dropdown-item"
                                                        onclick="pilihPenyemak('{{ $penyemak->id }}', '{{ $penyemak->guru->nama_guru }}', {{ $detail->id }})">
                                                        {{ $penyemak->guru->nama_guru }}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>

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
<script>
    function filterPenyemak(id) {
        let input = document.getElementById("penyemak_input_" + id).value.toLowerCase();
        let list = document.getElementById("penyemak_list_" + id);
        let items = document.querySelectorAll(".penyemak_item_" + id);

        let visibleCount = 0;
        for (let item of items) {
            let text = item.textContent.toLowerCase();
            if (text.includes(input) && visibleCount < 5) {
                item.style.display = "block";
                visibleCount++;
            } else {
                item.style.display = "none";
            }
        }

        list.style.display = visibleCount > 0 ? "block" : "none";
    }

    function pilihPenyemak(id, nama, detailId) {
        document.getElementById("penyemak_input_" + detailId).value = nama;
        document.getElementById("penyemak_id_" + detailId).value = id;
        document.getElementById("penyemak_list_" + detailId).style.display = "none";
    }

    document.addEventListener("click", function (event) {
        document.querySelectorAll("[id^=penyemak_list_]").forEach(list => {
            if (!list.contains(event.target) &&
                !document.getElementById("penyemak_input_" + list.id.split("_")[2]).contains(event.target)) {
                list.style.display = "none";
            }
        });
    });
</script>

@endsection
