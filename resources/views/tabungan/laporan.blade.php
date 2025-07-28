<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Tabungan Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h3, .header h4 {
            margin: 5px 0;
        }
        .info-siswa-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 15px;
        }
        .info-siswa-column table {
            width: 100%;
        }
        .info-siswa-column table td {
            padding: 2px 0; /* Padding lebih kecil */
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 5px;
        }
        .table th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .table td {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .fw-bold {
            font-weight: bold;
        }
        .total-saldo-section {
            text-align: right;
            margin-top: 10px;
            margin-bottom: 20px;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            width: 100%;
        }
        .footer .signature {
            width: 250px;
            margin-left: auto;
            text-align: center;
        }
        .footer .signature p {
            margin: 0;
        }
        .footer .signature .line {
            border-top: 1px solid #000;
            margin-top: 60px; /* Jarak untuk tanda tangan */
            padding-top: 5px;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3 class="mb-0 fw-bold">RIWAYAT TABUNGAN PESERTA DIDIK</h3>
        <h4 class="mb-0">MA DARUL FALAH</h4>
        <p>TAHUN PELAJARAN {{ $tahunPelajaran->tahun ?? '-' }}</p>
        <hr>
    </div>

    <div class="info-siswa-grid">
        <div class="info-siswa-column">
            <table>
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
        <div class="info-siswa-column">
            <table>
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
                    <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th style="width: 5%;">No.</th>
                <th style="width: 25%;">Tanggal Setor</th>
                <th style="width: 25%;">Jumlah Setor</th>
                <th style="width: 25%;">Saldo Setelah Setor</th>
            </tr>
        </thead>
        <tbody>
            @php
                $currentSaldo = 0;
            @endphp
            @forelse($tabungans as $tabungan)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($tabungan->tgl_setor)->isoFormat('D MMMM YYYY') }}</td>
                <td class="text-right">Rp {{ number_format($tabungan->jumlah_setor, 0, ',', '.') }}</td>
                <td class="text-right">
                    @php
                        $currentSaldo += $tabungan->jumlah_setor;
                    @endphp
                    Rp {{ number_format($currentSaldo, 0, ',', '.') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada transaksi tabungan.</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-center fw-bold">TOTAL SALDO AKHIR</td>
                <td class="text-right fw-bold">Rp {{ number_format($totalSaldo, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="total-saldo-section">
    </div>

    <div class="footer">
        <div class="signature">
            <p>Sirahan, {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}</p>
            <p>Petugas,</p>
            <p class="line"></p>
            <p>(___________________)</p>
        </div>
    </div>
</body>
</html>
