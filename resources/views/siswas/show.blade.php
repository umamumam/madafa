@extends('layouts1.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-user-graduate me-2"></i>Detail Siswa
                    </h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('siswas.index') }}"
                            class="btn btn-light btn-sm d-flex align-items-center">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <a href="{{ route('siswas.edit', $siswa->id) }}"
                            class="btn btn-warning btn-sm d-flex align-items-center">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <a href="{{ route('profil.identitassiswa.pdf') }}"
                            class="btn btn-danger btn-sm d-flex align-items-center" target="_blank">
                            <i class="fas fa-print me-1"></i> Cetak
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Student Photo Section -->
                    <div class="col-md-3 text-center">
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-body">
                                @if ($siswa->foto)
                                <img src="{{ asset('storage/' . str_replace('public/', '', $siswa->foto)) }}"
                                    alt="Foto Siswa"
                                    class="img-fluid rounded-circle mb-3 border border-3 border-primary"
                                    style="width: 180px; height: 180px; object-fit: cover;">
                                @else
                                <img src="{{ asset('madafa.webp') }}" alt="Foto Default"
                                    class="img-fluid rounded-circle mb-3 border border-3 border-primary"
                                    style="width: 180px; height: 180px; object-fit: cover;">
                                @endif
                                <h4 class="mb-1">{{ $siswa->nama_siswa }}</h4>
                                <div class="d-flex justify-content-center align-items-center gap-2 mb-2">
                                    <span class="badge bg-primary">
                                        {{ $siswa->kelas->nama_kelas ?? '-' }}
                                    </span>
                                    <span class="badge bg-info text-dark">
                                        {{ $siswa->program->program ?? '-' }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-center gap-2">
                                    <span class="text-muted">
                                        <b>NIS:</b> {{ $siswa->nis ?? 'N/A' }}
                                    </span>
                                    <span class="text-muted">
                                        <b>NISN:</b> {{ $siswa->nisn ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Info Card -->
                        <div class="card border-0 shadow-sm mb-4">
                            {{-- <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Singkat</h6>
                            </div> --}}
                            <div class="card-body">
                                <ul class="list-unstyled mb-0" style="text-align: left;">
                                    <li class="mb-2">
                                        <i class="fas fa-venus-mars text-primary me-2"></i>
                                        <strong>JK:</strong> {{ $siswa->jeniskelamin->jeniskelamin ?? '-' }}
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-birthday-cake text-primary me-2"></i>
                                        <strong>TTL:</strong>
                                        {{ $siswa->tempat_lahir ?? '-' }},
                                        {{ $siswa->tgl_lahir ? \Carbon\Carbon::parse($siswa->tgl_lahir)->format('d/m/Y')
                                        : '-' }}
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-phone text-primary me-2"></i>
                                        <strong>HP:</strong> {{ $siswa->hp_siswa ?? '-' }}
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    <!-- Student Details Section -->
                    <div class="col-md-9">
                        <div class="row">
                            <!-- Personal Data -->
                            <div class="col-md-6">
                                <div class="card mb-4 border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">
                                            <i class="fas fa-user-circle me-2 text-primary"></i>Data Siswa
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td width="40%" class="text-muted">Nama Siswa</td>
                                                        <td>
                                                            <span class="badge bg-light text-dark">
                                                                {{ $siswa->nama_siswa ?? '-' }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="40%" class="text-muted">NIK Siswa</td>
                                                        <td>
                                                            <span class="badge bg-light text-dark">
                                                                {{ $siswa->nik_siswa ?? '-' }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Anak Ke</td>
                                                        <td>{{ $siswa->anak_ke ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">No. KK</td>
                                                        <td>{{ $siswa->no_kk ?? '-' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Address Data -->
                                <div class="card mb-4 border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">
                                            <i class="fas fa-map-marker-alt me-2 text-primary"></i>Data Alamat
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td width="20%" class="text-muted">Alamat Lengkap</td>
                                                        <td>{{ $siswa->alamat ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Kode Pos</td>
                                                        <td>
                                                            <span class="badge bg-light text-dark">
                                                                {{ $siswa->kode_pos ?? '-' }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Family Data -->
                            <div class="col-md-6">
                                <div class="card mb-4 border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">
                                            <i class="fas fa-users me-2 text-primary"></i>Data Orang Tua
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <!-- Father Data -->
                                        <div class="mb-4">
                                            <h6 class="d-flex align-items-center">
                                                <i class="fas fa-male text-primary me-2"></i>
                                                <span>Ayah</span>
                                            </h6>
                                            <div class="table-responsive">
                                                <table class="table table-sm table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td width="40%" class="text-muted">NIK Ayah</td>
                                                            <td>{{ $siswa->nik_ayah ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Nama Ayah</td>
                                                            <td>{{ $siswa->nama_ayah ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Pendidikan</td>
                                                            <td>
                                                                <span class="badge bg-light text-dark">
                                                                    {{ $siswa->pendidikanAyah->pendidikan ?? '-' }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Pekerjaan</td>
                                                            <td>{{ $siswa->pekerjaan_ayah ?? '-' }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Mother Data -->
                                        <div>
                                            <h6 class="d-flex align-items-center">
                                                <i class="fas fa-female text-primary me-2"></i>
                                                <span>Ibu</span>
                                            </h6>
                                            <div class="table-responsive">
                                                <table class="table table-sm table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td width="40%" class="text-muted">NIK Ibu</td>
                                                            <td>{{ $siswa->nik_ibu ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Nama Ibu</td>
                                                            <td>{{ $siswa->nama_ibu ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Pendidikan</td>
                                                            <td>
                                                                <span class="badge bg-light text-dark">
                                                                    {{ $siswa->pendidikanIbu->pendidikan ?? '-' }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Pekerjaan</td>
                                                            <td>{{ $siswa->pekerjaan_ibu ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">No. HP Orang Tua</td>
                                                            <td>
                                                                <span class="badge bg-light text-dark">
                                                                    {{ $siswa->hp_ortu ?? '-' }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Data -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">
                                            <i class="fas fa-school me-2 text-primary"></i>Data Pendidikan & Bantuan
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td width="40%" class="text-muted">Asal Sekolah</td>
                                                                <td>{{ $siswa->asal_sekolah ?? '-' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">NPSN</td>
                                                                <td>{{ $siswa->npsn ?? '-' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">NSM</td>
                                                                <td>{{ $siswa->nsm ?? '-' }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td width="40%" class="text-muted">No. KIP</td>
                                                                <td>
                                                                    @if($siswa->no_kip)
                                                                    <span class="badge bg-success text-white">
                                                                        {{ $siswa->no_kip }}
                                                                    </span>
                                                                    @else
                                                                    -
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">No. KKS</td>
                                                                <td>
                                                                    @if($siswa->no_kks)
                                                                    <span class="badge bg-info text-white">
                                                                        {{ $siswa->no_kks }}
                                                                    </span>
                                                                    @else
                                                                    -
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">No. PKH</td>
                                                                <td>
                                                                    @if($siswa->no_pkh)
                                                                    <span class="badge bg-warning text-dark">
                                                                        {{ $siswa->no_pkh }}
                                                                    </span>
                                                                    @else
                                                                    -
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
