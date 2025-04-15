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
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;

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
        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(route('dashboard', absolute: false));
        $user = User::where(function ($query) use ($request) {
            $query->where('nis', $request->login)
                ->orWhere('nisn', $request->login)
                ->orWhere('idguru', $request->login);
        })->first();

        // Cek apakah user ditemukan dan password valid
        // if ($user && Hash::check($request->password, $user->password)) {
        //     Auth::login($user);
        //     return redirect()->intended(route('dashboard'));
        // }
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            if ($user->role === 'siswa') {
                return redirect()->route('profil');
            } elseif ($user->role === 'guru' || $user->role === 'wali kelas') {
                return redirect()->route('profil.guru');
            } elseif ($user->role === 'admin' || $user->role === 'super admin') {
                return redirect()->route('dashboard');
            }
            return redirect()->route('dashboard')->with('error', 'Role tidak dikenali.');
        }


        // Jika tidak ditemukan, kembali dengan error
        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
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
