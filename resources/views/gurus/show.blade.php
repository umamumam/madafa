@extends('layouts1.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <!-- Header Section -->
            <div class="card bg-primary text-white mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">BIODATA PENDIDIK DAN TENAGA KEPENDIDIKAN</h2>
                    <a href="{{ route('profil.identitasguru.pdf') }}" class="btn btn-light d-flex align-items-center" target="_blank">
                        <i class="fas fa-print me-2"></i> Cetak PDF
                    </a>
                </div>
            </div>

            <div class="card-body">
                @if ($guru)
                <div class="row">
                    <!-- Foto Profil -->
                    <div class="col-md-4 text-center">
                        <div class="profile-photo-container mb-4">
                            @if ($guru->foto)
                                <img src="{{ asset('storage/' . str_replace('public/', '', $guru->foto)) }}"
                                    alt="Foto Guru"
                                    class="img-fluid rounded-circle mb-3 border border-3 border-primary"
                                    style="width: 180px; height: 180px; object-fit: cover;">
                            @else
                                <img src="{{ asset('madafa.webp') }}" alt="Foto Default"
                                    class="img-fluid rounded-circle mb-3 border border-3 border-primary"
                                    style="width: 180px; height: 180px; object-fit: cover;">
                            @endif
                        </div>
                        <h4 class="mt-3">{{ $guru->nama_guru }}</h4>
                        <p class="text-muted mb-0">{{ $guru->niy_nip ?? '-' }} (NIY/NIP)</p>
                        <p class="text-muted">{{ $guru->npk_nuptk_pegid ?? '-' }} (NPK/NUPTK)</p>
                    </div>

                    <!-- Data Pribadi -->
                    <div class="col-md-8">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light text-white">
                                <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>Data Pribadi</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>ID Guru:</strong> {{ $guru->idguru }}</p>
                                        <p><strong>NIK:</strong> {{ $guru->nik ?? '-' }}</p>
                                        <p><strong>Jenis Kelamin:</strong> {{ $guru->jeniskelamin->jeniskelamin ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Tempat Lahir:</strong> {{ $guru->tempat_lahir ?? '-' }}</p>
                                        <p><strong>Tanggal Lahir:</strong> {{ $guru->tgl_lahir ? \Carbon\Carbon::parse($guru->tgl_lahir)->translatedFormat('d F Y') : '-' }}</p>
                                        <p><strong>No. HP:</strong> {{ $guru->no_hp ?? '-' }}</p>
                                    </div>
                                    <div class="col-12">
                                        <p><strong>Alamat:</strong> {{ $guru->alamat ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Kepegawaian (Full Width) -->
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-light text-white">
                                <h5 class="mb-0"><i class="fas fa-briefcase me-2"></i>Data Kepegawaian</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <p><strong>Status Guru:</strong> {{ $guru->statusGuru->status_guru ?? '-' }}</p>
                                        <p><strong>Masa Kerja:</strong> {{ $guru->masa_kerja ?? '-' }} tahun</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Pendidikan Terakhir:</strong> {{ $guru->pendidikanTerakhir->pendidikan ?? '-' }}</p>
                                        <p><strong>Institusi Pendidikan:</strong> {{ $guru->inst_pend_terakhir ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p><strong>Tanggal SK Awal:</strong> {{ $guru->tmt_sk_awal ? \Carbon\Carbon::parse($guru->tmt_sk_awal)->translatedFormat('d F Y') : '-' }}</p>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <p><strong>Mata Pelajaran:</strong></p>
                                        <ul class="list-unstyled">
                                            @if($guru->mapel1)<li>{{ $guru->mapel1->mapel }}</li>@endif
                                            @if($guru->mapel2)<li>{{ $guru->mapel2->mapel }}</li>@endif
                                            @if($guru->mapel3)<li>{{ $guru->mapel3->mapel }}</li>@endif
                                            @if(!$guru->mapel1 && !$guru->mapel2 && !$guru->mapel3)<li>-</li>@endif
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Jabatan:</strong></p>
                                        <ul class="list-unstyled">
                                            @if($guru->jabatan1)<li>{{ $guru->jabatan1->jabatan }}</li>@endif
                                            @if($guru->jabatan2)<li>{{ $guru->jabatan2->jabatan }}</li>@endif
                                            @if($guru->jabatan3)<li>{{ $guru->jabatan3->jabatan }}</li>@endif
                                            @if(!$guru->jabatan1 && !$guru->jabatan2 && !$guru->jabatan3)<li>-</li>@endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="alert alert-warning text-center">Data guru tidak ditemukan.</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
