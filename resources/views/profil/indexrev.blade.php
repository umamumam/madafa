@extends('layouts1.app')

@section('content')
<div class="container">
    <h2>Profil Pengguna</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <h4>Data Umum</h4>
            @if ($data)
            <p><strong>Nama:</strong> {{ $data->nama_siswa ?? $data->nama_guru }}</p>
            <p><strong>NIS / ID Guru:</strong> {{ $user->nis ?? $user->idguru }}</p>
            <p><strong>Role:</strong> {{ $user->role }}</p>
            <p><strong>Jenis Kelamin:</strong> {{ $data->jeniskelamin->nama ?? '-' }}</p>
            <p><strong>Tempat, Tanggal Lahir:</strong> {{ $data->tempat_lahir }}, {{ \Carbon\Carbon::parse($data->tgl_lahir)->format('d-m-Y') }}</p>
            @if($user->role == 'siswa')
                <p><strong>Kelas:</strong> {{ $data->kelas->nama ?? '-' }}</p>
                <p><strong>Program:</strong> {{ $data->program->nama ?? '-' }}</p>
            @elseif($user->role == 'guru')
                <p><strong>Pendidikan Terakhir:</strong> {{ $data->pendidikanTerakhir->nama ?? '-' }}</p>
                <p><strong>Mapel Utama:</strong> {{ $data->mapel1->nama ?? '-' }}</p>
                <p><strong>Jabatan:</strong> {{ $data->jabatan1->nama ?? '-' }}</p>
            @endif
            <p><strong>Alamat:</strong> {{ $data->alamat ?? '-' }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4>Ubah Password</h4>
            <form action="{{ route('profil.updatePassword') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Password Baru</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Ubah Password</button>
            </form>
        </div>
    </div>
</div>
@endsection
