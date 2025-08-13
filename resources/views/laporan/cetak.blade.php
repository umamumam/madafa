<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pembayaran</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 10px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin-bottom: 5px; }
        .header p { margin-top: 0; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 4px; text-align: left; vertical-align: top; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .footer { margin-top: 20px; text-align: right; }
        .total-row { font-weight: bold; }
        .total-cell { font-size: 11px; font-weight: bold; }
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
                <th rowspan="2" class="text-center">No.</th>
                <th rowspan="2" class="text-center">Tgl. Transaksi</th>
                <th rowspan="2" class="text-center">Nama Siswa</th>
                <th rowspan="2" class="text-center">Uraian</th>
                <th colspan="12" class="text-center">Nominal Pembayaran (Rp)</th>
                <th rowspan="2" class="text-center">Total (Rp)</th>
                <th rowspan="2" class="text-center">Status</th>
                <th rowspan="2" class="text-center">Petugas</th>
            </tr>
            <tr>
                <th class="text-center">Beasiswa</th>
                <th class="text-center">SPP</th>
                <th class="text-center">Abadi</th>
                <th class="text-center">BOP1</th>
                <th class="text-center">BOP2</th>
                <th class="text-center">LKS</th>
                <th class="text-center">Kitab</th>
                <th class="text-center">Seragam</th>
                <th class="text-center">Infaq M.</th>
                <th class="text-center">Infaq Kal.</th>
                <th class="text-center">Outing Class</th>
                <th class="text-center">Lain-lain</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembayarans as $key => $p)
                @php
                    $total =
                        $p->nominal_beasiswa +
                        $p->nominal_spp +
                        $p->nominal_dana_abadi +
                        $p->nominal_bop_smt1 +
                        $p->nominal_bop_smt2 +
                        $p->nominal_buku_lks +
                        $p->nominal_kitab +
                        $p->nominal_seragam +
                        $p->nominal_infaq_madrasah +
                        $p->nominal_infaq_kalender +
                        $p->nominal_outing_class +
                        $p->nominal_lainlain;
                @endphp
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tgl_bayar)->format('d/m/Y') }}</td>
                    <td>{{ $p->siswa->nama_siswa ?? '-' }}</td>
                    <td>{{ $p->keterangan }}</td>
                    <td class="text-right">{{ number_format($p->nominal_beasiswa, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($p->nominal_spp, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($p->nominal_dana_abadi, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($p->nominal_bop_smt1, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($p->nominal_bop_smt2, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($p->nominal_buku_lks, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($p->nominal_kitab, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($p->nominal_seragam, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($p->nominal_infaq_madrasah, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($p->nominal_infaq_kalender, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($p->nominal_outing_class, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($p->nominal_lainlain, 0, ',', '.') }}</td>
                    <td class="text-right total-cell">{{ number_format($total, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $p->status }}</td>
                    <td>{{ $p->petugas ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4">TOTAL KESELURUHAN</td>
                <td class="text-right">{{ number_format($pembayarans->sum('nominal_beasiswa'), 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($pembayarans->sum('nominal_spp'), 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($pembayarans->sum('nominal_dana_abadi'), 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($pembayarans->sum('nominal_bop_smt1'), 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($pembayarans->sum('nominal_bop_smt2'), 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($pembayarans->sum('nominal_buku_lks'), 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($pembayarans->sum('nominal_kitab'), 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($pembayarans->sum('nominal_seragam'), 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($pembayarans->sum('nominal_infaq_madrasah'), 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($pembayarans->sum('nominal_infaq_kalender'), 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($pembayarans->sum('nominal_outing_class'), 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($pembayarans->sum('nominal_lainlain'), 0, ',', '.') }}</td>
                <td class="text-right total-cell">{{ number_format($totalAll, 0, ',', '.') }}</td>
                <td colspan="2"></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>
