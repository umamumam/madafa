@extends('layouts1.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Naik Kelas Massal</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('riwayatkelas.mass.store') }}">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="kelas_asal_input">Kelas Asal</label>
                            <div class="position-relative">
                                <input type="text" class="form-control" id="kelas_asal_input" name="kelas_asal_input"
                                    placeholder="Ketik nama kelas..." oninput="filterKelas('asal')" autocomplete="off">
                                <input type="hidden" name="kelas_asal_id" id="kelas_asal_id">
                                <ul id="kelas_asal_list" class="dropdown-menu"
                                    style="display: none; width: 100%; position: absolute; z-index: 999; max-height: 200px; overflow-y: auto;">
                                    @foreach($kelas as $k)
                                        <li class="kelas_item_asal">
                                            <a href="javascript:void(0);" class="dropdown-item"
                                                onclick="pilihKelas('{{ $k->id }}', '{{ $k->nama_kelas }}', 'asal')">
                                                {{ $k->nama_kelas }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="kelas_tujuan_input">Kelas Tujuan</label>
                            <div class="position-relative">
                                <input type="text" class="form-control" id="kelas_tujuan_input" name="kelas_tujuan_input"
                                    placeholder="Ketik nama kelas..." oninput="filterKelas('tujuan')" autocomplete="off">
                                <input type="hidden" name="kelas_tujuan_id" id="kelas_tujuan_id">
                                <ul id="kelas_tujuan_list" class="dropdown-menu"
                                    style="display: none; width: 100%; position: absolute; z-index: 999; max-height: 200px; overflow-y: auto;">
                                    @foreach($kelas as $k)
                                        <li class="kelas_item_tujuan">
                                            <a href="javascript:void(0);" class="dropdown-item"
                                                onclick="pilihKelas('{{ $k->id }}', '{{ $k->nama_kelas }}', 'tujuan')">
                                                {{ $k->nama_kelas }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="tahun_pelajaran_id">Tahun Pelajaran</label>
                            <select name="tahun_pelajaran_id" class="form-control" required>
                                @foreach($tahunPelajarans as $tp)
                                    <option value="{{ $tp->id }}">{{ $tp->tahun }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="semester">Semester</label>
                            <select name="semester" class="form-control" required>
                                <option value="1">Ganjil</option>
                                <option value="2">Genap</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Naikkan Semua Siswa</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function filterKelas(type) {
        const input = document.getElementById(`kelas_${type}_input`).value.toLowerCase();
        const list = document.getElementById(`kelas_${type}_list`);
        const items = document.querySelectorAll(`.kelas_item_${type}`);
        let visibleCount = 0;
        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            if (text.includes(input) && visibleCount < 5) {
                item.style.display = "block";
                visibleCount++;
            } else {
                item.style.display = "none";
            }
        });
        list.style.display = visibleCount > 0 ? "block" : "none";
    }
    function pilihKelas(id, nama, type) {
        document.getElementById(`kelas_${type}_input`).value = nama;
        document.getElementById(`kelas_${type}_id`).value = id;
        document.getElementById(`kelas_${type}_list`).style.display = "none";
    }
    document.addEventListener("click", function (event) {
        ['asal', 'tujuan'].forEach(type => {
            const list = document.getElementById(`kelas_${type}_list`);
            const input = document.getElementById(`kelas_${type}_input`);
            if (!list.contains(event.target) && !input.contains(event.target)) {
                list.style.display = "none";
            }
        });
    });
</script>

@endsection
