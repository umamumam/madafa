<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Tanggal Bayar</th>
            <th>Status</th>
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
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach ($pembayarans as $item)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $item->siswa->nama ?? '-' }}</td>
            <td>{{ $item->tgl_bayar }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->nominal_spp }}</td>
            <td>{{ $item->nominal_dana_abadi }}</td>
            <td>{{ $item->nominal_bop_smt1 }}</td>
            <td>{{ $item->nominal_bop_smt2 }}</td>
            <td>{{ $item->nominal_buku_lks }}</td>
            <td>{{ $item->nominal_kitab }}</td>
            <td>{{ $item->nominal_seragam }}</td>
            <td>{{ $item->nominal_infaq_madrasah }}</td>
            <td>{{ $item->nominal_infaq_kelender }}</td>
            <td>{{ $item->nominal_lainlain }}</td>
            <td>
                {{
                    $item->nominal_spp + $item->nominal_dana_abadi + $item->nominal_bop_smt1 +
                    $item->nominal_bop_smt2 + $item->nominal_buku_lks + $item->nominal_kitab +
                    $item->nominal_seragam + $item->nominal_infaq_madrasah +
                    $item->nominal_infaq_kelender + $item->nominal_lainlain
                }}
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4"><strong>Total Keseluruhan</strong></td>
            <td><strong>{{ $totals['spp'] }}</strong></td>
            <td><strong>{{ $totals['dana_abadi'] }}</strong></td>
            <td><strong>{{ $totals['bop_smt1'] }}</strong></td>
            <td><strong>{{ $totals['bop_smt2'] }}</strong></td>
            <td><strong>{{ $totals['buku_lks'] }}</strong></td>
            <td><strong>{{ $totals['kitab'] }}</strong></td>
            <td><strong>{{ $totals['seragam'] }}</strong></td>
            <td><strong>{{ $totals['infaq_madrasah'] }}</strong></td>
            <td><strong>{{ $totals['infaq_kelender'] }}</strong></td>
            <td><strong>{{ $totals['lainlain'] }}</strong></td>
            <td><strong>{{ $totalAll }}</strong></td>
        </tr>
    </tbody>
</table>
