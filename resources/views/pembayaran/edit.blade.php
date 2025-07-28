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
    <form method="POST" action="{{ route('pembayaran.update', [$siswa->id, $pembayaran->id]) }}">
        @csrf
        @method('PUT') {{-- Gunakan metode PUT untuk update --}}

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
                        <option value="{{ $guru->id }}" {{ old('guru_id', $pembayaran->guru_id) == $guru->id ? 'selected' : '' }}>
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
                        $paymentTypes = [
                            'SPP' => ['tagihan_spp', 'nominal_spp'],
                            'Dana Abadi' => ['tagihan_dana_abadi', 'nominal_dana_abadi'],
                            'BOP Semester 1' => ['tagihan_bop_smt1', 'nominal_bop_smt1'],
                            'BOP Semester 2' => ['tagihan_bop_smt2', 'nominal_bop_smt2'],
                            'Buku LKS' => ['tagihan_buku_lks', 'nominal_buku_lks'],
                            'Kitab' => ['tagihan_kitab', 'nominal_kitab'],
                            'Seragam' => ['tagihan_seragam', 'nominal_seragam'],
                            'Infaq Madrasah' => ['tagihan_infaq_madrasah', 'nominal_infaq_madrasah'],
                            'Infaq Kalender' => ['tagihan_infaq_kalender', 'nominal_infaq_kalender'],
                            'Kolektif' => ['tagihan_lainlain', 'nominal_lainlain']
                        ];
                    @endphp

                    {{-- Input untuk Nominal Beasiswa --}}
                    <div class="col-md-12 mb-3">
                        <label for="nominal_beasiswa" class="form-label">Nominal Beasiswa</label>
                        <input type="number" name="nominal_beasiswa" id="nominal_beasiswa"
                            class="form-control"
                            placeholder="Nominal Beasiswa"
                            min="0"
                            value="{{ old('nominal_beasiswa', $pembayaran->nominal_beasiswa ?? 0) }}" disabled>
                        @error('nominal_beasiswa')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @foreach($paymentTypes as $type => $fields)
                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pembayaran[]" value="{{ $type }}"
                                class="form-check-input jenis-checkbox" id="{{ str_replace(' ', '_', strtolower($type)) }}"
                                {{ in_array($type, old('jenis_pembayaran', $selectedJenis)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{ str_replace(' ', '_', strtolower($type)) }}">{{ $type }}</label>

                            <div class="row mt-1">
                                <div class="col-md-6">
                                    <input type="number" name="{{ $fields[0] }}"
                                        class="form-control tagihan-input"
                                        placeholder="Tagihan {{ $type }}"
                                        min="0"
                                        value="{{ old($fields[0], $pembayaran->{$fields[0]} ?? '') }}"
                                        id="{{ $fields[0] }}">
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="{{ $fields[1] }}"
                                        class="form-control nominal-input"
                                        placeholder="Nominal {{ $type }}"
                                        min="0"
                                        value="{{ old($fields[1], $pembayaran->{$fields[1]} ?? '') }}"
                                        id="{{ $fields[1] }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
                            <option value="Cash" {{ old('status', $pembayaran->status) == 'Cash' ? 'selected' : '' }}>Cash</option>
                            <option value="Transfer" {{ old('status', $pembayaran->status) == 'Transfer' ? 'selected' : '' }}>Transfer</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="2">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Perbarui Pembayaran
        </button>
        <a href="{{ route('pembayaran.index', $siswa->id) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sppCheckbox = document.getElementById('spp');
        const tagihanSppInput = document.getElementById('tagihan_spp');
        const nominalSppInput = document.getElementById('nominal_spp');
        const nominalBeasiswaInput = document.getElementById('nominal_beasiswa');

        // Data pembayaran yang ada dari PHP
        const pembayaranData = @json($pembayaran);
        const selectedJenis = @json($selectedJenis);

        // Simpan nilai 'old' dari PHP untuk akses JavaScript
        const oldValues = {
            @foreach(old() as $key => $value)
                '{{ $key }}': @json($value),
            @endforeach
        };

        /**
         * Fungsi untuk memperbarui placeholder dan batas maksimum nominal SPP.
         */
        function updateSppNominalPlaceholder() {
            const tagihanSpp = parseFloat(tagihanSppInput.value) || 0;
            const nominalBeasiswa = parseFloat(nominalBeasiswaInput.value) || 0;
            let calculatedSpp = tagihanSpp - nominalBeasiswa;

            // Pastikan nominal_spp tidak kurang dari nol
            calculatedSpp = Math.max(0, calculatedSpp);

            // Set placeholder untuk nominal_spp
            nominalSppInput.placeholder = 'Nominal SPP (: ' + calculatedSpp + ')';
            nominalSppInput.max = calculatedSpp; // Batasi input agar tidak melebihi nilai yang dihitung
        }

        // --- Pengaturan kondisi awal (saat halaman dimuat) ---
        document.querySelectorAll('.jenis-checkbox').forEach(checkbox => {
            const parent = checkbox.closest('.form-check');
            const nominalInput = parent.querySelector('.nominal-input');
            const tagihanInput = parent.querySelector('.tagihan-input');

            const typeValue = checkbox.value;
            // Tentukan apakah checkbox harus dicentang berdasarkan old input atau data yang ada
            const isCheckedInitially = (oldValues['jenis_pembayaran'] && oldValues['jenis_pembayaran'].includes(typeValue)) ||
                                       (!oldValues['jenis_pembayaran'] && selectedJenis.includes(typeValue));

            if (isCheckedInitially) {
                checkbox.checked = true;
                nominalInput.disabled = false;
                nominalInput.required = true;

                // Set nilai nominal dari oldValues jika ada, jika tidak dari data pembayaran
                if (checkbox.id === 'spp') {
                    // Untuk SPP, nilai awal diambil dari oldValues atau pembayaranData
                    nominalInput.value = oldValues[nominalInput.name] !== undefined ? oldValues[nominalInput.name] : (pembayaranData.nominal_spp || '');
                    updateSppNominalPlaceholder(); // Panggil untuk mengatur placeholder dan max
                } else {
                    // Untuk jenis pembayaran lain
                    nominalInput.value = oldValues[nominalInput.name] !== undefined ? oldValues[nominalInput.name] : (pembayaranData[nominalInput.name] || '');
                    nominalInput.max = parseFloat(tagihanInput.value) || ''; // Set max dari tagihan
                }

                // Jika nominal input masih kosong (setelah mencoba oldValues dan pembayaranData) dan tagihan ada,
                // maka set nominal ke nilai tagihan sebagai default (kecuali untuk SPP yang punya placeholder)
                if (!nominalInput.value && tagihanInput.value && checkbox.id !== 'spp') {
                    nominalInput.value = tagihanInput.value;
                }

            } else {
                checkbox.checked = false;
                nominalInput.disabled = true;
                nominalInput.required = false;
                nominalInput.value = '';
                nominalInput.max = '';
                nominalInput.placeholder = 'Nominal ' + checkbox.labels[0].textContent;
            }
        });

        // Lakukan perhitungan awal untuk placeholder nominal SPP saat halaman dimuat
        // Ini memastikan placeholder SPP selalu benar bahkan jika SPP tidak dicentang awalnya
        updateSppNominalPlaceholder();


        // --- Event Listener ---

        // Listener untuk checkbox jenis pembayaran (termasuk SPP)
        document.querySelectorAll('.jenis-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const parent = this.closest('.form-check');
                const nominalInput = parent.querySelector('.nominal-input');
                const tagihanInput = parent.querySelector('.tagihan-input');

                if (this.checked) {
                    nominalInput.disabled = false;
                    nominalInput.required = true;
                    if (this.id === 'spp') {
                        updateSppNominalPlaceholder(); // Panggil fungsi khusus untuk SPP
                        // Jangan set nominalInput.value di sini, biarkan pengguna input manual
                        // Jika ada old value, itu sudah diatur di inisialisasi awal
                    } else {
                        // Untuk jenis pembayaran lain, set max ke nilai tagihan
                        nominalInput.max = parseFloat(tagihanInput.value) || '';
                        // Jika nominalInput.value kosong, set ke tagihanInput.value sebagai default
                        if (!nominalInput.value && tagihanInput.value) {
                            nominalInput.value = tagihanInput.value;
                        }
                    }
                } else {
                    nominalInput.disabled = true;
                    nominalInput.required = false;
                    nominalInput.value = ''; // Kosongkan nilai saat dinonaktifkan
                    nominalInput.max = ''; // Hapus batasan max
                    nominalInput.placeholder = 'Nominal ' + checkbox.labels[0].textContent; // Kembalikan placeholder default
                }
            });
        });

        // Listener untuk input tagihan_spp
        tagihanSppInput.addEventListener('input', function() {
            updateSppNominalPlaceholder(); // Hitung ulang placeholder nominal_spp saat tagihan_spp berubah
        });

        // Listener untuk input nominal_beasiswa
        nominalBeasiswaInput.addEventListener('input', updateSppNominalPlaceholder); // Hitung ulang placeholder SPP saat beasiswa berubah

        // Listener umum untuk input nominal lainnya (selain SPP) untuk memastikan tidak melebihi tagihan
        document.querySelectorAll('.nominal-input').forEach(input => {
            if (input.id !== 'nominal_spp') {
                input.addEventListener('input', function() {
                    const tagihanInput = this.closest('.form-check').querySelector('.tagihan-input');
                    const nominalValue = parseFloat(this.value) || 0;
                    const tagihanValue = parseFloat(tagihanInput.value) || 0;

                    // Pastikan nominal tidak melebihi tagihan
                    if (nominalValue > tagihanValue) {
                        this.value = tagihanValue;
                    }
                });
            }
        });
    });
</script>
@endsection
