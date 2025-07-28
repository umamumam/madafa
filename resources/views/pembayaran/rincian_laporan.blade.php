<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rincian Pembayaran</title>
    <style>
        @page {
            margin: 0 0.5cm;
        }
        body {
            font-family: 'Arial', sans-serif;
            font-size: 10pt;
            margin: 0;
            padding: 10px; /* Memberi sedikit padding pada body */
        }
        .container {
            width: 100%;
            margin: auto;
        }
        .text-center {
            text-align: center;
        }
        .mb-4 {
            margin-bottom: 1rem;
        }
        .mb-3 {
            margin-bottom: 1rem;
        }
        .mb-0 {
            margin-bottom: 0 !important;
        }
        .fw-bold {
            font-weight: bold;
        }
        hr {
            border: 0;
            border-top: 1px solid #000; /* Garis hitam sederhana */
            margin-top: 1rem;
            margin-bottom: 1rem;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #000;
            border-collapse: collapse; /* Menghilangkan spasi antar sel */
        }
        .table th, .table td {
            padding: 0.5rem;
            vertical-align: top;
            border: 1px solid #000; /* Border tipis untuk tabel */
        }
        .table-borderless th, .table-borderless td {
            border: 0; /* Untuk tabel informasi siswa */
        }
        .table-sm th, .table-sm td {
            padding: 0.1rem;
        }
        .table-header {
            background-color: #f0f0f0; /* Warna latar belakang header tabel yang lebih netral */
            font-weight: bold;
        }
        .text-end {
            text-align: right;
        }
        .text-danger {
            color: #dc3545;
        }
        .text-success {
            color: #198754;
        }
        .badge {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }
        .bg-success {
            background-color: #198754 !important;
        }
        .bg-danger {
            background-color: #dc3545 !important;
        }
        .mt-3 {
            margin-top: 1rem;
        }
        .mt-5 {
            margin-top: 3rem;
        }
        /* Penyesuaian untuk layout 50%-50% di bagian info siswa */
        .row::after {
            content: "";
            clear: both;
            display: table;
        }
        .col-md-6 {
            float: left;
            width: 50%;
        }
        .info-siswa table td {
            padding-top: 2px; /* Sesuaikan padding agar lebih rapat */
            padding-bottom: 2px; /* Sesuaikan padding agar lebih rapat */
        }
        /* Penyesuaian lebar kolom di dalam tabel info siswa */
        .info-siswa table tr td:first-child {
            width: 35%; /* Lebar kolom label */
        }
        .info-siswa table tr td:nth-child(2) {
            width: 5%; /* Lebar kolom titik dua */
        }
        .info-siswa table tr td:last-child {
            width: 60%; /* Lebar kolom nilai */
        }

        /* Gaya baru untuk tabel tanda tangan 33% */
        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 3rem;
        }
        .signature-table td {
            width: 33.33%;
            text-align: center;
            vertical-align: top;
            padding: 0; /* Hapus padding default tabel jika ada */
        }
        .signature-table p {
            margin-bottom: 0;
        }
        .signature-table .name-line {
            padding-top: 50px; /* Menambah jarak untuk tanda tangan */
            position: relative;
        }
        .signature-table .name-line u {
            display: block;
            margin-top: 10px; /* Menambah jarak antara "Petugas," dan nama */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center mb-4">
            <h4 class="mb-0 fw-bold">DAFTAR RINCIAN PEMBAYARAN PESERTA DIDIK</h4>
            <h5 class="mb-0">MA DARUL FALAH</h5>
            <p>TAHUN PELAJARAN {{ $tahunPelajaran?->tahun ?? '-' }}</p>
            <hr>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <table class="table table-borderless table-sm info-siswa">
                    <tr>
                        <td>No./NIS</td>
                        <td>:</td>
                        <td>{{ $pembayaran->siswa->nis ?? '-' }}</td>
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
                <table class="table table-borderless table-sm info-siswa">
                    <tr>
                        <td>Nama Wali</td>
                        <td>:</td>
                        <td>{{ $pembayaran->siswa->nama_ayah ?? '-' }}</td>
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
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                </table>
            </div>
        </div>

        <h5 class="mb-3">Rincian</h5>
        <div class="table-responsive">
            <table class="table">
                <thead class="table-header text-center">
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

        <table class="signature-table">
            <tr>
                <td>&nbsp;</td> <td>&nbsp;</td> <td>
                    <p class="mb-0">Sirahan, {{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->isoFormat('D MMMM YYYY') }}</p>
                    <p>Petugas,</p>
                    <p class="fw-bold name-line"><u>{{ $pembayaran->guru->nama_guru ?? 'N/A' }}</u></p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
