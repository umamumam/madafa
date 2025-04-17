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
                <label for="pendidikan_terakhir_id">Pendidikan Terakhir</label>
                <select name="pendidikan_terakhir_id" class="form-control">
                    <option value="">Pilih</option>
                    @foreach($pendidikans as $p)
                        <option value="{{ $p->id }}" {{ old('pendidikan_terakhir_id', $guru->pendidikan_terakhir_id ?? '') == $p->id ? 'selected' : '' }}>
                            {{ $p->pendidikan }}
                        </option>
                    @endforeach
                </select>
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
                    <label>Mapel {{ $i }}</label>
                    <select name="mapel_{{ $i }}_id" class="form-control">
                        <option value="">Pilih</option>
                        @foreach($mapels as $m)
                            <option value="{{ $m->id }}" {{ old("mapel_{$i}_id", $guru->{"mapel_{$i}_id"} ?? '') == $m->id ? 'selected' : '' }}>
                                {{ $m->mapel }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endfor
        </div>
        <hr>
        <div class="row mb-3">
            @for($i = 1; $i <= 3; $i++)
                <div class="col-md-4">
                    <label>Jabatan {{ $i }}</label>
                    <select name="jabatan_{{ $i }}_id" class="form-control">
                        <option value="">Pilih</option>
                        @foreach($jabatans as $j)
                            <option value="{{ $j->id }}" {{ old("jabatan_{$i}_id", $guru->{"jabatan_{$i}_id"} ?? '') == $j->id ? 'selected' : '' }}>
                                {{ $j->jabatan }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endfor
        </div>
    </div>
</div>
