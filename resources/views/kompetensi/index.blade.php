@extends('layouts1.app')

@section('content')
<div class="row">
    <!-- Config table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Kompetensi</h4>
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Kompetensi</button>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                    style="width: 100%">
                    <thead style="background-color: #e9f5ff;">
                        <tr>
                            <th>Urutan</th>
                            <th>Nama Kompetensi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kompetensis as $kompetensi)
                        <tr>
                            <td>{{ $kompetensi->urutan }}</td>
                            <td>{{ $kompetensi->nama_kompetensi }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $kompetensi->id }}">
                                    <i class="fa fa-pencil-alt"></i>
                                    <span class="d-none d-sm-inline"> Edit</span>
                                </button>

                                <form action="{{ route('kompetensi.destroy', $kompetensi->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus kompetensi ini?')" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-alt"></i>
                                        <span class="d-none d-sm-inline"> Hapus</span>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $kompetensi->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('kompetensi.update', $kompetensi->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Edit Kompetensi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-2">
                                                <label>Urutan</label>
                                                <input type="number" name="urutan" class="form-control" value="{{ $kompetensi->urutan }}" required>
                                            </div>
                                            <div class="mb-2">
                                                <label>Nama Kompetensi</label>
                                                <input type="text" name="nama_kompetensi" class="form-control" value="{{ $kompetensi->nama_kompetensi }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary">Simpan Perubahan</button>
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
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('kompetensi.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah Kompetensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Urutan</label>
                        <input type="number" name="urutan" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Nama Kompetensi</label>
                        <input type="text" name="nama_kompetensi" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
