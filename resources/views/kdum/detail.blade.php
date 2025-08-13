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
                                <th>Kompetensi</th>
                                <th>Nilai</th>
                                <th>Guru</th>
                                <th style="width: 300px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kdum->details as $detail)
                            <tr>
                                <td>{{ $detail->kompetensi->urutan }}</td>
                                <td>{{ $detail->kompetensi->nama_kompetensi }}</td>
                                <td>{{ $detail->nilai->abjad ?? '-' }}</td>
                                <td>{{ $detail->guru->nama_guru ?? '-' }}</td>
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

                                        <div class="position-relative" style="width: 300px;">
                                            <input type="text" class="form-control form-control-sm" id="guru_input_{{ $detail->id }}"
                                                name="guru_input" placeholder="Ketik nama guru..."
                                                value="{{ $detail->guru->nama_guru ?? '' }}" oninput="filterGuru({{ $detail->id }})"
                                                autocomplete="off">
                                            <input type="hidden" name="guru_id" id="guru_id_{{ $detail->id }}" value="{{ $detail->guru_id }}">
                                            <ul id="guru_list_{{ $detail->id }}" class="dropdown-menu show"
                                                style="display: none; width: 100%; position: absolute; z-index: 999; max-height: 200px; overflow-y: auto;">
                                                <li class="guru_item_{{ $detail->id }}">
                                                    <a href="javascript:void(0);" class="dropdown-item text-danger"
                                                        onclick="hapusGuru({{ $detail->id }})">
                                                        -- Hapus Pilihan --
                                                    </a>
                                                </li>
                                                @foreach($gurus as $guru)
                                                <li class="guru_item_{{ $detail->id }}">
                                                    <a href="javascript:void(0);" class="dropdown-item"
                                                        onclick="pilihGuru('{{ $guru->id }}', '{{ $guru->nama_guru }}', {{ $detail->id }})">
                                                        {{ $guru->nama_guru }}
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
    function filterGuru(id) {
        let input = document.getElementById("guru_input_" + id).value.toLowerCase();
        let list = document.getElementById("guru_list_" + id);
        let items = document.querySelectorAll(".guru_item_" + id);

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

    function pilihGuru(id, nama, detailId) {
        document.getElementById("guru_input_" + detailId).value = nama;
        document.getElementById("guru_id_" + detailId).value = id;
        document.getElementById("guru_list_" + detailId).style.display = "none";
    }

    document.addEventListener("click", function (event) {
        document.querySelectorAll("[id^=guru_list_]").forEach(list => {
            if (!list.contains(event.target) &&
                !document.getElementById("guru_input_" + list.id.split("_")[2]).contains(event.target)) {
                list.style.display = "none";
            }
        });
    });
    function hapusGuru(id) {
        document.getElementById(`guru_input_${id}`).value = '';
        document.getElementById(`guru_id_${id}`).value = '';
        document.getElementById(`guru_list_${id}`).style.display = "none";
    }

</script>

@endsection
