<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan form login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Auth::attempt otomatis pakai provider dari config/auth.php (userss)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect sesuai role
            $role = Auth::user()->role;
            if ($role === 'siswa') {
                return redirect()->route('dashboard.siswa')->with('success', 'ANDA BERHASIL LOGIN');
            } elseif ($role === 'guru') {
                return redirect()->route('dashboard.guru')->with('success', 'ANDA BERHASIL LOGIN');
            } elseif ($role === 'pembina') {
                return redirect()->route('dashboard.pembina')->with('success', 'ANDA BERHASIL LOGIN');
            } else {
                Auth::logout();
                return redirect()->route('login')->withErrors(['username' => 'Role tidak dikenali.']);
            }
        }

        return back()->withErrors(['username' => 'Username atau password salah'])->withInput();
    }

    /**
     * Logout user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
