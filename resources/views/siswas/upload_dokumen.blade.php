@extends('layouts1.app')

@section('content')
<style>
    /* Custom CSS for Document Upload Form */
    .document-upload-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .document-upload-container h2 {
        color: #2c3e50;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f8f9fa;
        text-align: center;
    }

    .document-upload-form .form-label {
        font-weight: 600;
        color: #34495e;
        margin-bottom: 8px;
    }

    .document-upload-form .form-control {
        padding: 10px 15px;
        border-radius: 6px;
        border: 1px solid #ddd;
        transition: all 0.3s;
    }

    .document-upload-form .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
    }

    .file-upload-info {
        margin-top: 5px;
        font-size: 0.9rem;
    }

    .file-upload-info a {
        color: #2980b9;
        text-decoration: none;
        transition: color 0.2s;
    }

    .file-upload-info a:hover {
        color: #1a5276;
        text-decoration: underline;
    }

    .btn-upload {
        background-color: #3498db;
        border-color: #3498db;
        padding: 8px 20px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-upload:hover {
        background-color: #2980b9;
        border-color: #2980b9;
        transform: translateY(-2px);
    }

    .btn-back {
        background-color: #95a5a6;
        border-color: #95a5a6;
        padding: 8px 20px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-back:hover {
        background-color: #7f8c8d;
        border-color: #7f8c8d;
    }

    .alert-success {
        border-radius: 6px;
        padding: 15px;
        margin-bottom: 25px;
    }

    .upload-section {
        margin-bottom: 25px;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid #3498db;
    }

    .upload-section:hover {
        background-color: #f1f8fe;
    }

    @media (max-width: 768px) {
        .document-upload-container {
            padding: 20px;
        }

        .btn-upload, .btn-back {
            width: 100%;
            margin-bottom: 10px;
        }
    }
</style>

<div class="document-upload-container">
    <h2>Upload Dokumen Siswa: {{ $siswa->nama_siswa }}</h2>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('siswas.upload-dokumen.submit', $siswa->id) }}" method="POST" enctype="multipart/form-data" class="document-upload-form">
        @csrf

        <div class="upload-section">
            <div class="mb-3">
                <label for="kk" class="form-label">KK (Kartu Keluarga)</label>
                <input type="file" class="form-control" id="kk" name="kk" accept=".pdf,.jpg,.jpeg,.png">
                @if($dokumen && $dokumen->kk)
                    <small class="text-muted file-upload-info">
                        <i class="fas fa-file-alt"></i> File terupload:
                        <a href="{{ asset('storage/' . $dokumen->kk) }}" target="_blank">
                            Lihat Dokumen
                        </a>
                    </small>
                @endif
            </div>
        </div>

        <div class="upload-section">
            <div class="mb-3">
                <label for="akte" class="form-label">Akte Kelahiran</label>
                <input type="file" class="form-control" id="akte" name="akte" accept=".pdf,.jpg,.jpeg,.png">
                @if($dokumen && $dokumen->akte)
                    <small class="text-muted file-upload-info">
                        <i class="fas fa-file-alt"></i> File terupload:
                        <a href="{{ asset('storage/' . $dokumen->akte) }}" target="_blank">
                            Lihat Dokumen
                        </a>
                    </small>
                @endif
            </div>
        </div>

        <div class="upload-section">
            <div class="mb-3">
                <label for="surat_keterangan_lulus" class="form-label">Surat Keterangan Lulus</label>
                <input type="file" class="form-control" id="surat_keterangan_lulus" name="surat_keterangan_lulus" accept=".pdf,.jpg,.jpeg,.png">
                @if($dokumen && $dokumen->surat_keterangan_lulus)
                    <small class="text-muted file-upload-info">
                        <i class="fas fa-file-alt"></i> File terupload:
                        <a href="{{ asset('storage/' . $dokumen->surat_keterangan_lulus) }}" target="_blank">
                            Lihat Dokumen
                        </a>
                    </small>
                @endif
            </div>
        </div>

        <div class="upload-section">
            <div class="mb-3">
                <label for="kip" class="form-label">KIP (Kartu Indonesia Pintar)</label>
                <input type="file" class="form-control" id="kip" name="kip" accept=".pdf,.jpg,.jpeg,.png">
                @if($dokumen && $dokumen->kip)
                    <small class="text-muted file-upload-info">
                        <i class="fas fa-file-alt"></i> File terupload:
                        <a href="{{ asset('storage/' . $dokumen->kip) }}" target="_blank">
                            Lihat Dokumen
                        </a>
                    </small>
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('siswas.show', $siswa->id) }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary btn-upload">
                <i class="fas fa-upload"></i> Upload Dokumen
            </button>
        </div>
    </form>
</div>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection
