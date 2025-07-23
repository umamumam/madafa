@extends('layouts1.app')

@section('content')
<style>
    th {
        text-align: center;
    }
</style>
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Riwayat Pembayaran - {{ $siswa->nama_siswa }}</h4>
                <div>
                    <a href="{{ route('siswas.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <a href="{{ route('pembayaran.create', $siswa->id) }}" class="btn btn-success btn-sm ms-2">
                        <i class="fas fa-plus me-1"></i> Tambah Pembayaran
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="12%">Tanggal</th>
                            <th width="15%">Jenis Pembayaran</th>
                            <th width="20%">Detail Nominal</th>
                            <th width="12%">Total</th>
                            <th width="10%">Status</th>
                            <th width="15%">Petugas</th>
                            <th width="11%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa->pembayarans as $index => $pembayaran)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->translatedFormat('d F Y') }}</td>
                            <td>
                                @foreach(explode(',', $pembayaran->jenis_pembayaran) as $jenis)
                                <span class="badge bg-primary me-1 mb-1">{{ $jenis }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if($pembayaran->nominal_spp)
                                <span class="d-block">SPP: Rp {{ number_format($pembayaran->nominal_spp, 0, ',', '.')
                                    }}</span>
                                @endif

                                @if($pembayaran->nominal_dana_abadi)
                                <span class="d-block">Dana Abadi: Rp {{ number_format($pembayaran->nominal_dana_abadi,
                                    0, ',', '.') }}</span>
                                @endif

                                @if($pembayaran->nominal_bop_smt1)
                                <span class="d-block">BOP Semester 1: Rp {{ number_format($pembayaran->nominal_bop_smt1,
                                    0, ',', '.') }}</span>
                                @endif

                                @if($pembayaran->nominal_bop_smt2)
                                <span class="d-block">BOP Semester 2: Rp {{ number_format($pembayaran->nominal_bop_smt2,
                                    0, ',', '.') }}</span>
                                @endif

                                @if($pembayaran->nominal_buku_lks)
                                <span class="d-block">Buku LKS: Rp {{ number_format($pembayaran->nominal_buku_lks, 0,
                                    ',', '.') }}</span>
                                @endif

                                @if($pembayaran->nominal_kitab)
                                <span class="d-block">Kitab: Rp {{ number_format($pembayaran->nominal_kitab, 0, ',',
                                    '.') }}</span>
                                @endif

                                @if($pembayaran->nominal_seragam)
                                <span class="d-block">Seragam: Rp {{ number_format($pembayaran->nominal_seragam, 0, ',',
                                    '.') }}</span>
                                @endif

                                @if($pembayaran->nominal_infaq_madrasah)
                                <span class="d-block">Infaq Madrasah: Rp {{
                                    number_format($pembayaran->nominal_infaq_madrasah, 0, ',', '.') }}</span>
                                @endif

                                @if($pembayaran->nominal_infaq_kelender)
                                <span class="d-block">Infaq Kalender: Rp {{
                                    number_format($pembayaran->nominal_infaq_kelender, 0, ',', '.') }}</span>
                                @endif

                                @if($pembayaran->nominal_lainlain)
                                <span class="d-block">Lain-lain: Rp {{ number_format($pembayaran->nominal_lainlain, 0,
                                    ',', '.') }}</span>
                                @endif

                                @if($pembayaran->nominal_kolektif)
                                <span class="d-block">Kolektif: Rp {{ number_format($pembayaran->nominal_kolektif, 0,
                                    ',', '.') }}</span>
                                @endif
                            </td>
                            <td class="text-end fw-bold">Rp {{ number_format($pembayaran->total, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <span class="badge bg-{{ $pembayaran->status == 'Cash' ? 'success' : 'warning' }}">
                                    {{ $pembayaran->status }}
                                </span>
                            </td>
                            <td>{{ $pembayaran->petugas->nama ?? $pembayaran->guru->nama_guru ?? '-' }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('pembayaran.edit', [$siswa->id, $pembayaran->id]) }}"
                                        class="btn btn-sm btn-warning px-2 py-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('pembayaran.kuitansi', [$siswa->id, $pembayaran->id]) }}"
                                        target="_blank" class="btn btn-sm btn-info px-2 py-1" title="Kuitansi">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                    <form action="{{ route('pembayaran.destroy', [$siswa->id, $pembayaran->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger px-2 py-1"
                                            onclick="return confirm('Hapus data pembayaran?')" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
