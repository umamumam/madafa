<?php

namespace App\Http\Controllers;

use App\Models\DokumenSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenSiswaController extends Controller
{
    public function showUploadForm($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        $dokumen = $siswa->dokumen;
        return view('siswas.upload_dokumen', compact('siswa', 'dokumen'));
    }
    public function upload(Request $request, $siswa_id)
    {
        $request->validate([
            'kk' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'akte' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'surat_keterangan_lulus' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'kip' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);
        $siswa = Siswa::findOrFail($siswa_id);
        $data = ['siswa_id' => $siswa_id];
        foreach (['kk', 'akte', 'surat_keterangan_lulus', 'kip'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $path = $file->store("dokumen_siswa/{$siswa_id}", 'public');
                $data[$field] = $path;
            }
        }
        DokumenSiswa::updateOrCreate(
            ['siswa_id' => $siswa_id],
            $data
        );
        return redirect()->route('siswas.show', $siswa_id)
            ->with('success', 'Dokumen berhasil diupload!');
    }
    public function previewDokumen($siswa_id)
    {
        $siswa = Siswa::with('dokumen')->findOrFail($siswa_id);
        return view('siswas.preview_dokumen', compact('siswa'));
    }
    public function deleteDokumen($siswa_id, $docType)
    {
        $dokumen = DokumenSiswa::where('siswa_id', $siswa_id)->firstOrFail();
        if ($dokumen->$docType) {
            Storage::delete('public/' . $dokumen->$docType);
        }
        $dokumen->update([$docType => null]);
        return redirect()->back()
            ->with('success', 'Dokumen berhasil dihapus!');
    }
}
