<?php
// filepath: app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Ambil user yang sedang login
            $user = Auth::user();

            // Redirect berdasarkan role
            return $this->redirectBasedOnRole($user);
        }

        // Jika login gagal
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    /**
     * Redirect berdasarkan role user
     */
    protected function redirectBasedOnRole($user)
    {
        switch ($user->role) {
            case 'user':
                return redirect()->route('dashboard.user');
                
            case 'pembina':
                return redirect()->route('dashboard.pembina');
                
            case 'admin':
                return redirect()->route('dashboard.admin');
                
            default:
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'username' => 'Role tidak dikenali.',
                ]);
        }
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}