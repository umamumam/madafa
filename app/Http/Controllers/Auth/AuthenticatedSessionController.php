<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('login', 'password');

        // Cari user berdasarkan email, NIS, NISN, atau ID Guru
        $user = User::where(function ($query) use ($request) {
            $query->where('email', $request->login)
                ->orWhere('nis', $request->login)
                ->orWhere('nisn', $request->login)
                ->orWhere('idguru', $request->login);
        })->first();

        // Jika user ditemukan dan password valid
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            // Redirect berdasarkan role
            switch ($user->role) {
                case 'siswa':
                    return redirect()->route('profil');
                case 'guru':
                case 'wali kelas':
                    return redirect()->route('profil.guru');
                case 'admin':
                case 'super admin':
                    return redirect()->route('dashboard');
                default:
                    return redirect()->route('dashboard')->with('error', 'Role tidak dikenali.');
            }
        }

        // Jika autentikasi gagal
        return back()->withErrors([
            'login' => 'Email/NIS/NISN/ID Guru atau password salah.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
