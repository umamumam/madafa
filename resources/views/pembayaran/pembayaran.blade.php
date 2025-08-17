@extends('layouts1.app')

@section('content')
<div class="row">
    <!-- Config table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1>Import Data Pembayaran</h1>
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
                            <th>Tanggal Bayar</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Petugas</th>
                            <th>Jenis Pembayaran</th>
                            <th>Jumlah Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembayarans as $key => $pembayaran)
                        @php
                        // Menjumlahkan semua nominal pembayaran
                        $totalNominal = $pembayaran->nominal_beasiswa +
                        $pembayaran->nominal_spp +
                        $pembayaran->nominal_dana_abadi +
                        $pembayaran->nominal_bop_smt1 +
                        $pembayaran->nominal_bop_smt2 +
                        $pembayaran->nominal_buku_lks +
                        $pembayaran->nominal_kitab +
                        $pembayaran->nominal_seragam +
                        $pembayaran->nominal_infaq_madrasah +
                        $pembayaran->nominal_infaq_kalender +
                        $pembayaran->nominal_outing_class +
                        $pembayaran->nominal_lainlain;
                        @endphp
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->format('d-m-Y') }}</td>
                            {{-- Mengakses data siswa melalui relasi --}}
                            <td>{{ $pembayaran->siswa->nis ?? '-' }}</td>
                            <td>{{ $pembayaran->siswa->nama_siswa ?? '-' }}</td>
                            <td>{{ $pembayaran->petugas ?? '-' }}</td>
                            <td>{{ $pembayaran->jenis_pembayaran ?? '-' }}</td>
                            <td>Rp {{ number_format($totalNominal, 0, ',', '.') }}</td>
                            <td>
                                @if($pembayaran->siswa)
                                <a href="{{ route('pembayaran.index', ['siswa_nis' => $pembayaran->siswa->nis]) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-money-bill-wave"></i> Pembayaran
                                </a>
                                <a href="{{ route('tabungan.index', ['siswa_nis' => $pembayaran->siswa->nis]) }}"
                                    class="btn btn-secondary btn-sm">
                                    <i class="fas fa-wallet"></i> Tabungan
                                </a>
                                @else
                                <button class="btn btn-primary btn-sm" disabled title="Data siswa tidak ditemukan">
                                    <i class="fa fa-money-bill-wave"></i> Pembayaran
                                </button>
                                <button class="btn btn-secondary btn-sm" disabled title="Data siswa tidak ditemukan">
                                    <i class="fas fa-wallet"></i> Tabungan
                                </button>
                                @endif
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
