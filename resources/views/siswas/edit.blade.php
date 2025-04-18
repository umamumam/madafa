@extends('layouts1.app')

@section('content')
<h1>Edit Data Siswa</h1>
<form action="{{ route('siswas.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card p-3 mb-4">
        <div class="row">
            <div class="col-md-4 mb-2">
                <label for="nis">NIS</label>
                <input type="text" name="nis" class="form-control" value="{{ $siswa->nis }}" required>
            </div>

            <div class="col-md-4 mb-2">
                <label for="nisn">NISN</label>
                <input type="text" name="nisn" class="form-control" value="{{ $siswa->nisn }}">
            </div>

            <div class="col-md-4 mb-2">
                <label for="nik_siswa">NIK Siswa</label>
                <input type="text" name="nik_siswa" class="form-control" value="{{ $siswa->nik_siswa }}">
            </div>

            <div class="col-md-4 mb-2">
                <label for="nama_siswa">Nama Siswa</label>
                <input type="text" name="nama_siswa" class="form-control" value="{{ $siswa->nama_siswa }}" required>
            </div>

            <div class="col-md-4 mb-2">
                <label for="no_kk">Nomor KK</label>
                <input type="text" name="no_kk" class="form-control" value="{{ $siswa->no_kk }}">
            </div>

            <div class="col-md-4 mb-2">
                <label for="jeniskelamin_id">Jenis Kelamin</label>
                <select name="jeniskelamin_id" class="form-control" required>
                    @foreach ($jeniskelimans as $jeniskelamin)
                    <option value="{{ $jeniskelamin->id }}" {{ $siswa->jeniskelamin_id == $jeniskelamin->id ? 'selected'
                        :
                        '' }}>
                        {{ $jeniskelamin->jeniskelamin }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 mb-2">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="{{ $siswa->tempat_lahir }}">
            </div>

            <div class="col-md-4 mb-2">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" value="{{ $siswa->tgl_lahir }}">
            </div>

            <div class="col-md-4 mb-2">
                <label for="anak_ke">Anak Ke</label>
                <input type="number" name="anak_ke" class="form-control" value="{{ $siswa->anak_ke }}">
            </div>

            <div class="col-md-4 mb-2">
                <label for="foto">Foto</label>
                <input type="file" name="foto" class="form-control">
                @if ($siswa->foto)
                <small>Foto saat ini: {{ $siswa->foto }}</small>
                @endif
            </div>

            <div class="col-md-4 mb-2">
                <label for="hp_siswa">No HP Siswa</label>
                <input type="text" name="hp_siswa" class="form-control" value="{{ $siswa->hp_siswa }}">
            </div>

            <div class="col-md-4 mb-2">
                <label for="kode_pos">Kode Pos</label>
                <input type="text" name="kode_pos" class="form-control" value="{{ $siswa->kode_pos }}">
            </div>

            <div class="col-md-4 mb-2">
                <label for="kelas_input">Kelas</label>
                <div class="position-relative">
                    <input type="text" class="form-control" id="kelas_input" name="kelas_input"
                        placeholder="Ketik nama kelas..." oninput="filterKelas()" autocomplete="off"
                        value="{{ old('kelas_nama', $siswa->kelas->nama_kelas ?? '') }}">
                    <input type="hidden" name="kelas_id" id="kelas_id"
                        value="{{ old('kelas_id', $siswa->kelas_id ?? '') }}">

                    <ul id="kelas_list" class="dropdown-menu"
                        style="display: none; width: 100%; position: absolute; z-index: 999; max-height: 200px; overflow-y: auto;">
                        @foreach($kelas as $kls)
                            <li class="kelas_item">
                                <a href="javascript:void(0);" class="dropdown-item"
                                    onclick="pilihKelas('{{ $kls->id }}', '{{ $kls->nama_kelas }}')">
                                    {{ $kls->nama_kelas }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-4 mb-2">
                <label for="program_id">Program</label>
                <select name="program_id" class="form-control" required>
                    <option value="" {{ is_null($siswa->program_id) ? 'selected' : '' }}>-- Pilih Program --</option>
                    @foreach ($programs as $program)
                        <option value="{{ $program->id }}" {{ $siswa->program_id == $program->id ? 'selected' : '' }}>
                            {{ $program->program }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" class="form-control">{{ $siswa->alamat }}</textarea>
            </div>

        </div>
    </div>
    <div class="card p-3 mb-4">
        <h5>Data Orang Tua</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-2">
                    <label for="nik_ayah">NIK Ayah</label>
                    <input type="text" name="nik_ayah" class="form-control" value="{{ $siswa->nik_ayah }}">
                </div>

                <div class="mb-2">
                    <label for="nama_ayah">Nama Ayah</label>
                    <input type="text" name="nama_ayah" class="form-control" value="{{ $siswa->nama_ayah }}">
                </div>

                <div class="mb-2">
                    <label for="pendidikan_ayah_id">Pendidikan Ayah</label>
                    <select name="pendidikan_ayah_id" class="form-control">
                        <option value="" {{ is_null($siswa->pendidikan_ayah_id) ? 'selected' : '' }}>-- Pilih Pendidikan Ayah --</option>
                        @foreach ($pendidikans as $pendidikan)
                            <option value="{{ $pendidikan->id }}" {{ $siswa->pendidikan_ayah_id == $pendidikan->id ? 'selected' : '' }}>
                                {{ $pendidikan->pendidikan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2">
                    <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                    <input type="text" name="pekerjaan_ayah" class="form-control" value="{{ $siswa->pekerjaan_ayah }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <label for="nik_ibu">NIK Ibu</label>
                    <input type="text" name="nik_ibu" class="form-control" value="{{ $siswa->nik_ibu }}">
                </div>

                <div class="mb-2">
                    <label for="nama_ibu">Nama Ibu</label>
                    <input type="text" name="nama_ibu" class="form-control" value="{{ $siswa->nama_ibu }}">
                </div>

                <div class="mb-2">
                    <label for="pendidikan_ibu_id">Pendidikan Ibu</label>
                    <select name="pendidikan_ibu_id" class="form-control">
                        <option value="" {{ is_null($siswa->pendidikan_ibu_id) ? 'selected' : '' }}>-- Pilih Pendidikan Ibu --</option>
                        @foreach ($pendidikans as $pendidikan)
                            <option value="{{ $pendidikan->id }}" {{ $siswa->pendidikan_ibu_id == $pendidikan->id ? 'selected' : '' }}>
                                {{ $pendidikan->pendidikan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2">
                    <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                    <input type="text" name="pekerjaan_ibu" class="form-control" value="{{ $siswa->pekerjaan_ibu }}">
                </div>

            </div>
            <div class="mb-2">
                <label for="hp_ortu">No HP Orang Tua</label>
                <input type="text" name="hp_ortu" class="form-control" value="{{ $siswa->hp_ortu }}">
            </div>
        </div>
    </div>
    <div class="card p-3 mb-4">
        <h5>Data Sekolah Asal</h5>
        <div class="row">
            <div class="col-md-4 mb-2">
                <label for="asal_sekolah">Asal Sekolah</label>
                <input type="text" name="asal_sekolah" class="form-control" value="{{ $siswa->asal_sekolah }}">
            </div>

            <div class="col-md-4 mb-2">
                <label for="npsn">NPSN</label>
                <input type="text" name="npsn" class="form-control" value="{{ $siswa->npsn }}">
            </div>

            <div class="col-md-4 mb-2">
                <label for="nsm">NSM</label>
                <input type="text" name="nsm" class="form-control" value="{{ $siswa->nsm }}">
            </div>

            <div class="mb-2">
                <label for="alamat_sekolah">Alamat Sekolah</label>
                <input type="text" name="alamat_sekolah" class="form-control" value="{{ $siswa->alamat_sekolah }}">
            </div>
        </div>
    </div>
    <div class="card p-3 mb-4">
        <h5>Data Bantuan Sosial</h5>
        <div class="row">
            <div class="col-md-4 mb-2">
                <label for="no_kip">Nomor KIP</label>
                <input type="text" name="no_kip" class="form-control" value="{{ $siswa->no_kip }}">
            </div>

            <div class="col-md-4 mb-2">
                <label for="no_kks">Nomor KKS</label>
                <input type="text" name="no_kks" class="form-control" value="{{ $siswa->no_kks }}">
            </div>

            <div class="col-md-4 mb-2">
                <label for="no_pkh">Nomor PKH</label>
                <input type="text" name="no_pkh" class="form-control" value="{{ $siswa->no_pkh }}">
            </div>
        </div>
    </div>
    <button class="btn btn-primary">Update</button>
</form>
<script>
    function filterKelas() {
        const input = document.getElementById('kelas_input').value.toLowerCase();
        const list = document.getElementById('kelas_list');
        const items = document.querySelectorAll('.kelas_item');
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

    function pilihKelas(id, nama) {
        document.getElementById('kelas_input').value = nama;
        document.getElementById('kelas_id').value = id;
        document.getElementById('kelas_list').style.display = "none";
    }

    document.addEventListener("click", function (event) {
        const list = document.getElementById('kelas_list');
        const input = document.getElementById('kelas_input');
        if (!list.contains(event.target) && !input.contains(event.target)) {
            list.style.display = "none";
        }
    });
</script>

@endsection
