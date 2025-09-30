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
    <form method="POST" action="{{ route('pembayaran.update', [$pembayaran->id]) }}">
        @csrf
        @method('PUT')

        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Detail Pembayaran - {{ $siswa->nama_siswa }}</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Petugas</label>
                    <select name="petugas" class="form-control">
                        <option value="">-- Pilih Petugas --</option>
                        {{-- Mengisi nilai petugas dari database atau dari old() --}}
                        <option value="Anis Maimanah" {{ old('petugas', $pembayaran->petugas) == 'Anis Maimanah' ? 'selected' : '' }}>Anis Maimanah</option>
                        <option value="M. Fahruddin" {{ old('petugas', $pembayaran->petugas) == 'M. Fahruddin' ? 'selected' : '' }}>M. Fahruddin</option>
                        <option value="Lainnya" {{ old('petugas', $pembayaran->petugas) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        <option value="-" {{ old('petugas', $pembayaran->petugas) == '-' ? 'selected' : '' }}>-</option>
                    </select>
                    @error('petugas')
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
                            'Outing Class' => ['tagihan_outing_class', 'nominal_outing_class'],
                            'Lain-lain' => ['tagihan_lainlain', 'nominal_lainlain'],
                        ];
                    @endphp

                    <div class="col-md-12 mb-3">
                        <label for="nominal_beasiswa" class="form-label">Nominal Beasiswa</label>
                        <input type="number" name="nominal_beasiswa" id="nominal_beasiswa"
                            class="form-control"
                            placeholder="Nominal Beasiswa"
                            min="0"
                            value="{{ old('nominal_beasiswa', $pembayaran->nominal_beasiswa ?? 0) }}">
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
                                        value="{{ old($fields[0], $pembayaran->{$fields[0]} ?? 0) }}"
                                        id="{{ $fields[0] }}">
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="{{ $fields[1] }}"
                                        class="form-control nominal-input"
                                        placeholder="Nominal {{ $type }}"
                                        min="0"
                                        value="{{ old($fields[1], $pembayaran->{$fields[1]} ?? 0) }}"
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
                        <input type="date" name="tgl_bayar" class="form-control"
                            value="{{ old('tgl_bayar', \Carbon\Carbon::parse($pembayaran->tgl_bayar)->format('Y-m-d')) }}">
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
        <a href="{{ route('pembayaran.daftar') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Objek untuk menyimpan nilai lama jika ada kesalahan validasi
        const oldValues = {
            @foreach(old() as $key => $value)
                '{{ $key }}': @json($value),
            @endforeach
        };

        const sppCheckbox = document.getElementById('spp');
        const tagihanSppInput = document.getElementById('tagihan_spp');
        const nominalSppInput = document.getElementById('nominal_spp');
        const nominalBeasiswaInput = document.getElementById('nominal_beasiswa');

        function updateSppNominalPlaceholder() {
            const tagihanSpp = parseFloat(tagihanSppInput.value) || 0;
            const nominalBeasiswa = parseFloat(nominalBeasiswaInput.value) || 0;
            let calculatedSpp = tagihanSpp - nominalBeasiswa;

            calculatedSpp = Math.max(0, calculatedSpp);

            nominalSppInput.placeholder = 'Nominal SPP (: ' + calculatedSpp + ')';
            nominalSppInput.max = calculatedSpp;
        }

        function initializeForm() {
            document.querySelectorAll('.jenis-checkbox').forEach(checkbox => {
                const parent = checkbox.closest('.form-check');
                const nominalInput = parent.querySelector('.nominal-input');
                const tagihanInput = parent.querySelector('.tagihan-input');

                // Cek apakah checkbox seharusnya dicentang
                // Prioritas: old() -> $selectedJenis
                const isChecked = oldValues['jenis_pembayaran']
                    ? oldValues['jenis_pembayaran'].includes(checkbox.value)
                    : '{{ implode(",", $selectedJenis) }}'.includes(checkbox.value);

                if (isChecked) {
                    checkbox.checked = true;
                    nominalInput.disabled = false;
                    nominalInput.required = true;

                    if (checkbox.id === 'spp') {
                        updateSppNominalPlaceholder();
                    } else {
                        nominalInput.max = parseFloat(tagihanInput.value) || '';
                    }
                } else {
                    checkbox.checked = false;
                    nominalInput.disabled = true;
                    nominalInput.required = false;
                    nominalInput.max = '';
                    nominalInput.placeholder = 'Nominal ' + checkbox.labels[0].textContent;
                }
            });
            updateSppNominalPlaceholder();
        }

        initializeForm();

        document.querySelectorAll('.jenis-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const parent = this.closest('.form-check');
                const nominalInput = parent.querySelector('.nominal-input');
                const tagihanInput = parent.querySelector('.tagihan-input');

                if (this.checked) {
                    nominalInput.disabled = false;
                    nominalInput.required = true;
                    if (this.id === 'spp') {
                        updateSppNominalPlaceholder();
                    } else {
                        nominalInput.max = parseFloat(tagihanInput.value) || '';
                        if (!nominalInput.value && tagihanInput.value) {
                            nominalInput.value = tagihanInput.value;
                        }
                    }
                } else {
                    nominalInput.disabled = true;
                    nominalInput.required = false;
                    nominalInput.value = '';
                    nominalInput.max = '';
                    nominalInput.placeholder = 'Nominal ' + checkbox.labels[0].textContent;
                }
            });
        });

        tagihanSppInput.addEventListener('input', updateSppNominalPlaceholder);
        nominalBeasiswaInput.addEventListener('input', updateSppNominalPlaceholder);

        document.querySelectorAll('.nominal-input').forEach(input => {
            if (input.id !== 'nominal_spp') {
                input.addEventListener('input', function() {
                    const tagihanInput = this.closest('.form-check').querySelector('.tagihan-input');
                    const nominalValue = parseFloat(this.value) || 0;
                    const tagihanValue = parseFloat(tagihanInput.value) || 0;

                    if (nominalValue > tagihanValue) {
                        this.value = tagihanValue;
                    }
                });
            }
        });
    });
</script>
@endsection
