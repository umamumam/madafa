@extends('layouts1.app')

@section('content')
<div class="container">
    <h2>Edit Pembayaran</h2>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST"
        action="{{ route('pembayaran.update', ['siswa_id' => $siswa->id, 'pembayaran_id' => $pembayaran->id]) }}">
        @csrf
        @method('PUT')

        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Detail Pembayaran - {{ $siswa->nama_siswa }}</h5>
            </div>
            <div class="card-body">
                <!-- Input petugas -->
                <div class="mb-3">
                    <label class="form-label">Petugas</label>
                    <select name="guru_id" class="form-control">
                        <option value="">-- Pilih Petugas --</option>
                        @foreach($gurus as $guru)
                        <option value="{{ $guru->id }}" {{ (old('guru_id', $pembayaran->guru_id) )== $guru->id
                            ?'selected' : '' }}>
                            {{ $guru->nama_guru }}
                        </option>
                        @endforeach
                    </select>
                    @error('guru_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <label class="form-label">Jenis Pembayaran</label>

                    @php
                    $selectedJenis = old('jenis_pembayaran', $selectedJenis);
                    @endphp
                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="SPP"
                                class="form-check-input jenis-checkbox" id="spp" {{ in_array('SPP', $selectedJenis)
                                ? 'checked' : '' }}>
                            <label class="form-check-label" for="spp">SPP</label>
                            <input type="number" name="nominal_spp" class="form-control mt-1 nominal-input"
                                placeholder="Nominal SPP" value="{{ old('nominal_spp', $pembayaran->nominal_spp) }}" {{
                                in_array('SPP', $selectedJenis) ? '' : 'disabled' }}>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="Dana Abadi"
                                class="form-check-input jenis-checkbox" id="dana_abadi" {{ in_array('Dana Abadi',
                                $selectedJenis) ? 'checked' : '' }}>
                            <label class="form-check-label" for="dana_abadi">Dana Abadi</label>
                            <input type="number" name="nominal_dana_abadi" class="form-control mt-1 nominal-input"
                                placeholder="Nominal Dana Abadi"
                                value="{{ old('nominal_dana_abadi', $pembayaran->nominal_dana_abadi) }}" {{
                                in_array('Dana Abadi', $selectedJenis) ? '' : 'disabled' }}>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="BOP Semester 1"
                                class="form-check-input jenis-checkbox" id="bop_smt1" {{ in_array('BOP Semester 1',
                                $selectedJenis) ? 'checked' : '' }}>
                            <label class="form-check-label" for="bop_smt1">BOP Semester 1</label>
                            <input type="number" name="nominal_bop_smt1" class="form-control mt-1 nominal-input"
                                placeholder="Nominal BOP Semester 1"
                                value="{{ old('nominal_bop_smt1', $pembayaran->nominal_bop_smt1) }}" {{ in_array('BOP
                                Semester 1', $selectedJenis) ? '' : 'disabled' }}>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="BOP Semester 2"
                                class="form-check-input jenis-checkbox" id="bop_smt2" {{ in_array('BOP Semester 2',
                                $selectedJenis) ? 'checked' : '' }}>
                            <label class="form-check-label" for="bop_smt2">BOP Semester 2</label>
                            <input type="number" name="nominal_bop_smt2" class="form-control mt-1 nominal-input"
                                placeholder="Nominal BOP Semester 2"
                                value="{{ old('nominal_bop_smt2', $pembayaran->nominal_bop_smt2) }}" {{ in_array('BOP
                                Semester 2', $selectedJenis) ? '' : 'disabled' }}>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="Buku LKS"
                                class="form-check-input jenis-checkbox" id="buku_lks" {{ in_array('Buku LKS',
                                $selectedJenis) ? 'checked' : '' }}>
                            <label class="form-check-label" for="buku_lks">Buku LKS</label>
                            <input type="number" name="nominal_buku_lks" class="form-control mt-1 nominal-input"
                                placeholder="Nominal Buku LKS"
                                value="{{ old('nominal_buku_lks', $pembayaran->nominal_buku_lks) }}" {{ in_array('Buku
                                LKS', $selectedJenis) ? '' : 'disabled' }}>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="Kitab"
                                class="form-check-input jenis-checkbox" id="kitab" {{ in_array('Kitab', $selectedJenis)
                                ? 'checked' : '' }}>
                            <label class="form-check-label" for="kitab">Kitab</label>
                            <input type="number" name="nominal_kitab" class="form-control mt-1 nominal-input"
                                placeholder="Nominal Kitab"
                                value="{{ old('nominal_kitab', $pembayaran->nominal_kitab) }}" {{ in_array('Kitab',
                                $selectedJenis) ? '' : 'disabled' }}>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="Seragam"
                                class="form-check-input jenis-checkbox" id="seragam" {{ in_array('Seragam',
                                $selectedJenis) ? 'checked' : '' }}>
                            <label class="form-check-label" for="seragam">Seragam</label>
                            <input type="number" name="nominal_seragam" class="form-control mt-1 nominal-input"
                                placeholder="Nominal Seragam"
                                value="{{ old('nominal_seragam', $pembayaran->nominal_seragam) }}" {{
                                in_array('Seragam', $selectedJenis) ? '' : 'disabled' }}>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="Infaq Madrasah"
                                class="form-check-input jenis-checkbox" id="infaq_madrasah" {{ in_array('Infaq
                                Madrasah', $selectedJenis) ? 'checked' : '' }}>
                            <label class="form-check-label" for="infaq_madrasah">Infaq Madrasah</label>
                            <input type="number" name="nominal_infaq_madrasah" class="form-control mt-1 nominal-input"
                                placeholder="Nominal Infaq Madrasah"
                                value="{{ old('nominal_infaq_madrasah', $pembayaran->nominal_infaq_madrasah) }}" {{
                                in_array('Infaq Madrasah', $selectedJenis) ? '' : 'disabled' }}>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="Infaq Kalender"
                                class="form-check-input jenis-checkbox" id="infaq_kalender" {{ in_array('Infaq
                                Kalender', $selectedJenis) ? 'checked' : '' }}>
                            <label class="form-check-label" for="infaq_kalender">Infaq Kalender</label>
                            <input type="number" name="nominal_infaq_kelender" class="form-control mt-1 nominal-input"
                                placeholder="Nominal Infaq Kalender"
                                value="{{ old('nominal_infaq_kelender', $pembayaran->nominal_infaq_kelender) }}" {{
                                in_array('Infaq Kalender', $selectedJenis) ? '' : 'disabled' }}>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="Lain-lain"
                                class="form-check-input jenis-checkbox" id="lain_lain" {{ in_array('Lain-lain',
                                $selectedJenis) ? 'checked' : '' }}>
                            <label class="form-check-label" for="lain_lain">Lain-lain</label>
                            <input type="number" name="nominal_lainlain" class="form-control mt-1 nominal-input"
                                placeholder="Nominal Lain-lain"
                                value="{{ old('nominal_lainlain', $pembayaran->nominal_lainlain) }}" {{
                                in_array('Lain-lain', $selectedJenis) ? '' : 'disabled' }}>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Bayar <span style="color: red">*</span></label>
                        <input type="date" name="tgl_bayar" class="form-control" required
                            value="{{ old('tgl_bayar', $pembayaran->tgl_bayar->format('Y-m-d')) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status <span style="color: red">*</span></label>
                        <select name="status" class="form-control" required>
                            <option value="Cash" {{ old('status', $pembayaran->status) == 'Cash' ? 'selected' : ''
                                }}>Cash</option>
                            <option value="Transfer" {{ old('status', $pembayaran->status) == 'Transfer' ? 'selected' :
                                '' }}>Transfer</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control"
                        rows="2">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Update Pembayaran
        </button>
        <a href="{{ route('pembayaran.index', $siswa->id) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Aktifkan input nominal saat checkbox dipilih
    document.querySelectorAll('.jenis-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const nominalInput = this.closest('.form-check').querySelector('.nominal-input');
            nominalInput.disabled = !this.checked;
            nominalInput.required = this.checked;
            if (!this.checked) {
                nominalInput.value = '';
            }
        });
    });
});
</script>
@endsection
