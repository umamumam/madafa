@extends('layouts1.app')

@section('content')
<div class="row">
    <!-- Config table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Tahun Pelajaran</h4>
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Tahun Pelajaran</button>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                    style="width: 100%">
                    <thead style="background-color: #e9f5ff;">
                        <tr>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $tp)
                        <tr>
                            <td>{{ $tp->tahun }}</td>
                            <td><span class="badge {{ $tp->active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $tp->active ? 'Aktif' : 'Tidak Aktif' }}
                            </span></td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $tp->id }}">
                                    <i class="fa fa-pencil-alt"></i>
                                    <span class="d-none d-sm-inline"> Edit</span>
                                </button>

                                <form action="{{ route('tahun.destroy', $tp->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus tahun ini?')" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-alt"></i>
                                        <span class="d-none d-sm-inline"> Hapus</span>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $tp->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('tahun.update', $tp->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Edit Tahun Pelajaran</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-2">
                                                <label>Tahun</label>
                                                <input type="text" name="tahun" class="form-control" value="{{ $tp->tahun }}" required>
                                            </div>
                                            <div class="form-check">
                                                <input type="hidden" name="active" value="0">
                                                <input type="checkbox" class="form-check-input" name="active" value="1" {{ $tp->active ? 'checked' : '' }}>
                                                <label class="form-check-label">Aktif</label>
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
        <form action="{{ route('tahun.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah Tahun Pelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Tahun</label>
                        <input type="text" name="tahun" class="form-control" required>
                    </div>
                    <div class="form-check">
                        <input type="hidden" name="active" value="0">
                        <input type="checkbox" class="form-check-input" name="active" value="1" checked>
                        <label class="form-check-label">Aktif</label>
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
