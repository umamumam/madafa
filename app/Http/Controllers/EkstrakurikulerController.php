<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;

class EkstrakurikulerController extends Controller
{
    public function index()
    {
        $data = Ekstrakurikuler::all();
        return view('ekstrakurikuler.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ekskul' => 'required|string|max:255',
        ]);

        Ekstrakurikuler::create($request->all());
        return redirect()->back()->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ekskul' => 'required|string|max:255',
        ]);

        $ekskul = Ekstrakurikuler::findOrFail($id);
        $ekskul->update($request->all());
        return redirect()->back()->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Ekstrakurikuler::destroy($id);
        return redirect()->back()->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}
