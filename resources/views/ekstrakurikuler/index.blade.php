@extends('layouts1.app')

@section('content')
<div class="row">
    <!-- Config table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Ekstrakurikuler</h4>
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Ekstrakurikuler</button>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                    style="width: 100%">
                    <thead style="background-color: #e9f5ff;">
                        <tr>
                            <th>Nama Ekskul</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $e)
                        <tr>
                            <td>{{ $e->ekskul }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $e->id }}">
                                    <i class="fa fa-pencil-alt"></i>
                                    <span class="d-none d-sm-inline"> Edit</span>
                                </button>

                                <form action="{{ route('ekstrakurikuler.destroy', $e->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus ekstrakurikuler ini?')" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-alt"></i>
                                        <span class="d-none d-sm-inline"> Hapus</span>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $e->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('ekstrakurikuler.update', $e->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Edit Ekskul</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-2">
                                                <label>Nama Ekskul</label>
                                                <input type="text" name="ekskul" class="form-control" value="{{ $e->ekskul }}" required>
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

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('ekstrakurikuler.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah Ekskul</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Nama Ekskul</label>
                        <input type="text" name="ekskul" class="form-control" required>
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
