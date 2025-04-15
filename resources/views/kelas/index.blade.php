@extends('layouts1.app')

@section('content')
<div class="row">
    <!-- Config table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Kelas</h4>
                {{-- <small>The Responsive extension for DataTables can be applied to a DataTable in one of two ways; with a
                    specific class name on
                    the table.</small> --}}
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Kelas</button>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                {{-- <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari Nama Kelas..."> --}}
                <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                    style="width: 100%">
                    <thead style="background-color: #e9f5ff;">
                        <tr>
                            <th>Nama Kelas</th>
                            <th>Program</th>
                            <th>Wali Kelas</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $kelas)
                        <tr>
                            <td>{{ $kelas->nama_kelas }}</td>
                            <td>{{ $kelas->program->program }}</td>
                            <td>{{ $kelas->walikelas ? $kelas->walikelas->nama_guru : '-' }}</td>
                            <td>
                                <span class="badge {{ $kelas->active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $kelas->active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td>
                                <!-- Button edit with icon -->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $kelas->id }}">
                                    <i class="fa fa-pencil-alt"></i>
                                    <span class="d-none d-sm-inline"> Edit</span>
                                </button>

                                <!-- Form hapus with icon -->
                                <form action="{{ route('kelas.destroy', $kelas->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus kelas ini?')" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-alt"></i>
                                        <span class="d-none d-sm-inline"> Hapus</span>
                                    </button>
                                </form>
                            </td>

                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $kelas->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Edit Kelas</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-2">
                                                <label>Nama Kelas</label>
                                                <input type="text" name="nama_kelas" class="form-control"
                                                    value="{{ $kelas->nama_kelas }}" required>
                                            </div>
                                            <div class="mb-2">
                                                <label>Program</label>
                                                <select name="program_id" class="form-control">
                                                    @foreach ($programs as $program)
                                                    <option value="{{ $program->id }}" {{ $kelas->program_id == $program->id ?
                                                        'selected' : '' }}>
                                                        {{ $program->program }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                <label>Wali Kelas</label>
                                                <select name="walikelas_id" class="form-control">
                                                    <option value="">-- Pilih Wali Kelas --</option>
                                                    @foreach ($gurus as $guru)
                                                    <option value="{{ $guru->id }}" {{ $kelas->walikelas_id == $guru->id ?
                                                        'selected' : '' }}>
                                                        {{ $guru->nama_guru }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-check">
                                                <!-- Input hidden untuk menangani checkbox tidak dicentang -->
                                                <input type="hidden" name="active" value="0">
                                                <input type="checkbox" class="form-check-input" name="active" value="1" {{
                                                    $kelas->active ? 'checked' : '' }}>
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
    <!-- Config table end -->
</div>
<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('kelas.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Nama Kelas</label>
                        <input type="text" name="nama_kelas" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Program</label>
                        <select name="program_id" class="form-control">
                            @foreach ($programs as $program)
                            <option value="{{ $program->id }}">{{ $program->program }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Wali Kelas</label>
                        <select name="walikelas_id" class="form-control">
                            <option value="">-- Pilih Wali Kelas --</option>
                            @foreach ($gurus as $guru)
                            <option value="{{ $guru->id }}">{{ $guru->nama_guru }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-check">
                        <!-- Input hidden untuk menangani checkbox tidak dicentang -->
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
