@extends('layouts1.app')

@section('content')
<div class="row">
    <!-- Config table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Penyemak</h4>
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Penyemak</button>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                    style="width: 100%">
                    <thead style="background-color: #e9f5ff;">
                        <tr>
                            <th>Nama Guru</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $p)
                        <tr>
                            <td>{{ $p->guru->nama_guru ?? '-' }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $p->id }}">
                                    <i class="fa fa-pencil-alt"></i>
                                    <span class="d-none d-sm-inline"> Edit</span>
                                </button>

                                <form action="{{ route('penyemak.destroy', $p->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus penyemak ini?')" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-alt"></i>
                                        <span class="d-none d-sm-inline"> Hapus</span>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $p->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('penyemak.update', $p->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Edit Penyemak</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-2">
                                                <label>Nama Guru</label>
                                                <input type="text" class="form-control" id="guru_input_{{ $p->id }}"
                                                    placeholder="Ketik nama guru..."
                                                    value="{{ $p->guru->nama_guru ?? '' }}"
                                                    oninput="filterGuru({{ $p->id }})" autocomplete="off">
                                                <input type="hidden" name="guru_id" id="guru_id_{{ $p->id }}" value="{{ $p->guru_id }}">
                                                <ul id="guru_list_{{ $p->id }}" class="dropdown-menu show"
                                                    style="width: 100%; display: none; position: absolute; top: 100%; left: 0; z-index: 10;
                                                    max-height: 200px; overflow-y: auto; border-radius: 5px; padding: 5px;
                                                    border: 1px solid #ced4da; background: white;">
                                                    @foreach ($gurus as $guru)
                                                        <li class="guru_item_{{ $p->id }}">
                                                            <a href="javascript:void(0);" class="dropdown-item"
                                                                onclick="pilihGuru('{{ $guru->id }}', '{{ $guru->nama_guru }}', {{ $p->id }})">
                                                                {{ $guru->nama_guru }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
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

<!-- Modal Tambah Penyemak -->
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('penyemak.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah Penyemak</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Nama Guru</label>
                        <input type="text" class="form-control" id="guru_input_create" placeholder="Ketik nama guru..."
                            oninput="filterGuruCreate()" autocomplete="off">
                        <input type="hidden" name="guru_id" id="guru_id_create">
                        <ul id="guru_list_create" class="dropdown-menu show"
                            style="width: 100%; display: none; position: absolute; top: 100%; left: 0; z-index: 10;
                            max-height: 200px; overflow-y: auto; border-radius: 5px; padding: 5px;
                            border: 1px solid #ced4da; background: white;">
                            @foreach ($gurus as $guru)
                                <li class="guru_item_create">
                                    <a href="javascript:void(0);" class="dropdown-item"
                                        onclick="pilihGuruCreate('{{ $guru->id }}', '{{ $guru->nama_guru }}')">
                                        {{ $guru->nama_guru }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
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
    function filterGuru(id) {
        const input = document.getElementById(`guru_input_${id}`).value.toLowerCase();
        const list = document.getElementById(`guru_list_${id}`);
        const items = document.querySelectorAll(`.guru_item_${id}`);
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
    function pilihGuru(guruId, guruNama, id) {
        document.getElementById(`guru_input_${id}`).value = guruNama;
        document.getElementById(`guru_id_${id}`).value = guruId;
        document.getElementById(`guru_list_${id}`).style.display = "none";
    }
    function filterGuruCreate() {
        const input = document.getElementById('guru_input_create').value.toLowerCase();
        const list = document.getElementById('guru_list_create');
        const items = document.querySelectorAll('.guru_item_create');
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
    function pilihGuruCreate(guruId, guruNama) {
        document.getElementById('guru_input_create').value = guruNama;
        document.getElementById('guru_id_create').value = guruId;
        document.getElementById('guru_list_create').style.display = "none";
    }
    document.addEventListener("click", function (event) {
        document.querySelectorAll('[id^="guru_list_"]').forEach(function(list) {
            if (!list.contains(event.target) && !event.target.id.includes("guru_input")) {
                list.style.display = "none";
            }
        });
    });
</script>

@endsection
