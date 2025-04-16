<?php

namespace App\Http\Controllers;

use App\Models\RaporLokalDetail;
use App\Models\Nilai;
use Illuminate\Http\Request;

class RaporLokalDetailController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'nilai_id' => 'nullable|exists:nilais,id',
            'predikat' => 'nullable|string|max:255',
            'jumlah' => 'nullable|integer',
            'rata_rata' => 'nullable|numeric',
        ]);
        $detail = RaporLokalDetail::findOrFail($id);
        $jumlah = $request->input('jumlah');
        $rataRata = $request->input('rata_rata');
        $nilaiId = $request->input('nilai_id');
        $predikat = $request->input('predikat');
        if ($jumlah !== null) {
            $nilai = Nilai::where('min', '<=', $jumlah)
                        ->where('max', '>=', $jumlah)
                        ->first();

            if ($nilai) {
                $nilaiId = $nilai->id;
                $predikat = $nilai->keterangan;
            }
        }
        $detail->update([
            'nilai_id' => $nilaiId,
            'predikat' => $predikat,
            'jumlah' => $jumlah,
            'rata_rata' => $rataRata,
        ]);

        return redirect()->back()->with('success', 'Data detail rapor berhasil diperbarui.');
    }
}
