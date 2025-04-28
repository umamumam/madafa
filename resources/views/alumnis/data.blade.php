@extends('layouts1.app')

@section('content')
<div class="container">
    <h1>Data Alumni</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    {{-- <div class="card mb-4">
        <div class="card-header">
            <strong>Import File Alumni</strong>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('alumnis.import') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file">Pilih File Excel (.xlsx, .csv):</label>
                    <input type="file" name="file" accept=".xlsx, .csv" required class="form-control">
                </div>
                <button type="submit" class="btn btn-info mt-3">Import</button>
            </form>
        </div>
    </div> --}}
    <div class="card mb-4">
        <div class="card-header">
            <strong>Alumni MTs Darul Falah</strong>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('alumnis.export') }}">
                @csrf
                <div class="mb-3">
                    <a href="{{ route('alumnis.create') }}" class="btn btn-primary">Tambah Alumni</a>
                    <button type="submit" class="btn btn-success">Export Yang Dipilih</button>
                </div>
                <div class="card-body" style="overflow-x:auto;">
                    <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                        style="width: 100%">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>Nama Siswa</th>
                                <th>NIS</th>
                                <th>NISN</th>
                                <th>Program</th>
                                <th>Kelas</th>
                                <th>Aksi</th>  <!-- Menambahkan kolom aksi untuk tombol edit dan delete -->
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($alumnis as $alumni)
                                <tr>
                                    <td><input type="checkbox" name="selected[]" value="{{ $alumni->id }}"></td>
                                    <td>{{ $alumni->nama_siswa }}</td>
                                    <td>{{ $alumni->nis }}</td>
                                    <td>{{ $alumni->nisn }}</td>
                                    <td>{{ $alumni->program }}</td>
                                    <td>{{ $alumni->kelas }}</td>
                                    <td>
                                        <a href="{{ route('alumnis.edit', $alumni->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form method="POST" action="{{ route('alumnis.destroy', $alumni->id) }}" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus alumni ini?')">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data alumni.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('select-all').onclick = function() {
        let checkboxes = document.getElementsByName('selected[]');
        for (let checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    }
</script>

@endsection
