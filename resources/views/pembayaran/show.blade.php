@extends('layouts1.app')

@section('content')
<div class="container">
    <div class="card" id="invoice">
        <div class="card-body">
            <div class="text-center mb-4">
                <h4 class="mb-0 fw-bold">DAFTAR RINCIAN PEMBAYARAN PESERTA DIDIK</h4>
                <h5 class="mb-0">MA DARUL FALAH</h5>
                <p>TAHUN PELAJARAN {{ $tahunPelajaran?->tahun ?? '-' }}</p>
                <hr>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td style="width: 35%;">No./NIS</td>
                            <td style="width: 5%;">:</td>
                            <td style="width: 60%;">{{ $pembayaran->siswa->nis ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Nama Peserta Didik</td>
                            <td>:</td>
                            <td>{{ $pembayaran->siswa->nama_siswa }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $pembayaran->siswa->alamat ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Beasiswa</td>
                            <td>:</td>
                            <td>Rp {{ number_format($pembayaran->nominal_beasiswa ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td style="width: 35%;">Nama Wali</td>
                            <td style="width: 5%;">:</td>
                            <td style="width: 60%;">{{ $pembayaran->siswa->nama_ayah ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Asal Madrasah</td>
                            <td>:</td>
                            <td>{{ $pembayaran->siswa->asal_sekolah ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>:</td>
                            <td>{{ $pembayaran->siswa->kelas->nama_kelas ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            @php
            $paymentItemsDefinition = [
                'Syahriyah' => ['tagihan_field' => 'tagihan_spp', 'nominal_field' => 'nominal_spp'],
                'Dana Abadi' => ['tagihan_field' => 'tagihan_dana_abadi', 'nominal_field' => 'nominal_dana_abadi'],
                'BOP Smt.1' => ['tagihan_field' => 'tagihan_bop_smt1', 'nominal_field' => 'nominal_bop_smt1'],
                'BOP Smt.2' => ['tagihan_field' => 'tagihan_bop_smt2', 'nominal_field' => 'nominal_bop_smt2'],
                'Buku Paket & LKS' => ['tagihan_field' => 'tagihan_buku_lks', 'nominal_field' => 'nominal_buku_lks'],
                'Kitab' => ['tagihan_field' => 'tagihan_kitab', 'nominal_field' => 'nominal_kitab'],
                'Seragam' => ['tagihan_field' => 'tagihan_seragam', 'nominal_field' => 'nominal_seragam'],
                'Infaq Madrasah' => ['tagihan_field' => 'tagihan_infaq_madrasah', 'nominal_field' => 'nominal_infaq_madrasah'],
                'Infaq Kalender' => ['tagihan_field' => 'tagihan_infaq_kalender', 'nominal_field' => 'nominal_infaq_kalender'],
                'Outing Class' => ['tagihan_field' => 'tagihan_outing_class', 'nominal_field' => 'nominal_outing_class'],
                'Kolektif' => ['tagihan_field' => 'tagihan_lainlain', 'nominal_field' => 'nominal_lainlain'],
            ];

            $displayItems = [];
            $totalTagihanKeseluruhan = 0;
            $totalTerbayarKeseluruhan = 0;

            $nominalBeasiswa = $pembayaran->nominal_beasiswa ?? 0;

            foreach ($paymentItemsDefinition as $label => $fields) {
                $originalTagihan = $pembayaran->{$fields['tagihan_field']} ?? 0;
                $nominalDibayar = $pembayaran->{$fields['nominal_field']} ?? 0;

                $currentSisa = $originalTagihan - $nominalDibayar;

                if ($label === 'Syahriyah') {
                    $effectiveTagihanSpp = max(0, $originalTagihan - $nominalBeasiswa);
                    $currentSisa = $effectiveTagihanSpp - $nominalDibayar;

                    if ($originalTagihan > 0 || $nominalDibayar > 0 || $nominalBeasiswa > 0) {
                        $displayItems[] = [
                            'label' => $label,
                            'tagihan' => $originalTagihan,
                            'terbayar' => $nominalDibayar,
                            'sisa' => $currentSisa,
                        ];
                        $totalTagihanKeseluruhan += $effectiveTagihanSpp;
                        $totalTerbayarKeseluruhan += $nominalDibayar;
                    }
                } else {
                    if ($originalTagihan > 0 || $nominalDibayar > 0) {
                        $displayItems[] = [
                            'label' => $label,
                            'tagihan' => $originalTagihan,
                            'terbayar' => $nominalDibayar,
                            'sisa' => $currentSisa,
                        ];
                        $totalTagihanKeseluruhan += $originalTagihan;
                        $totalTerbayarKeseluruhan += $nominalDibayar;
                    }
                }
            }

            $totalSisaKeseluruhan = $totalTagihanKeseluruhan - $totalTerbayarKeseluruhan;
            @endphp

            <h5 class="mb-3">Rincian</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-primary text-center">
                        <tr>
                            <th style="width: 5%;">No.</th>
                            <th style="width: 25%;">Jenis Pembiayaan</th>
                            <th style="width: 20%;">Biaya Setahun</th>
                            <th style="width: 20%;">Biaya Terbayar</th>
                            <th style="width: 15%;">Sisa Biaya</th>
                            <th style="width: 15%;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($displayItems as $index => $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item['label'] }}</td>
                            <td class="text-end">Rp {{ number_format($item['tagihan'], 0, ',', '.') }}</td>
                            <td class="text-end">Rp {{ number_format($item['terbayar'], 0, ',', '.') }}</td>
                            <td class="text-end
                                @if($item['sisa'] > 0) text-danger
                                @elseif($item['sisa'] < 0) text-success
                                @endif">
                                @if($item['sisa'] > 0)
                                    - Rp {{ number_format($item['sisa'], 0, ',', '.') }}
                                @elseif($item['sisa'] < 0)
                                    Rp {{ number_format(abs($item['sisa']), 0, ',', '.') }}
                                @else
                                    Rp {{ number_format($item['sisa'], 0, ',', '.') }}
                                @endif
                            </td>
                            <td class="text-center">
                                @if($item['sisa'] <= 0) <span class="badge bg-success">LUNAS</span>
                                @else
                                <span class="badge bg-danger">BELUM LUNAS</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data pembayaran pada transaksi ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="fw-bold">
                            <td colspan="2" class="text-center">Jumlah Total</td>
                            <td class="text-end">Rp {{ number_format($totalTagihanKeseluruhan, 0, ',', '.') }}</td>
                            <td class="text-end">Rp {{ number_format($totalTerbayarKeseluruhan, 0, ',', '.') }}</td>
                            <td class="text-end
                                @if($totalSisaKeseluruhan > 0) text-danger
                                @elseif($totalSisaKeseluruhan < 0) text-success
                                @endif">
                                @if($totalSisaKeseluruhan > 0)
                                    - Rp {{ number_format($totalSisaKeseluruhan, 0, ',', '.') }}
                                @elseif($totalSisaKeseluruhan < 0)
                                    Rp {{ number_format(abs($totalSisaKeseluruhan), 0, ',', '.') }}
                                @else
                                    Rp {{ number_format($totalSisaKeseluruhan, 0, ',', '.') }}
                                @endif
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            @if($pembayaran->keterangan)
            <div class="mt-3">
                <strong>Keterangan Tambahan:</strong>
                <p class="mb-0">{{ $pembayaran->keterangan }}</p>
            </div>
            @endif

            <div class="row mt-5">
                <div class="col-md-8"></div>
                <div class="col-md-4 text-center">
                    <p class="mb-0">Sirahan, {{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->isoFormat('D MMMM YYYY')
                        }}</p>
                    <p>Petugas,</p>
                    <br><br><br>
                    <p class="fw-bold mb-0"><u>{{ $pembayaran->petugas ?? 'N/A' }}</u></p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 d-print-none">
        <a href="{{ route('pembayaran.cetakRincian', [$pembayaran->siswa_nis, $pembayaran->id]) }}" class="btn btn-success" target="_blank">
            <i class="fas fa-print"></i> Cetak PDF
        </a>
        <a href="{{ route('pembayaran.index', $pembayaran->siswa_nis) }}" class="btn btn-secondary"> <i
                class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

@endsection
