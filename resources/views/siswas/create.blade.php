@extends('layouts1.app')

@section('content')
    <h1>Data Siswa</h1>
    <form action="{{ route('siswas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card p-3 mb-4">
            <div class="row">
                    <div class="col-md-4 mb-2">
                        <label for="nis">NIS</label>
                        <input type="text" name="nis" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="nisn">NISN</label>
                        <input type="text" name="nisn" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="nik_siswa">NIK Siswa</label>
                        <input type="text" name="nik_siswa" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" name="nama_siswa" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="no_kk">Nomor KK</label>
                        <input type="text" name="no_kk" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="jeniskelamin_id">Jenis Kelamin</label>
                        <select name="jeniskelamin_id" class="form-control" required>
                            <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                            @foreach ($jeniskelimans as $jeniskelamin)
                                <option value="{{ $jeniskelamin->id }}">{{ $jeniskelamin->jeniskelamin }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="anak_ke">Anak Ke</label>
                        <input type="number" name="anak_ke" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="hp_siswa">No HP Siswa</label>
                        <input type="text" name="hp_siswa" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="kode_pos">Kode Pos</label>
                        <input type="text" name="kode_pos" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="kelas_id">Kelas</label>
                        <select name="kelas_id" class="form-control" required>
                            <option value="" selected disabled>-- Pilih Kelas --</option>
                            @foreach ($kelas as $kls)
                                <option value="{{ $kls->id }}">{{ $kls->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="program_id">Program</label>
                        <select name="program_id" class="form-control" required>
                            <option value="" selected disabled>-- Pilih Program --</option>
                            @foreach ($programs as $program)
                                <option value="{{ $program->id }}">{{ $program->program }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" class="form-control"></textarea>
                    </div>
            </div>
        </div>

        <div class="card p-3 mb-4">
            <h5>Data Orang Tua</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-2">
                        <label for="nik_ayah">NIK Ayah</label>
                        <input type="text" name="nik_ayah" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="nama_ayah">Nama Ayah</label>
                        <input type="text" name="nama_ayah" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="pendidikan_ayah_id">Pendidikan Ayah</label>
                        <select name="pendidikan_ayah_id" class="form-control">
                            <option value="" selected disabled>-- Pilih Pendidikan Ayah --</option>
                            @foreach ($pendidikans as $pendidikan)
                                <option value="{{ $pendidikan->id }}">{{ $pendidikan->pendidikan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                        <input type="text" name="pekerjaan_ayah" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-2">
                        <label for="nik_ibu">NIK Ibu</label>
                        <input type="text" name="nik_ibu" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="nama_ibu">Nama Ibu</label>
                        <input type="text" name="nama_ibu" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="pendidikan_ibu_id">Pendidikan Ibu</label>
                        <select name="pendidikan_ibu_id" class="form-control">
                            <option value="" selected disabled>-- Pilih Pendidikan Ibu --</option>
                            @foreach ($pendidikans as $pendidikan)
                                <option value="{{ $pendidikan->id }}">{{ $pendidikan->pendidikan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                        <input type="text" name="pekerjaan_ibu" class="form-control">
                    </div>
                </div>
                <div class="mb-2">
                    <label for="hp_ortu">No HP Orang Tua</label>
                    <input type="text" name="hp_ortu" class="form-control">
                </div>
            </div>
        </div>

        <div class="card p-3 mb-4">
            <h5>Data Sekolah Asal</h5>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label for="asal_sekolah">Asal Sekolah</label>
                    <input type="text" name="asal_sekolah" class="form-control">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="npsn">NPSN</label>
                    <input type="text" name="npsn" class="form-control">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="nsm">NSM</label>
                    <input type="text" name="nsm" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="alamat_sekolah">Alamat Sekolah Asal</label>
                    <input type="text" name="alamat_sekolah" class="form-control">
                </div>
            </div>
        </div>

        <div class="card p-3 mb-4">
            <h5>Data Bantuan Sosial</h5>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label for="no_kip">Nomor KIP</label>
                    <input type="text" name="no_kip" class="form-control">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="no_kks">Nomor KKS</label>
                    <input type="text" name="no_kks" class="form-control">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="no_pkh">Nomor PKH</label>
                    <input type="text" name="no_pkh" class="form-control">
                </div>
            </div>
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
@endsection
