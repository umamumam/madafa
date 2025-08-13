<?php

namespace App\Http\Controllers;

use App\Models\KdumDetail;
use Illuminate\Http\Request;

class KdumDetailController extends Controller
{
    public function updateNilai(Request $request, $id)
    {
        $request->validate([
            'nilai_id' => 'nullable|exists:nilais,id',
            'guru_id' => 'nullable|exists:gurus,id',
        ]);

        $detail = KdumDetail::findOrFail($id);
        $detail->update([
            'nilai_id' => $request->nilai_id,
            'guru_id' => $request->guru_id,
        ]);

        return redirect()->back()->with('success', 'Nilai dan penyemak berhasil diperbarui.');
    }
}
