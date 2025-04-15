<div class="row">
    <div class="col-md-6 mb-2">
        <label>Nama</label>
        <input type="text" name="name" class="form-control" value="{{ $edit ? $user->name : old('name') }}" required>
    </div>
    <div class="col-md-6 mb-2">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $edit ? $user->email : old('email') }}" required>
    </div>

    <div class="col-md-6 mb-2">
        <label>Role</label>
        <select name="role" class="form-control" required>
            @foreach(['siswa', 'guru', 'wali kelas', 'admin', 'super admin'] as $role)
                <option value="{{ $role }}" {{ ($edit && $user->role === $role) ? 'selected' : '' }}>
                    {{ ucfirst($role) }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6 mb-2">
        <label>NISN</label>
        <input type="text" name="nisn" class="form-control" value="{{ $edit ? $user->nisn : old('nisn') }}">
    </div>

    <div class="col-md-6 mb-2">
        <label>NIS</label>
        <input type="text" name="nis" class="form-control" value="{{ $edit ? $user->nis : old('nis') }}">
    </div>
    <div class="col-md-6 mb-2">
        <label>ID Guru</label>
        <input type="text" name="idguru" class="form-control" value="{{ $edit ? $user->idguru : old('idguru') }}">
    </div>

    @if ($edit)
    <div class="col-md-6 mb-2">
        <label>Password (Kosongkan jika tidak ingin mengubah)</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="col-md-6 mb-2">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>
    @else
    <div class="col-md-6 mb-2">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="col-md-6 mb-2">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>
    @endif
</div>
