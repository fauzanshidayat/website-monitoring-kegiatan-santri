<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login pengguna.
     */
    public function login(Request $request)
    {
        // Validasi data input
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Coba autentikasi
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'username' => ['Username atau password salah.'],
            ]);
        }

        // Regenerasi sesi untuk mencegah session fixation
        $request->session()->regenerate();

        $user = Auth::user();

        // Redirect berdasarkan role pengguna
        return match ($user->role) {
            'admin'     => redirect()->route('dashboard.admin'),
            'pengurus'  => redirect()->route('dashboard.pengurus'),
            'pengasuh'  => redirect()->route('dashboard.pengasuh'),
            'santri'    => redirect()->route('dashboard.santri'),
            default     => redirect('/'),
        };
    }

    /**
     * Logout dan hapus sesi.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
