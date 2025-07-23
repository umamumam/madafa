@extends('layouts1.app')

@section('content')
<div class="container">
    <h2>Tambah Pembayaran Baru</h2>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="{{ route('pembayaran.store', $siswa->id) }}">
        @csrf

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
                        <option value="{{ $guru->id }}" {{ old('guru_id')==$guru->id ? 'selected' : '' }}>
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

                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="SPP"
                                class="form-check-input jenis-checkbox" id="spp">
                            <label class="form-check-label" for="spp">SPP</label>
                            <input type="number" name="nominal_spp" class="form-control mt-1 nominal-input"
                                placeholder="Nominal SPP" disabled>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="Dana Abadi"
                                class="form-check-input jenis-checkbox" id="dana_abadi">
                            <label class="form-check-label" for="dana_abadi">Dana Abadi</label>
                            <input type="number" name="nominal_dana_abadi" class="form-control mt-1 nominal-input"
                                placeholder="Nominal Dana Abadi" disabled>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="BOP Semester 1"
                                class="form-check-input jenis-checkbox" id="bop_smt1">
                            <label class="form-check-label" for="bop_smt1">BOP Semester 1</label>
                            <input type="number" name="nominal_bop_smt1" class="form-control mt-1 nominal-input"
                                placeholder="Nominal BOP Semester 1" disabled>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="BOP Semester 2"
                                class="form-check-input jenis-checkbox" id="bop_smt2">
                            <label class="form-check-label" for="bop_smt2">BOP Semester 2</label>
                            <input type="number" name="nominal_bop_smt2" class="form-control mt-1 nominal-input"
                                placeholder="Nominal BOP Semester 2" disabled>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="Buku LKS"
                                class="form-check-input jenis-checkbox" id="buku_lks">
                            <label class="form-check-label" for="buku_lks">Buku LKS</label>
                            <input type="number" name="nominal_buku_lks" class="form-control mt-1 nominal-input"
                                placeholder="Nominal Buku LKS" disabled>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="Kitab"
                                class="form-check-input jenis-checkbox" id="kitab">
                            <label class="form-check-label" for="kitab">Kitab</label>
                            <input type="number" name="nominal_kitab" class="form-control mt-1 nominal-input"
                                placeholder="Nominal Kitab" disabled>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="Seragam"
                                class="form-check-input jenis-checkbox" id="seragam">
                            <label class="form-check-label" for="seragam">Seragam</label>
                            <input type="number" name="nominal_seragam" class="form-control mt-1 nominal-input"
                                placeholder="Nominal Seragam" disabled>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="Infaq Madrasah"
                                class="form-check-input jenis-checkbox" id="infaq_madrasah">
                            <label class="form-check-label" for="infaq_madrasah">Infaq Madrasah</label>
                            <input type="number" name="nominal_infaq_madrasah" class="form-control mt-1 nominal-input"
                                placeholder="Nominal Infaq Madrasah" disabled>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="Infaq Kalender"
                                class="form-check-input jenis-checkbox" id="infaq_kalender">
                            <label class="form-check-label" for="infaq_kalender">Infaq Kalender</label>
                            <input type="number" name="nominal_infaq_kelender" class="form-control mt-1 nominal-input"
                                placeholder="Nominal Infaq Kalender" disabled>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="Lain-lain"
                                class="form-check-input jenis-checkbox" id="lain_lain">
                            <label class="form-check-label" for="lain_lain">Lain-lain</label>
                            <input type="number" name="nominal_lainlain" class="form-control mt-1 nominal-input"
                                placeholder="Nominal Lain-lain" disabled>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Bayar <span style="color: red">*</span></label>
                        <input type="date" name="tgl_bayar" class="form-control" required
                            value="{{ old('tgl_bayar', date('Y-m-d')) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status <span style="color: red">*</span></label>
                        <select name="status" class="form-control" required>
                            <option value="Cash" {{ old('status')=='Cash' ? 'selected' : '' }}>Cash</option>
                            <option value="Transfer" {{ old('status')=='Transfer' ? 'selected' : '' }}>Transfer</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="2">{{ old('keterangan') }}</textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Simpan Pembayaran
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

    // Set nilai old jika ada error validation
    @if(old('jenis_pembayaran'))
        @foreach(old('jenis_pembayaran') as $jenis)
            const checkbox = document.querySelector(`input[name="jenis_pembayaran[]"][value="{{ $jenis }}"]`);
            if (checkbox) {
                checkbox.checked = true;
                const nominalInput = checkbox.closest('.form-check').querySelector('.nominal-input');
                nominalInput.disabled = false;
                nominalInput.required = true;

                // Set nilai nominal jika ada
                const nominalName = nominalInput.name;
                @if(old(nominalName))
                    nominalInput.value = "{{ old(nominalName) }}";
                @endif
            }
        @endforeach
    @endif
});
</script>
@endsection
