@extends('layouts1.app')

@section('content')
    <h1>Edit Siswa</h1>
    <form action="{{ route('siswas.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-2">
            <label for="nis">NIS</label>
            <input type="text" name="nis" class="form-control" value="{{ $siswa->nis }}" required>
        </div>

        <div class="mb-2">
            <label for="nisn">NISN</label>
            <input type="text" name="nisn" class="form-control" value="{{ $siswa->nisn }}">
        </div>

        <div class="mb-2">
            <label for="nik_siswa">NIK Siswa</label>
            <input type="text" name="nik_siswa" class="form-control" value="{{ $siswa->nik_siswa }}">
        </div>

        <div class="mb-2">
            <label for="nama_siswa">Nama Siswa</label>
            <input type="text" name="nama_siswa" class="form-control" value="{{ $siswa->nama_siswa }}" required>
        </div>

        <div class="mb-2">
            <label for="foto">Foto</label>
            <input type="file" name="foto" class="form-control">
            @if ($siswa->foto)
                <small>Foto saat ini: {{ $siswa->foto }}</small>
            @endif
        </div>

        <div class="mb-2">
            <label for="jeniskelamin_id">Jenis Kelamin</label>
            <select name="jeniskelamin_id" class="form-control" required>
                @foreach ($jeniskelimans as $jeniskelamin)
                    <option value="{{ $jeniskelamin->id }}" {{ $siswa->jeniskelamin_id == $jeniskelamin->id ? 'selected' : '' }}>
                        {{ $jeniskelamin->jeniskelamin }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control" value="{{ $siswa->tempat_lahir }}">
        </div>

        <div class="mb-2">
            <label for="tgl_lahir">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="form-control" value="{{ $siswa->tgl_lahir }}">
        </div>

        <div class="mb-2">
            <label for="kelas_id">Kelas</label>
            <select name="kelas_id" class="form-control" required>
                @foreach ($kelas as $kls)
                    <option value="{{ $kls->id }}" {{ $siswa->kelas_id == $kls->id ? 'selected' : '' }}>
                        {{ $kls->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label for="program_id">Program</label>
            <select name="program_id" class="form-control" required>
                @foreach ($programs as $program)
                    <option value="{{ $program->id }}" {{ $siswa->program_id == $program->id ? 'selected' : '' }}>
                        {{ $program->program }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label for="anak_ke">Anak Ke</label>
            <input type="number" name="anak_ke" class="form-control" value="{{ $siswa->anak_ke }}">
        </div>

        <div class="mb-2">
            <label for="no_kk">Nomor KK</label>
            <input type="text" name="no_kk" class="form-control" value="{{ $siswa->no_kk }}">
        </div>

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

        <div class="mb-2">
            <label for="hp_siswa">No HP Siswa</label>
            <input type="text" name="hp_siswa" class="form-control" value="{{ $siswa->hp_siswa }}">
        </div>

        <div class="mb-2">
            <label for="hp_ortu">No HP Orang Tua</label>
            <input type="text" name="hp_ortu" class="form-control" value="{{ $siswa->hp_ortu }}">
        </div>

        <div class="mb-2">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" class="form-control">{{ $siswa->alamat }}</textarea>
        </div>

        <div class="mb-2">
            <label for="kode_pos">Kode Pos</label>
            <input type="text" name="kode_pos" class="form-control" value="{{ $siswa->kode_pos }}">
        </div>

        <div class="mb-2">
            <label for="asal_sekolah">Asal Sekolah</label>
            <input type="text" name="asal_sekolah" class="form-control" value="{{ $siswa->asal_sekolah }}">
        </div>

        <div class="mb-2">
            <label for="npsn">NPSN</label>
            <input type="text" name="npsn" class="form-control" value="{{ $siswa->npsn }}">
        </div>

        <div class="mb-2">
            <label for="nsm">NSM</label>
            <input type="text" name="nsm" class="form-control" value="{{ $siswa->nsm }}">
        </div>

        <div class="mb-2">
            <label for="alamat_sekolah">Alamat Sekolah</label>
            <input type="text" name="alamat_sekolah" class="form-control" value="{{ $siswa->alamat_sekolah }}">
        </div>

        <div class="mb-2">
            <label for="no_kip">Nomor KIP</label>
            <input type="text" name="no_kip" class="form-control" value="{{ $siswa->no_kip }}">
        </div>

        <div class="mb-2">
            <label for="no_kks">Nomor KKS</label>
            <input type="text" name="no_kks" class="form-control" value="{{ $siswa->no_kks }}">
        </div>

        <div class="mb-2">
            <label for="no_pkh">Nomor PKH</label>
            <input type="text" name="no_pkh" class="form-control" value="{{ $siswa->no_pkh }}">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
@endsection
