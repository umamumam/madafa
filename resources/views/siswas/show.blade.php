@extends('layouts2.landing')

@section('content')
    <h1>Detail Siswa</h1>
    <div class="mb-3">
        <label for="jenis_export">Silahkan di Download</label>
        <select id="jenis_export" class="form-select">
            <option value="">-- Asal Sekolah --</option>
            <option value="mts">MTS Darul Falah</option>
            <option value="baru">Peserta Didik Baru</option>
        </select>
    </div>

    <a href="#" id="exportPdfBtn" class="btn btn-danger mb-3" target="_blank">Export PDF</a>


    <div class="container mt-4">
        <h4 class="text-center mb-4">FORMULIR PESERTA DIDIK BARU</h4>

        {{-- Card Identitas Siswa --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <strong>Identitas Siswa</strong>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <td width="2%">1.</td>
                        <td width="15%">No Pendaftaran</td>
                        <td width="2%">:</td>
                        <td>{{ $siswa->no_pendaftaran ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Nama Siswa</td>
                        <td>:</td>
                        <td>{{ $siswa->nama_siswa }}</td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>NISN</td>
                        <td>:</td>
                        <td>{{ $siswa->nis }}</td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{ $siswa->jeniskelamin->jeniskelamin ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>Tempat & Tgl. Lahir</td>
                        <td>:</td>
                        <td>{{ $siswa->tempat_lahir }}, {{ $siswa->tgl_lahir }}</td>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <td>Nama Ayah</td>
                        <td>:</td>
                        <td>{{ $siswa->nama_ayah }}</td>
                    </tr>
                    <tr>
                        <td>7.</td>
                        <td>Nama Ibu</td>
                        <td>:</td>
                        <td>{{ $siswa->nama_ibu }}</td>
                    </tr>
                    <tr>
                        <td>8.</td>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $siswa->alamat }}</td>
                    </tr>
                    <tr>
                        <td>9.</td>
                        <td>Telp./HP Peserta</td>
                        <td>:</td>
                        <td>{{ $siswa->hp_siswa }}</td>
                    </tr>
                    <tr>
                        <td>10.</td>
                        <td>Telp./HP Orang Tua</td>
                        <td>:</td>
                        <td>{{ $siswa->hp_ortu }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Tabel Kelengkapan Berkas --}}
        <h5 class="mb-3">KELENGKAPAN BERKAS DAN PERSYARATAN</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%" style="text-align: center;">No</th>
                    <th>Jenis Berkas</th>
                    <th width="8%" style="text-align: center;">Cek List</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">1</td>
                    <td>Kartu NISN / surat keterangan dari Madrasah/Sekolah Asal</td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">2</td>
                    <td>FC Syahadah dari MTs Darul Falah</td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">2</td>
                    <td>Fotocopy Ijazah dan SKHUN dilegalisir 2 lembar</td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">3</td>
                    <td>Fotocopy Nilai Raport Kelas 7,8 & 9 MTs/SMP dilegalisir 2 lembar</td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">4</td>
                    <td>Pas Foto 3 x 4 sebanyak 2 lembar</td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">5</td>
                    <td>Fotocopy Akte Kelahiran 2 lembar</td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">6</td>
                    <td>Foto copy Kartu Keluarga (KK) 2 Lembar</td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">7</td>
                    <td>Foto copy KTP Orang Tua/Wali 2 lembar</td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">8</td>
                    <td>Foto copy Kartu Jaminan Sosial (KIP/KIS/PKH/KKS) 2 lembar</td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">9</td>
                    <td>Uang Infaq Madrasah Rp. 800.000 / Terbayar Rp
                        <input type="text" class="form-control form-control-sm d-inline-block" style="width: 100px;">
                    </td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">10</td>
                    <td>Lain-Lain …</td>
                    <td style="text-align: center;"><input type="checkbox"></td>
                </tr>
            </tbody>
        </table>

        {{-- Tanda Tangan --}}
        <div class="row mt-5 text-center">
            <div class="col-md-4">
                <p>Sirahan, ..................</p>
                <p>Petugas</p>
                <br><br>
                <p>(........................)</p>
            </div>
            <div class="col-md-4">
                <p>&nbsp;</p>
                <p>Orang Tua / Wali</p>
                <br><br>
                <p>(........................)</p>
            </div>
            <div class="col-md-4">
                <p>&nbsp;</p>
                <p>Peserta Didik Baru</p>
                <br><br>
                <p>(........................)</p>
            </div>
        </div>

        {{-- Foto Siswa --}}
        {{-- @if($siswa->foto)
            <p class="mt-4"><strong>Foto:</strong></p>
            <img src="{{ asset('storage/' . $siswa->foto) }}" alt="Foto Siswa" width="150">
        @endif --}}

        <br>
        {{-- <a href="{{ route('siswas.index') }}">← Kembali ke Daftar</a> --}}
    </div>
    <script>
        document.getElementById('jenis_export').addEventListener('change', function () {
            let jenis = this.value;
            let siswaId = {{ $siswa->id }};
            let exportBtn = document.getElementById('exportPdfBtn');

            if (jenis === 'mts') {
                exportBtn.href = '/siswas/' + siswaId + '/export-pdf?jenis=mts';
            } else if (jenis === 'baru') {
                exportBtn.href = '/siswas/' + siswaId + '/export-pdf?jenis=baru';
            } else {
                exportBtn.href = '#';
            }
        });
    </script>

@endsection
