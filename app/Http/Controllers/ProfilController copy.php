<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = null;
        $users = User::all();
        $siswas = Siswa::all();
        if ($user->role === 'siswa') {
            $data = Siswa::with('jeniskelamin', 'kelas', 'program')->where('nisn', $user->nisn)->first();
        } elseif ($user->role === 'guru') {
            $data = Guru::with('jeniskelamin', 'pendidikanTerakhir', 'mapel1', 'jabatan1')->where('idguru', $user->idguru)->first();
        }

        return view('profil.index', compact('user', 'data', 'users', 'siswas'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }}
