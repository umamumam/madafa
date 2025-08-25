@extends('layouts1.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1>Data Pembayaran</h1>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importModal">
                    <i class="fas fa-file-excel"></i> Import Excel
                </button>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                    style="width: 100%">
                    <thead style="background-color: #e9f5ff;">
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>SPP</th>
                            <th>Dana Abadi</th>
                            <th>BOP Smt 1</th>
                            <th>BOP Smt 2</th>
                            <th>Buku LKS</th>
                            <th>Kitab</th>
                            <th>Seragam</th>
                            <th>Infaq Madrasah</th>
                            <th>Infaq Kalender</th>
                            <th>Outing Class</th>
                            <th>Lain-lain</th>
                            <th>Jumlah Total</th>
                            {{-- <th>Petugas</th>
                            <th>Tanggal Bayar</th> --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembayarans as $key => $pembayaran)
                        @php
                        // Menjumlahkan semua nominal pembayaran
                        $totalNominal = ($pembayaran->nominal_beasiswa ?? 0) +
                        ($pembayaran->nominal_spp ?? 0) +
                        ($pembayaran->nominal_dana_abadi ?? 0) +
                        ($pembayaran->nominal_bop_smt1 ?? 0) +
                        ($pembayaran->nominal_bop_smt2 ?? 0) +
                        ($pembayaran->nominal_buku_lks ?? 0) +
                        ($pembayaran->nominal_kitab ?? 0) +
                        ($pembayaran->nominal_seragam ?? 0) +
                        ($pembayaran->nominal_infaq_madrasah ?? 0) +
                        ($pembayaran->nominal_infaq_kalender ?? 0) +
                        ($pembayaran->nominal_outing_class ?? 0) +
                        ($pembayaran->nominal_lainlain ?? 0);
                        @endphp
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $pembayaran->siswa->nis ?? '-' }}</td>
                            <td>{{ $pembayaran->siswa->nama_siswa ?? '-' }}</td>
                            <td>{{ $pembayaran->siswa->kelas->nama_kelas ?? '-' }}</td>
                            <td>Rp {{ number_format($pembayaran->nominal_spp ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($pembayaran->nominal_dana_abadi ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($pembayaran->nominal_bop_smt1 ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($pembayaran->nominal_bop_smt2 ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($pembayaran->nominal_buku_lks ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($pembayaran->nominal_kitab ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($pembayaran->nominal_seragam ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($pembayaran->nominal_infaq_madrasah ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($pembayaran->nominal_infaq_kalender ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($pembayaran->nominal_outing_class ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($pembayaran->nominal_lainlain ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($totalNominal, 0, ',', '.') }}</td>
                            {{-- <td>{{ $pembayaran->petugas ?? '-' }}</td>
                            <td style="text-align: center;">
                                @if($pembayaran->tgl_bayar)
                                {{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->format('d-m-Y') }}
                                @else
                                -
                                @endif
                            </td> --}}
                            <td>
                                <a href="{{ route('pembayaran.edit', $pembayaran->id) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-money-bill-wave"></i> Pembayaran
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Data Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('pembayaran.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <p>Silakan unggah file Excel (.xls, .xlsx) yang berisi data pembayaran. Pastikan struktur kolom
                        sesuai dengan contoh template.</p>
                    <a href="{{ asset('pembayaran.xlsx') }}" class="btn btn-info btn-sm mb-3">
                        <i class="fas fa-download"></i> Unduh Template
                    </a>
                    <div class="form-group">
                        <label for="file">Pilih File Excel:</label>
                        <input type="file" name="file" id="file" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session("success") }}',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session("error") }}',
    });
</script>
@endif

@endsection
