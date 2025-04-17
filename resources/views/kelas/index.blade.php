@extends('layouts1.app')

@section('content')
<div class="row">
    <!-- Config table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Kelas</h4>
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Kelas</button>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                    style="width: 100%">
                    <thead style="background-color: #e9f5ff;">
                        <tr>
                            <th>Nama Kelas</th>
                            <th>Program</th>
                            <th>Wali Kelas</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $kelas)
                        <tr>
                            <td>{{ $kelas->nama_kelas }}</td>
                            <td>{{ $kelas->program->program }}</td>
                            <td>{{ $kelas->walikelas ? $kelas->walikelas->nama_guru : '-' }}</td>
                            <td>
                                <span class="badge {{ $kelas->active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $kelas->active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $kelas->id }}">
                                    <i class="fa fa-pencil-alt"></i>
                                    <span class="d-none d-sm-inline"> Edit</span>
                                </button>
                                <form action="{{ route('kelas.destroy', $kelas->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus kelas ini?')" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-alt"></i>
                                        <span class="d-none d-sm-inline"> Hapus</span>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="editModal{{ $kelas->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Edit Kelas</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-2">
                                                <label>Nama Kelas</label>
                                                <input type="text" name="nama_kelas" class="form-control"
                                                    value="{{ $kelas->nama_kelas }}" required>
                                            </div>
                                            <div class="mb-2">
                                                <label>Program</label>
                                                <select name="program_id" class="form-control">
                                                    @foreach ($programs as $program)
                                                    <option value="{{ $program->id }}" {{ $kelas->program_id == $program->id ?
                                                        'selected' : '' }}>
                                                        {{ $program->program }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{-- <div class="mb-2">
                                                <label>Wali Kelas</label>
                                                <select name="walikelas_id" class="form-control">
                                                    <option value="">-- Pilih Wali Kelas --</option>
                                                    @foreach ($gurus as $guru)
                                                    <option value="{{ $guru->id }}" {{ $kelas->walikelas_id == $guru->id ?
                                                        'selected' : '' }}>
                                                        {{ $guru->nama_guru }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div> --}}
                                            <div class="mb-2 position-relative">
                                                <label>Wali Kelas</label>
                                                <input type="text" class="form-control" id="walikelas_input_{{ $kelas->id }}"
                                                    placeholder="Ketik nama guru..."
                                                    oninput="filterWaliKelas({{ $kelas->id }})"
                                                    value="{{ $kelas->walikelas ? $kelas->walikelas->nama_guru : '' }}"
                                                    autocomplete="off">
                                                <input type="hidden" name="walikelas_id" id="walikelas_id_{{ $kelas->id }}" value="{{ $kelas->walikelas_id }}">
                                                <ul id="walikelas_list_{{ $kelas->id }}" class="dropdown-menu show"
                                                    style="width: 100%; display: none; position: absolute; top: 100%; left: 0; z-index: 10;
                                                    max-height: 200px; overflow-y: auto; border-radius: 5px; padding: 5px;
                                                    border: 1px solid #ced4da; background: white;">
                                                    @foreach ($gurus as $guru)
                                                        <li class="walikelas_item_{{ $kelas->id }}">
                                                            <a href="javascript:void(0);" class="dropdown-item"
                                                                onclick="pilihWaliKelas('{{ $guru->id }}', '{{ $guru->nama_guru }}', {{ $kelas->id }})">
                                                                {{ $guru->nama_guru }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="form-check">
                                                <input type="hidden" name="active" value="0">
                                                <input type="checkbox" class="form-check-input" name="active" value="1" {{
                                                    $kelas->active ? 'checked' : '' }}>
                                                <label class="form-check-label">Aktif</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('kelas.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Nama Kelas</label>
                        <input type="text" name="nama_kelas" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Program</label>
                        <select name="program_id" class="form-control">
                            @foreach ($programs as $program)
                            <option value="{{ $program->id }}">{{ $program->program }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="mb-2">
                        <label>Wali Kelas</label>
                        <select name="walikelas_id" class="form-control">
                            <option value="">-- Pilih Wali Kelas --</option>
                            @foreach ($gurus as $guru)
                            <option value="{{ $guru->id }}">{{ $guru->nama_guru }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="mb-2 position-relative">
                        <label>Wali Kelas</label>
                        <input type="text" class="form-control" id="walikelas_input_create"
                            placeholder="Ketik nama guru..." oninput="filterWaliKelasCreate()"
                            autocomplete="off">
                        <input type="hidden" name="walikelas_id" id="walikelas_id_create">
                        <ul id="walikelas_list_create" class="dropdown-menu show"
                            style="width: 100%; display: none; position: absolute; top: 100%; left: 0; z-index: 10;
                            max-height: 200px; overflow-y: auto; border-radius: 5px; padding: 5px;
                            border: 1px solid #ced4da; background: white;">
                            @foreach ($gurus as $guru)
                                <li class="walikelas_item_create">
                                    <a href="javascript:void(0);" class="dropdown-item"
                                        onclick="pilihWaliKelasCreate('{{ $guru->id }}', '{{ $guru->nama_guru }}')">
                                        {{ $guru->nama_guru }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="form-check">
                        <input type="hidden" name="active" value="0">
                        <input type="checkbox" class="form-check-input" name="active" value="1" checked>
                        <label class="form-check-label">Aktif</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function filterWaliKelas(id) {
        const input = document.getElementById(`walikelas_input_${id}`).value.toLowerCase();
        const list = document.getElementById(`walikelas_list_${id}`);
        const items = document.querySelectorAll(`.walikelas_item_${id}`);
        let visibleCount = 0;
        for (let item of items) {
            const text = item.textContent.toLowerCase();
            if (text.includes(input) && visibleCount < 5) {
                item.style.display = "block";
                visibleCount++;
            } else {
                item.style.display = "none";
            }
        }
        list.style.display = visibleCount > 0 ? "block" : "none";
    }
    function pilihWaliKelas(guruId, guruNama, id) {
        document.getElementById(`walikelas_input_${id}`).value = guruNama;
        document.getElementById(`walikelas_id_${id}`).value = guruId;
        document.getElementById(`walikelas_list_${id}`).style.display = "none";
    }
    document.addEventListener("click", function (event) {
        document.querySelectorAll('[id^="walikelas_list_"]').forEach(function(list) {
            if (!list.contains(event.target) && !event.target.id.includes("walikelas_input")) {
                list.style.display = "none";
            }
        });
    });
    function filterWaliKelasCreate() {
        const input = document.getElementById('walikelas_input_create').value.toLowerCase();
        const list = document.getElementById('walikelas_list_create');
        const items = document.querySelectorAll('.walikelas_item_create');
        let visibleCount = 0;
        for (let item of items) {
            const text = item.textContent.toLowerCase();
            if (text.includes(input) && visibleCount < 5) {
                item.style.display = "block";
                visibleCount++;
            } else {
                item.style.display = "none";
            }
        }
        list.style.display = visibleCount > 0 ? "block" : "none";
    }
    function pilihWaliKelasCreate(guruId, guruNama) {
        document.getElementById('walikelas_input_create').value = guruNama;
        document.getElementById('walikelas_id_create').value = guruId;
        document.getElementById('walikelas_list_create').style.display = "none";
    }

</script>

@endsection
