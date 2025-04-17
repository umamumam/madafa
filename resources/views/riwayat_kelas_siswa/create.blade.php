@extends('layouts1.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Tambah Riwayat Kelas Siswa</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('riwayat_kelas_siswa.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="siswa_input">Siswa</label>
                            <div class="position-relative">
                                <input type="text" class="form-control" id="siswa_input" name="siswa_input"
                                    placeholder="Ketik nama siswa..." oninput="filterSiswa()" autocomplete="off">
                                <input type="hidden" name="siswa_id" id="siswa_id">
                                <ul id="siswa_list" class="dropdown-menu"
                                    style="display: none; width: 100%; position: absolute; z-index: 999; max-height: 200px; overflow-y: auto;">
                                    @foreach($siswas as $s)
                                        <li class="siswa_item">
                                            <a href="javascript:void(0);" class="dropdown-item"
                                                onclick="pilihSiswa('{{ $s->id }}', '{{ $s->nama_siswa }}')">
                                                {{ $s->nama_siswa }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="kelas_input">Kelas</label>
                            <div class="position-relative">
                                <input type="text" class="form-control" id="kelas_input" name="kelas_input"
                                    placeholder="Ketik nama kelas..." oninput="filterKelas('riwayat')" autocomplete="off">
                                <input type="hidden" name="kelas_id" id="kelas_id">
                                <ul id="kelas_list_riwayat" class="dropdown-menu"
                                    style="display: none; width: 100%; position: absolute; z-index: 999; max-height: 200px; overflow-y: auto;">
                                    @foreach($kelas as $k)
                                        <li class="kelas_item_riwayat">
                                            <a href="javascript:void(0);" class="dropdown-item"
                                                onclick="pilihKelas('{{ $k->id }}', '{{ $k->nama_kelas }}', 'riwayat')">
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
                                <option value="">Pilih Tahun Pelajaran</option>
                                @foreach($tahunPelajarans as $tp)
                                    <option value="{{ $tp->id }}">{{ $tp->tahun }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="semester">Semester</label>
                            <select name="semester" class="form-control" required>
                                <option value="">Pilih Semester</option>
                                <option value="1">1 (Ganjil)</option>
                                <option value="2">2 (Genap)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function filterKelas(type) {
        const input = document.getElementById(`kelas_input`).value.toLowerCase();
        const list = document.getElementById(`kelas_list_${type}`);
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
        document.getElementById(`kelas_input`).value = nama;
        document.getElementById(`kelas_id`).value = id;
        document.getElementById(`kelas_list_${type}`).style.display = "none";
    }

    document.addEventListener("click", function (event) {
        const list = document.getElementById(`kelas_list_riwayat`);
        const input = document.getElementById(`kelas_input`);
        if (!list.contains(event.target) && !input.contains(event.target)) {
            list.style.display = "none";
        }
    });

    function filterSiswa() {
        const input = document.getElementById('siswa_input').value.toLowerCase();
        const list = document.getElementById('siswa_list');
        const items = document.querySelectorAll('.siswa_item');
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

    function pilihSiswa(id, nama) {
        document.getElementById('siswa_input').value = nama;
        document.getElementById('siswa_id').value = id;
        document.getElementById('siswa_list').style.display = "none";
    }

    document.addEventListener("click", function (event) {
        const list = document.getElementById('siswa_list');
        const input = document.getElementById('siswa_input');
        if (!list.contains(event.target) && !input.contains(event.target)) {
            list.style.display = "none";
        }
    });
</script>
@endsection
