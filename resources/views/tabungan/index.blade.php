@extends('layouts1.app')

@section('content')
<div class="container">
    <div class="card" id="tabungan">
        <div class="card-body">
            {{-- Bagian Header --}}
            <div class="text-center mb-4">
                <h4 class="mb-0 fw-bold">RIWAYAT TABUNGAN PESERTA DIDIK</h4>
                <h5 class="mb-0">MA DARUL FALAH</h5>
                <p>TAHUN PELAJARAN {{ $tahunPelajaran->tahun ?? '-' }}</p>
                <hr>
            </div>

            {{-- Informasi Siswa --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td style="width: 35%;">No./NIS</td>
                            <td style="width: 5%;">:</td>
                            <td style="width: 60%;">{{ $siswa->nis ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Nama Peserta Didik</td>
                            <td>:</td>
                            <td>{{ $siswa->nama_siswa }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $siswa->alamat ?? '-'}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td style="width: 35%;">Nama Wali</td>
                            <td style="width: 5%;">:</td>
                            <td style="width: 60%;">{{ $siswa->nama_ayah ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Asal Madrasah</td>
                            <td>:</td>
                            <td>{{ $siswa->asal_sekolah ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>:</td>
                            <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- Total Saldo dipindahkan ke sini, sejajar dengan tombol --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
                        <i class="fas fa-plus"></i> Tambah Setoran
                    </button>
                    <a href="/pembayaran" class="btn btn-secondary me-2">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('tabungan.cetak', $siswa->nis) }}" class="btn btn-success" target="_blank">
                        <i class="fas fa-print"></i> Cetak Laporan
                    </a>
                </div>
                <h5 class="mb-0 me-3">Total Saldo: <span class="fw-bold">Rp {{ number_format($totalSaldo, 0, ',', '.')
                        }}</span></h5>
            </div>


            {{-- Notifikasi --}}
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Tabel Riwayat --}}
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th style="width: 5%;">No.</th>
                            <th style="width: 20%;">Tanggal Setor</th>
                            <th style="width: 20%;">Jumlah Setor</th>
                            <th style="width: 20%;">Saldo Setelah Setor</th>
                            <th style="width: 20%;">Petugas</th>
                            <th style="width: 15%;" class="d-print-none">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $currentSaldo = 0; // Inisialisasi saldo saat ini
                        @endphp
                        @forelse($tabungans as $tabungan)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($tabungan->tgl_setor)->isoFormat('D MMMM YYYY') }}</td>
                            <td class="text-end">Rp {{ number_format($tabungan->jumlah_setor, 0, ',', '.') }}</td>
                            <td class="text-end">
                                @php
                                $currentSaldo += $tabungan->jumlah_setor; // Tambahkan jumlah setor ke saldo saat ini
                                @endphp
                                Rp {{ number_format($currentSaldo, 0, ',', '.') }}
                            </td>
                            <td>{{ $tabungan->petugas }}</td>
                            <td class="text-center d-print-none">
                                <div class="d-flex justify-content-center align-items-center gap-1">
                                    <a href="{{ route('tabungan.cetakKwitansi', [$siswa->nis, $tabungan->id]) }}" class="btn btn-sm btn-info" target="_blank">
                                        <i class="fas fa-receipt"></i> Kwitansi
                                    </a>
                                    <form action="{{ route('tabungan.destroy', [$siswa->nis, $tabungan->id]) }}"
                                        method="POST" onsubmit="return confirm('Yakin ingin menghapus setoran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada transaksi tabungan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Setoran --}}
    <div class="modal fade" id="tambahModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('tabungan.store', $siswa->nis) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Setoran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tgl_setor" class="form-label">Tanggal Setor</label>
                            <input type="date" name="tgl_setor" class="form-control"
                                value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_setor" class="form-label">Jumlah Setor</label>
                            <input type="number" name="jumlah_setor" class="form-control" min="0" required>
                        </div>
                        {{-- Pilihan Petugas --}}
                        <div class="mb-3">
                            <label for="petugas" class="form-label">Petugas Pencatat</label>
                            <select name="petugas" id="petugas" class="form-control @error('petugas') is-invalid @enderror">
                                <option value="">-- Pilih Petugas --</option>
                                <option value="Anis Maimanah" {{ old('petugas') == 'Anis Maimanah' ? 'selected' : '' }}>Anis Maimanah</option>
                                <option value="M. Fahruddin" {{ old('petugas') == 'M. Fahruddin' ? 'selected' : '' }}>M. Fahruddin</option>
                                <option value="Lainnya" {{ old('petugas') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('petugas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- CSS untuk mode cetak --}}
<style>
    @media print {
        body * {
            visibility: hidden;
            font-size: 12px;
        }

        #tabungan,
        #tabungan * {
            visibility: visible;
        }

        #tabungan {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .d-print-none {
            display: none !important;
        }

        /* Perbaikan tampilan tabel saat dicetak */
        table {
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
    }
</style>
@endsection
