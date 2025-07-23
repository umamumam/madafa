@extends('layouts1.app')

@section('content')
<div class="container">
    <h2>Laporan Pembayaran</h2>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Filter Laporan</h4>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('laporan.pembayaran') }}">
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control" value="{{ $startDate }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Akhir</label>
                        <input type="date" name="end_date" class="form-control" value="{{ $endDate }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="all" {{ $status=='all' ? 'selected' : '' }}>Semua Status</option>
                            <option value="Lunas" {{ $status=='Lunas' ? 'selected' : '' }}>Lunas</option>
                            <option value="Belum Lunas" {{ $status=='Belum Lunas' ? 'selected' : '' }}>Belum Lunas
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Siswa (Opsional)</label>
                        <select name="siswa_id" class="form-control">
                            <option value="">Semua Siswa</option>
                            @foreach($siswas as $siswa)
                            <option value="{{ $siswa->id }}" {{ $siswaId==$siswa->id ? 'selected' : '' }}>
                                {{ $siswa->nama_siswa }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('laporan.pembayaran.cetak', request()->query()) }}" class="btn btn-success"
                            target="_blank">
                            <i class="fas fa-file-pdf"></i> Cetak PDF
                        </a>
                        <a href="{{ route('pembayaran.export.excel', request()->query()) }}" class="btn btn-warning">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if($pembayarans->count())
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Tgl. Transaksi</th>
                            <th>Nama Siswa</th>
                            <th>Keterangan</th>
                            <th>SPP</th>
                            <th>Dana Abadi</th>
                            <th>BOP SMT1</th>
                            <th>BOP SMT2</th>
                            <th>Buku LKS</th>
                            <th>Kitab</th>
                            <th>Seragam</th>
                            <th>Infaq Madrasah</th>
                            <th>Infaq Kalender</th>
                            <th>Lain-lain</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembayarans as $index => $pembayaran)
                        @php
                        $total = $pembayaran->nominal_spp +
                        $pembayaran->nominal_dana_abadi +
                        $pembayaran->nominal_bop_smt1 +
                        $pembayaran->nominal_bop_smt2 +
                        $pembayaran->nominal_buku_lks +
                        $pembayaran->nominal_kitab +
                        $pembayaran->nominal_seragam +
                        $pembayaran->nominal_infaq_madrasah +
                        $pembayaran->nominal_infaq_kelender +
                        $pembayaran->nominal_lainlain;
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->format('d/m/Y') }}</td>
                            <td>{{ $pembayaran->siswa->nama_siswa }}</td>
                            <td>{{ $pembayaran->keterangan }}</td>
                            <td class="text-end">{{ number_format($pembayaran->nominal_spp, 0, ',', '.') }}</td>
                            <td class="text-end">{{ number_format($pembayaran->nominal_dana_abadi, 0, ',', '.') }}</td>
                            <td class="text-end">{{ number_format($pembayaran->nominal_bop_smt1, 0, ',', '.') }}</td>
                            <td class="text-end">{{ number_format($pembayaran->nominal_bop_smt2, 0, ',', '.') }}</td>
                            <td class="text-end">{{ number_format($pembayaran->nominal_buku_lks, 0, ',', '.') }}</td>
                            <td class="text-end">{{ number_format($pembayaran->nominal_kitab, 0, ',', '.') }}</td>
                            <td class="text-end">{{ number_format($pembayaran->nominal_seragam, 0, ',', '.') }}</td>
                            <td class="text-end">{{ number_format($pembayaran->nominal_infaq_madrasah, 0, ',', '.') }}
                            </td>
                            <td class="text-end">{{ number_format($pembayaran->nominal_infaq_kelender, 0, ',', '.') }}
                            </td>
                            <td class="text-end">{{ number_format($pembayaran->nominal_lainlain, 0, ',', '.') }}</td>
                            <td class="text-end fw-bold">{{ number_format($total, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-{{ $pembayaran->status == 'Lunas' ? 'success' : 'warning' }}">
                                    {{ $pembayaran->status }}
                                </span>
                            </td>
                            <td>{{ $pembayaran->guru->nama_guru ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-primary">
                        <tr>
                            <th colspan="4">TOTAL</th>
                            <th class="text-end">{{ number_format($pembayarans->sum('nominal_spp'), 0, ',', '.') }}</th>
                            <th class="text-end">{{ number_format($pembayarans->sum('nominal_dana_abadi'), 0, ',', '.')
                                }}</th>
                            <th class="text-end">{{ number_format($pembayarans->sum('nominal_bop_smt1'), 0, ',', '.') }}
                            </th>
                            <th class="text-end">{{ number_format($pembayarans->sum('nominal_bop_smt2'), 0, ',', '.') }}
                            </th>
                            <th class="text-end">{{ number_format($pembayarans->sum('nominal_buku_lks'), 0, ',', '.') }}
                            </th>
                            <th class="text-end">{{ number_format($pembayarans->sum('nominal_kitab'), 0, ',', '.') }}
                            </th>
                            <th class="text-end">{{ number_format($pembayarans->sum('nominal_seragam'), 0, ',', '.') }}
                            </th>
                            <th class="text-end">{{ number_format($pembayarans->sum('nominal_infaq_madrasah'), 0, ',',
                                '.') }}</th>
                            <th class="text-end">{{ number_format($pembayarans->sum('nominal_infaq_kelender'), 0, ',',
                                '.') }}</th>
                            <th class="text-end">{{ number_format($pembayarans->sum('nominal_lainlain'), 0, ',', '.') }}
                            </th>
                            <th class="text-end fw-bold">{{ number_format($totalAll, 0, ',', '.') }}</th>
                            <th colspan="2"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-info">
        Tidak ada data pembayaran untuk periode ini.
    </div>
    @endif
</div>
@endsection
