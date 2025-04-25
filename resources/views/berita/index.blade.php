@extends('layouts1.app')

@section('content')
<div class="row">
    <!-- Config table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3>Manajemen Berita</h3>
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Berita</button>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                    style="width: 100%">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($beritas as $berita)
                            <tr>
                                <td>{{ $berita->judul }}</td>
                                <td>{{ $berita->tanggal }}</td>
                                <td>{!! nl2br(e(Str::limit($berita->deskripsi, 100))) !!}</td>
                                <td>
                                    @if($berita->gambar)
                                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" width="100">
                                    @endif
                                </td>
                                <td>
                                    {{-- Edit --}}
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $berita->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>

                                    {{-- Hapus --}}
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $berita->id }}">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </td>
                            </tr>

                            {{-- Modal Edit --}}
                            <div class="modal fade" id="editModal{{ $berita->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Berita</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label>Judul</label>
                                                    <input type="text" name="judul" class="form-control" value="{{ $berita->judul }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Tanggal</label>
                                                    <input type="date" name="tanggal" class="form-control" value="{{ $berita->tanggal }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Deskripsi</label>
                                                    <textarea name="deskripsi" class="form-control" rows="4" required>{{ $berita->deskripsi }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Gambar</label>
                                                    <input type="file" name="gambar" class="form-control" accept="image/*">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal Hapus --}}
                            <div class="modal fade" id="hapusModal{{ $berita->id }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus Berita</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus berita ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('berita.destroy', $berita->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah Berita --}}
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Berita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
