@extends('layouts1.app')

@section('content')
    <div class="container">
        <h1>Edit Data Siswa</h1>
        <div class="row mt-4">
            <!-- Card Kiri: Update Foto -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Foto Siswa</div>
                    <div class="card-body text-center">
                        @if ($siswa->foto)
                            <img src="{{ asset('storage/' . $siswa->foto) }}" alt="Foto Siswa" class="img-fluid mb-3" style="max-height: 250px;">
                        @else
                            <p>Belum ada foto</p>
                        @endif
                        <form action="{{ route('siswas.update-siswa', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-2">
                                <input type="file" name="foto" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Update Foto</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Card Kanan: Edit Data -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Data Siswa</div>
                    <div class="card-body">
                        <form action="{{ route('siswas.update-siswa', $siswa->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-2">
                                <label>Nama Siswa</label>
                                <input type="text" name="nama_siswa" class="form-control" value="{{ $siswa->nama_siswa }}" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>NIS</label>
                                    <input type="text" name="nis" class="form-control" value="{{ $siswa->nis }}" disabled>
                                </div>

                                <div class="col-md-6">
                                    <label>NISN</label>
                                    <input type="text" name="nisn" class="form-control" value="{{ $siswa->nisn }}" disabled>
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label>Tempat, Tanggal Lahir</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="tempat_lahir" class="form-control" value="{{ $siswa->tempat_lahir }}">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" name="tgl_lahir" class="form-control" value="{{ $siswa->tgl_lahir }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Jenis Kelamin</label>
                                    <select name="jeniskelamin_id" class="form-control" required>
                                        @foreach ($jeniskelimans as $jk)
                                            <option value="{{ $jk->id }}" {{ $siswa->jeniskelamin_id == $jk->id ? 'selected' : '' }}>
                                                {{ $jk->jeniskelamin }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>No. HP</label>
                                    <input type="text" name="hp_siswa" class="form-control" value="{{ $siswa->hp_siswa }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Kelas</label>
                                    <select name="kelas_id" class="form-control" required>
                                        @foreach ($kelas as $k)
                                            <option value="{{ $k->id }}" {{ $siswa->kelas_id == $k->id ? 'selected' : '' }}>
                                                {{ $k->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>Program</label>
                                    <select name="program_id" class="form-control" required>
                                        @foreach ($programs as $program)
                                            <option value="{{ $program->id }}" {{ $siswa->program_id == $program->id ? 'selected' : '' }}>
                                                {{ $program->program }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control">{{ $siswa->alamat }}</textarea>
                            </div>

                            <button class="btn btn-success w-100">Update Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
