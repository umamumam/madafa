<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pembayaran</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin-bottom: 5px; }
        .header p { margin-top: 0; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .footer { margin-top: 20px; text-align: right; }
        .total-row { font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN PEMBAYARAN MA DARUL FALAH</h2>
        <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Tgl. Transaksi</th>
                <th>Nama Siswa</th>
                <th>Uraian</th>
                <th>SPP (Rp)</th>
                <th>Abadi</th>
                <th>BOP1</th>
                <th>BOP2</th>
                <th>LKS</th>
                <th>Kitab</th>
                <th>Seragam</th>
                <th>Infaq M.</th>
                <th>Infaq Kal.</th>
                <th>Lain-lain</th>
                <th>Total</th>
                <th>Status</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembayarans as $key => $p)
                @php
                    $total =
                        $p->nominal_spp + $p->nominal_dana_abadi + $p->nominal_bop_smt1 + $p->nominal_bop_smt2 +
                        $p->nominal_buku_lks + $p->nominal_kitab + $p->nominal_seragam +
                        $p->nominal_infaq_madrasah + $p->nominal_infaq_kelender + $p->nominal_lainlain;
                @endphp
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tgl_bayar)->format('d/m/Y') }}</td>
                    <td>{{ $p->siswa->nama_siswa ?? '-' }}</td>
                    <td>{{ $p->keterangan }}</td>
                    <td class="text-right">{{ number_format($p->nominal_spp, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($p->nominal_dana_abadi, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($p->nominal_bop_smt1, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($p->nominal_bop_smt2, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($p->nominal_buku_lks, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($p->nominal_kitab, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($p->nominal_seragam, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($p->nominal_infaq_madrasah, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($p->nominal_infaq_kelender, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($p->nominal_lainlain, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($total, 0, ',', '.') }}</td>
                    <td class="text-center">{{ ucfirst($p->status) }}</td>
                    <td>{{ $p->guru->nama ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4">TOTAL</td>
                <td class="text-right">{{ number_format($totals['spp'], 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($totals['dana_abadi'], 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($totals['bop_smt1'], 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($totals['bop_smt2'], 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($totals['buku_lks'], 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($totals['kitab'], 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($totals['seragam'], 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($totals['infaq_madrasah'], 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($totals['infaq_kelender'], 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($totals['lainlain'], 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($totalAll, 0, ',', '.') }}</td>
                <td colspan="2"></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>
