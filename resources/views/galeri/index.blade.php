@extends('layouts1.app')
@section('content')
<div class="row">
    <!-- Config table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3>Galeri</h3>
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Galeri</button>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                    style="width: 100%">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Judul</th>
                            <th>Tahun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($galeris as $item)
                        <tr>
                            <td><img src="{{ asset('storage/' . $item->foto) }}" width="100"></td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->tahun }}</td>
                            <td>
                                <!-- Tombol Edit dengan Icon -->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
                                    <i class="fa fa-pencil-alt"></i>
                                    <span class="d-none d-sm-inline"> Edit</span>
                                </button>

                                <!-- Form Hapus dengan Icon -->
                                <form action="{{ route('galeri.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-alt"></i>
                                        <span class="d-none d-sm-inline"> Hapus</span>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-labelledby="editLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('galeri.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Edit Galeri</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" name="judul" class="form-control mb-2" placeholder="Judul" value="{{ $item->judul }}">
                                            <input type="number" name="tahun" class="form-control mb-2" placeholder="Tahun" value="{{ $item->tahun }}">
                                            <input type="file" name="foto" class="form-control mb-2">
                                            <img src="{{ asset('storage/' . $item->foto) }}" width="100">
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-success">Simpan</button>
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

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah Galeri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="judul" class="form-control mb-2" placeholder="Judul">
                    <input type="number" name="tahun" class="form-control mb-2" placeholder="Tahun">
                    <input type="file" name="foto" class="form-control mb-2">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
