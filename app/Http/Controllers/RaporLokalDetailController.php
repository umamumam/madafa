<?php

namespace App\Http\Controllers;

use App\Models\RaporLokalDetail;
use Illuminate\Http\Request;

class RaporLokalDetailController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'nilai_id' => 'nullable|exists:nilais,id',
            'predikat' => 'nullable|string|max:2',
            'jumlah' => 'nullable|integer',
            'rata_rata' => 'nullable|numeric',
        ]);

        $detail = RaporLokalDetail::findOrFail($id);
        $detail->update([
            'nilai_id' => $request->nilai_id,
            'predikat' => $request->predikat,
            'jumlah' => $request->jumlah,
            'rata_rata' => $request->rata_rata,
        ]);

        return redirect()->back()->with('success', 'Data detail rapor berhasil diperbarui.');
    }
}
