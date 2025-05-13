@extends('layouts1.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Dokumen Siswa: {{ $siswa->nama_siswa }}</h2>

    <div class="card shadow">
        <div class="card-body">
            <!-- Tabel Preview Dokumen -->
            <table class="table table-bordered">
                <thead class="bg-light">
                    <tr>
                        <th width="30%">Jenis Dokumen</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- KK -->
                    <tr>
                        <td>Kartu Keluarga (KK)</td>
                        <td>
                            @if($siswa->dokumen && $siswa->dokumen->kk)
                            <span class="text-success">✓ Terupload</span>
                            @else
                            <span class="text-danger">× Belum diupload</span>
                            @endif
                        </td>
                        <td>
                            @if($siswa->dokumen && $siswa->dokumen->kk)
                            <a href="{{ asset('storage/' . $siswa->dokumen->kk) }}" target="_blank"
                                class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <a href="{{ route('siswas.upload-dokumen', $siswa->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-sync-alt"></i> Ganti
                            </a>
                            {{-- <button class="btn btn-sm btn-danger" onclick="confirmDelete('kk', '{{ $siswa->id }}')">
                                <i class="fas fa-trash"></i> Hapus
                            </button> --}}
                            @else
                            <a href="{{ route('siswas.upload-dokumen', $siswa->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-upload"></i> Upload
                            </a>
                            @endif
                        </td>
                    </tr>

                    <!-- Akte -->
                    <tr>
                        <td>Akte Kelahiran</td>
                        <td>
                            @if($siswa->dokumen && $siswa->dokumen->akte)
                            <span class="text-success">✓ Terupload</span>
                            @else
                            <span class="text-danger">× Belum diupload</span>
                            @endif
                        </td>
                        <td>
                            @if($siswa->dokumen && $siswa->dokumen->akte)
                            <a href="{{ asset('storage/' . $siswa->dokumen->akte) }}" target="_blank"
                                class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <a href="{{ route('siswas.upload-dokumen', $siswa->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-sync-alt"></i> Ganti
                            </a>
                            {{-- <button class="btn btn-sm btn-danger" onclick="confirmDelete('akte', '{{ $siswa->id }}')">
                                <i class="fas fa-trash"></i> Hapus
                            </button> --}}
                            @else
                            <a href="{{ route('siswas.upload-dokumen', $siswa->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-upload"></i> Upload
                            </a>
                            @endif
                        </td>
                    </tr>

                    <!-- Surat Keterangan Lulus -->
                    <tr>
                        <td>Surat Keterangan Lulus (SKL)</td>
                        <td>
                            @if($siswa->dokumen && $siswa->dokumen->surat_keterangan_lulus)
                            <span class="text-success">✓ Terupload</span>
                            @else
                            <span class="text-danger">× Belum diupload</span>
                            @endif
                        </td>
                        <td>
                            @if($siswa->dokumen && $siswa->dokumen->surat_keterangan_lulus)
                            <a href="{{ asset('storage/' . $siswa->dokumen->surat_keterangan_lulus) }}" target="_blank"
                                class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <a href="{{ route('siswas.upload-dokumen', $siswa->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-sync-alt"></i> Ganti
                            </a>
                            {{-- <button class="btn btn-sm btn-danger"
                                onclick="confirmDelete('surat_keterangan_lulus', '{{ $siswa->id }}')">
                                <i class="fas fa-trash"></i> Hapus
                            </button> --}}
                            @else
                            <a href="{{ route('siswas.upload-dokumen', $siswa->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-upload"></i> Upload
                            </a>
                            @endif
                        </td>
                    </tr>

                    <!-- KIP -->
                    <tr>
                        <td>Kartu Indonesia Pintar (KIP)</td>
                        <td>
                            @if($siswa->dokumen && $siswa->dokumen->kip)
                            <span class="text-success">✓ Terupload</span>
                            @else
                            <span class="text-danger">× Belum diupload</span>
                            @endif
                        </td>
                        <td>
                            @if($siswa->dokumen && $siswa->dokumen->kip)
                            <a href="{{ asset('storage/' . $siswa->dokumen->kip) }}" target="_blank"
                                class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <a href="{{ route('siswas.upload-dokumen', $siswa->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-sync-alt"></i> Ganti
                            </a>
                            {{-- <button class="btn btn-sm btn-danger" onclick="confirmDelete('kip', '{{ $siswa->id }}')">
                                <i class="fas fa-trash"></i> Hapus
                            </button> --}}
                            @else
                            <a href="{{ route('siswas.upload-dokumen', $siswa->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-upload"></i> Upload
                            </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-3">
                <a href="{{ route('siswas.show', $siswa->id) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Profil Siswa
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus dokumen ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(docType, siswaId) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: "Apakah Anda yakin ingin menghapus dokumen ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form delete
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/siswas/${siswaId}/delete-dokumen/${docType}`;
                form.style.display = 'none';

                const csrf = document.createElement('input');
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';

                const method = document.createElement('input');
                method.name = '_method';
                method.value = 'DELETE';

                form.appendChild(csrf);
                form.appendChild(method);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endpush

@push('styles')
<style>
    .table th {
        vertical-align: middle;
    }

    .table td {
        vertical-align: middle;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
    }
</style>
@endpush
