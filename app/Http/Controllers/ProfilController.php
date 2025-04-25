<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cek jika user login adalah siswa
        if ($user->role !== 'siswa') {
            return redirect()->route('dashboard')->with('error', 'Hanya siswa yang dapat melihat halaman ini.');
        }

        // Ambil data siswa berdasarkan nisn atau nis
        $siswa = Siswa::where('nisn', $user->nisn)
            ->orWhere('nis', $user->nis)
            ->with([
                'jeniskelamin',
                'kelas',
                'program',
                'pendidikanAyah',
                'pendidikanIbu'
            ])
            ->first();

        if (!$siswa) {
            return back()->with('error', 'Data siswa tidak ditemukan.');
        }

        return view('profil.index', [
            'user' => $user,
            'siswa' => $siswa
        ]);
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Password lama salah.');
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return back()->with('success', 'Password berhasil diubah.');
    }
    public function uploadFoto(Request $request)
    {
        $validatedData = $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $file = $request->file('foto');
        $filename = uniqid('foto-siswa-', true) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/foto-siswa', $filename);
        $siswa = Auth::user()->siswa;
        $siswa->foto = str_replace('public/', '', $path);
        $siswa->save();

        return back()->with('success', 'Foto berhasil diupdate');
    }

    // public function showProfile()
    // {
    //     $user = Auth::user();
    //     if ($user->role === 'siswa') {
    //         return redirect()->route('dashboard')->with('error', 'Hanya guru, wali kelas, admin, atau super admin yang dapat melihat halaman ini.');
    //     }
    //     if ($user->role === 'guru') {
    //         // Fetch guru data
    //         $guru = Guru::where('idguru', $user->idguru)
    //             ->with([
    //                 'jeniskelamin',
    //                 'pendidikanTerakhir',
    //                 'mapel1',
    //                 'mapel2',
    //                 'mapel3',
    //                 'jabatan1',
    //                 'jabatan2',
    //                 'jabatan3',
    //             ])
    //             ->first();

    //         if (!$guru) {
    //             return back()->with('error', 'Data guru tidak ditemukan.');
    //         }
    //         $fotoPath = $guru->foto ? asset('storage/' . $guru->foto) : asset('mantis/assets/images/user/avatar-5.jpg');
    //         return view('profil.guru', [
    //             'user' => $user,
    //             'guru' => $guru,
    //             'fotoPath' => $fotoPath,
    //         ]);
    //     }
    //     if ($user->role === 'wali kelas' || $user->role === 'admin' || $user->role === 'super admin') {
    //         return view('profil.guru', [
    //             'user' => $user
    //         ]);
    //     }
    //     return redirect()->route('dashboard')->with('error', 'Role tidak dikenali.');
    // }
    public function showProfile()
    {
        $user = Auth::user();

        if ($user->role === 'siswa') {
            return redirect()->route('dashboard')->with('error', 'Hanya guru, wali kelas, admin, atau super admin yang dapat melihat halaman ini.');
        }

        // Ambil data guru kalau user punya idguru
        $guru = null;
        if ($user->idguru) {
            $guru = Guru::where('idguru', $user->idguru)
                ->with([
                    'jeniskelamin',
                    'pendidikanTerakhir',
                    'mapel1',
                    'mapel2',
                    'mapel3',
                    'jabatan1',
                    'jabatan2',
                    'jabatan3',
                ])
                ->first();
        }

        // Jika role guru tapi data guru tidak ditemukan
        if ($user->role === 'guru' && !$guru) {
            return back()->with('error', 'Data guru tidak ditemukan.');
        }

        // Set foto default
        $fotoPath = ($guru && $guru->foto) ? asset('storage/' . $guru->foto) : asset('mantis/assets/images/user/avatar-5.jpg');

        return view('profil.guru', [
            'user' => $user,
            'guru' => $guru,
            'fotoPath' => $fotoPath,
        ]);
    }

    public function identitasGuru()
    {
        $user = Auth::user();

        if ($user->role === 'siswa') {
            return redirect()->route('dashboard')->with('error', 'Hanya guru, wali kelas, admin, atau super admin yang dapat melihat halaman ini.');
        }
        $guru = null;
        if ($user->idguru) {
            $guru = Guru::where('idguru', $user->idguru)
                ->with([
                    'jeniskelamin',
                    'statusGuru',
                    'pendidikanTerakhir',
                    'mapel1',
                    'mapel2',
                    'mapel3',
                    'jabatan1',
                    'jabatan2',
                    'jabatan3',
                ])
                ->first();
        }
        if ($user->role === 'guru' && !$guru) {
            return back()->with('error', 'Data guru tidak ditemukan.');
        }
        $fotoPath = ($guru && $guru->foto) ? asset('storage/' . $guru->foto) : asset('mantis/assets/images/user/avatar-5.jpg');
        return view('profil.identitasguru', [
            'user' => $user,
            'guru' => $guru,
            'fotoPath' => $fotoPath,
        ]);
    }
    public function cetakIdentitasGuruPdf()
    {
        $user = Auth::user();
        if ($user->role === 'siswa') {
            return redirect()->route('dashboard')->with('error', 'Hanya guru, wali kelas, admin, atau super admin yang dapat mencetak data ini.');
        }
        $guru = null;
        if ($user->idguru) {
            $guru = Guru::where('idguru', $user->idguru)
                ->with([
                    'jeniskelamin',
                    'statusGuru',
                    'pendidikanTerakhir',
                    'mapel1',
                    'mapel2',
                    'mapel3',
                    'jabatan1',
                    'jabatan2',
                    'jabatan3',
                ])
                ->first();
        }
        if ($user->role === 'guru' && !$guru) {
            return back()->with('error', 'Data guru tidak ditemukan.');
        }
        $fotoPath = ($guru && $guru->foto)
            ? public_path('storage/' . $guru->foto)
            : public_path('mantis/assets/images/user/avatar-5.jpg');
        $html = view('profil.identitasguru-pdf', [
            'user' => $user,
            'guru' => $guru,
            'fotoPath' => $fotoPath,
        ])->render();
        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];
        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $mpdf = new Mpdf([
            'format' => 'A4',
            'orientation' => 'P',
            'fontDir' => array_merge($fontDirs, [
                public_path('fonts'),
            ]),
            'fontdata' => $fontData + [
                'amiri' => [
                    'R' => 'Amiri-Regular.ttf',
                    'B' => 'Amiri-Bold.ttf',
                    'I' => 'Amiri-Slanted.ttf',
                    'BI' => 'Amiri-BoldSlanted.ttf',
                ]
            ],
            'default_font' => 'amiri'
        ]);
        $mpdf->WriteHTML($html);
        return $mpdf->Output('biodata-guru.pdf', 'I');
    }
    public function identitasSiswa()
    {
        $user = Auth::user();

        // Cek jika user login adalah siswa
        if ($user->role !== 'siswa') {
            return redirect()->route('dashboard')->with('error', 'Hanya siswa yang dapat melihat halaman ini.');
        }

        // Ambil data siswa berdasarkan nisn atau nis
        $siswa = Siswa::where('nisn', $user->nisn)
            ->orWhere('nis', $user->nis)
            ->with([
                'jeniskelamin',
                'kelas',
                'program',
                'pendidikanAyah',
                'pendidikanIbu'
            ])
            ->first();

        if (!$siswa) {
            return back()->with('error', 'Data siswa tidak ditemukan.');
        }

        return view('profil.identitassiswa', [
            'user' => $user,
            'siswa' => $siswa
        ]);
    }
    public function cetakIdentitasSiswaPdf()
    {
        $user = Auth::user();
        if ($user->role !== 'siswa') {
            return redirect()->route('dashboard')->with('error', 'Hanya siswa yang dapat mencetak data ini.');
        }
        $guru = Guru::whereHas('jabatan1', function ($query) {
            $query->where('jabatan', 'Kepala Madrasah');
        })->select('niy_nip')->first();

        $siswa = Siswa::where('nisn', $user->nisn)
            ->orWhere('nis', $user->nis)
            ->with([
                'jeniskelamin',
                'kelas',
                'program',
                'pendidikanAyah',
                'pendidikanIbu'
            ])
            ->first();
        if (!$siswa) {
            return back()->with('error', 'Data siswa tidak ditemukan.');
        }
        $fotoPath = ($siswa && $siswa->foto)
            ? public_path('storage/' . $siswa->foto)
            : public_path('mantis/assets/images/user/avatar-5.jpg');
        $html = view('profil.identitassiswa-pdf', [
            'user' => $user,
            'siswa' => $siswa,
            'guru' => $guru,
            'fotoPath' => $fotoPath
        ])->render();
        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];
        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $mpdf = new Mpdf([
            'format' => 'A4',
            'orientation' => 'P',
            'fontDir' => array_merge($fontDirs, [
                public_path('fonts'),
            ]),
            'fontdata' => $fontData + [
                'amiri' => [
                    'R' => 'Amiri-Regular.ttf',
                    'B' => 'Amiri-Bold.ttf',
                    'I' => 'Amiri-Slanted.ttf',
                    'BI' => 'Amiri-BoldSlanted.ttf',
                ]
            ],
            'default_font' => 'amiri'
        ]);
        $mpdf->WriteHTML($html);
        return $mpdf->Output('biodata-siswa.pdf', 'I');
    }
}
