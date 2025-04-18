<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <label>ID Guru</label>
                <input type="text" name="idguru" class="form-control" value="{{ old('idguru', $guru->idguru ?? '') }}" {{ isset($guru) ? 'readonly' : '' }} placeholder="di isi inisial tgllahir tanpa spasi">
            </div>
            <div class="col-md-6">
                <label>NIY/NIP</label>
                <input type="text" name="niy_nip" class="form-control" value="{{ old('niy_nip', $guru->niy_nip ?? '') }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>NPK/NUPTK/PEGID</label>
                <input type="text" name="npk_nuptk_pegid" class="form-control" value="{{ old('npk_nuptk_pegid', $guru->npk_nuptk_pegid ?? '') }}">
            </div>
            <div class="col-md-6">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control" value="{{ old('nik', $guru->nik ?? '') }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Nama Guru</label>
                <input type="text" name="nama_guru" class="form-control" value="{{ old('nama_guru', $guru->nama_guru ?? '') }}">
            </div>
            <div class="col-md-6">
                <label>Foto</label>
                @if(isset($guru) && $guru->foto)
                    <div class="mb-2"><img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru" width="100"></div>
                @endif
                <input type="file" name="foto" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $guru->tempat_lahir ?? '') }}">
            </div>
            <div class="col-md-4">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir', $guru->tgl_lahir ?? '') }}">
            </div>
            <div class="col-md-4">
                <label for="jeniskelamin_id">Jenis Kelamin</label>
                <select name="jeniskelamin_id" class="form-control" required>
                    <option value="">Pilih</option>
                    @foreach($jeniskelimans as $jk)
                        <option value="{{ $jk->id }}" {{ old('jeniskelamin_id', $guru->jeniskelamin_id ?? '') == $jk->id ? 'selected' : '' }}>
                            {{ $jk->jeniskelamin }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="pendidikan_input">Pendidikan Terakhir</label>
                    <div class="position-relative">
                        <input type="text" class="form-control" id="pendidikan_input" name="pendidikan_input"
                            placeholder="Ketik pendidikan terakhir..." oninput="filterPendidikan()" autocomplete="off"
                            value="{{ old('pendidikan_terakhir_nama', $guru->pendidikan_terakhir->pendidikan ?? '') }}">
                        <input type="hidden" name="pendidikan_terakhir_id" id="pendidikan_terakhir_id"
                            value="{{ old('pendidikan_terakhir_id', $guru->pendidikan_terakhir_id ?? '') }}">
                        <ul id="pendidikan_list" class="dropdown-menu"
                            style="display: none; width: 100%; position: absolute; z-index: 999; max-height: 200px; overflow-y: auto;">
                            @foreach($pendidikans as $p)
                                <li class="pendidikan_item">
                                    <a href="javascript:void(0);" class="dropdown-item"
                                        onclick="pilihPendidikan('{{ $p->id }}', '{{ $p->pendidikan }}')">
                                        {{ $p->pendidikan }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label>Instansi Pendidikan Terakhir</label>
                <input type="text" name="inst_pend_terakhir" class="form-control" value="{{ old('inst_pend_terakhir', $guru->inst_pend_terakhir ?? '') }}">
            </div>
            <div class="col-md-4">
                <label>TMT SK Awal</label>
                <input type="date" name="tmt_sk_awal" class="form-control" value="{{ old('tmt_sk_awal', $guru->tmt_sk_awal ?? '') }}">
            </div>
        </div>

        <div class="row mb-3">

            <div class="col-md-4">
                <label>Status Guru</label>
                <select name="status_guru_id" class="form-control">
                    <option value="">Pilih</option>
                    @foreach($statusgurus as $sg)
                        <option value="{{ $sg->id }}" {{ old('status_guru_id', $guru->status_guru_id ?? '') == $sg->id ? 'selected' : '' }}>
                            {{ $sg->status }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Masa Kerja</label>
                <input type="number" name="masa_kerja" class="form-control" value="{{ old('masa_kerja', $guru->masa_kerja ?? '') }}">
            </div>
            <div class="col-md-4">
                <label>No. HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $guru->no_hp ?? '') }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control">{{ old('alamat', $guru->alamat ?? '') }}</textarea>
            </div>
        </div>
        <hr>
        <div class="row mb-3">
            @for($i = 1; $i <= 3; $i++)
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="mapel_input_{{ $i }}">Mapel {{ $i }}</label>
                        <div class="position-relative">
                            <input type="text" class="form-control" id="mapel_input_{{ $i }}"
                                name="mapel_input_{{ $i }}" placeholder="Ketik nama mapel..."
                                oninput="filterMapel({{ $i }})" autocomplete="off"
                                value="{{ old("mapel_input_{$i}", $guru->{"mapel_{$i}"}->mapel ?? '') }}">
                            <input type="hidden" name="mapel_{{ $i }}_id" id="mapel_{{ $i }}_id"
                                value="{{ old("mapel_{$i}_id", $guru->{"mapel_{$i}_id"} ?? '') }}">
                            <ul id="mapel_list_{{ $i }}" class="dropdown-menu"
                                style="display: none; width: 100%; position: absolute; z-index: 999; max-height: 200px; overflow-y: auto;">
                                <li class="mapel_item_{{ $i }}">
                                    <a href="javascript:void(0);" class="dropdown-item text-danger"
                                        onclick="hapusMapel({{ $i }})">
                                        -- Hapus Pilihan --
                                    </a>
                                </li>
                                @foreach($mapels as $m)
                                    <li class="mapel_item_{{ $i }}">
                                        <a href="javascript:void(0);" class="dropdown-item"
                                            onclick="pilihMapel('{{ $m->id }}', '{{ $m->mapel }}', {{ $i }})">
                                            {{ $m->mapel }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
        <hr>
        <div class="row mb-3">
            @for($i = 1; $i <= 3; $i++)
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="jabatan_input_{{ $i }}">Jabatan {{ $i }}</label>
                        <div class="position-relative">
                            <input type="text" class="form-control" id="jabatan_input_{{ $i }}"
                                name="jabatan_input_{{ $i }}" placeholder="Ketik nama jabatan..."
                                oninput="filterJabatan({{ $i }})" autocomplete="off"
                                value="{{ old("jabatan_input_{$i}", $guru->{"jabatan_{$i}"}->jabatan ?? '') }}">
                            <input type="hidden" name="jabatan_{{ $i }}_id" id="jabatan_{{ $i }}_id"
                                value="{{ old("jabatan_{$i}_id", $guru->{"jabatan_{$i}_id"} ?? '') }}">
                            <ul id="jabatan_list_{{ $i }}" class="dropdown-menu"
                                style="display: none; width: 100%; position: absolute; z-index: 999; max-height: 200px; overflow-y: auto;">
                                <li class="jabatan_item_{{ $i }}">
                                    <a href="javascript:void(0);" class="dropdown-item text-danger"
                                        onclick="hapusJabatan({{ $i }})">
                                        -- Hapus Pilihan --
                                    </a>
                                </li>
                                @foreach($jabatans as $j)
                                    <li class="jabatan_item_{{ $i }}">
                                        <a href="javascript:void(0);" class="dropdown-item"
                                            onclick="pilihJabatan('{{ $j->id }}', '{{ $j->jabatan }}', {{ $i }})">
                                            {{ $j->jabatan }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
<script>
    function filterPendidikan() {
        const input = document.getElementById('pendidikan_input').value.toLowerCase();
        const list = document.getElementById('pendidikan_list');
        const items = document.querySelectorAll('.pendidikan_item');
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

    function pilihPendidikan(id, nama) {
        document.getElementById('pendidikan_input').value = nama;
        document.getElementById('pendidikan_terakhir_id').value = id;
        document.getElementById('pendidikan_list').style.display = "none";
    }

    document.addEventListener("click", function (event) {
        const list = document.getElementById('pendidikan_list');
        const input = document.getElementById('pendidikan_input');
        if (!list.contains(event.target) && !input.contains(event.target)) {
            list.style.display = "none";
        }
    });
</script>
<script>
    function filterMapel(index) {
        const input = document.getElementById(`mapel_input_${index}`).value.toLowerCase();
        const list = document.getElementById(`mapel_list_${index}`);
        const items = document.querySelectorAll(`.mapel_item_${index}`);
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

    function pilihMapel(id, nama, index) {
        document.getElementById(`mapel_input_${index}`).value = nama;
        document.getElementById(`mapel_${index}_id`).value = id;
        document.getElementById(`mapel_list_${index}`).style.display = "none";
    }

    function filterJabatan(index) {
        const input = document.getElementById(`jabatan_input_${index}`).value.toLowerCase();
        const list = document.getElementById(`jabatan_list_${index}`);
        const items = document.querySelectorAll(`.jabatan_item_${index}`);
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

    function pilihJabatan(id, nama, index) {
        document.getElementById(`jabatan_input_${index}`).value = nama;
        document.getElementById(`jabatan_${index}_id`).value = id;
        document.getElementById(`jabatan_list_${index}`).style.display = "none";
    }

    document.addEventListener("click", function (event) {
        for (let i = 1; i <= 3; i++) {
            const mapelList = document.getElementById(`mapel_list_${i}`);
            const mapelInput = document.getElementById(`mapel_input_${i}`);
            if (mapelList && !mapelList.contains(event.target) && !mapelInput.contains(event.target)) {
                mapelList.style.display = "none";
            }

            const jabatanList = document.getElementById(`jabatan_list_${i}`);
            const jabatanInput = document.getElementById(`jabatan_input_${i}`);
            if (jabatanList && !jabatanList.contains(event.target) && !jabatanInput.contains(event.target)) {
                jabatanList.style.display = "none";
            }
        }
    });
</script>
<script>
    function hapusMapel(index) {
        document.getElementById(`mapel_input_${index}`).value = '';
        document.getElementById(`mapel_${index}_id`).value = '';
        document.getElementById(`mapel_list_${index}`).style.display = "none";
    }

    function hapusJabatan(index) {
        document.getElementById(`jabatan_input_${index}`).value = '';
        document.getElementById(`jabatan_${index}_id`).value = '';
        document.getElementById(`jabatan_list_${index}`).style.display = "none";
    }
</script>
