<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        $user = User::where('username', $request->username)->first();
        if ($user && Hash::check ($credentials['password'], $user->password)) {
            Auth::login($user);

            
            if ($user->role === 'guru') {
                return redirect()->route('dashboard.guru');
            } elseif ($user->role === 'siswa') {
                return redirect()->route('dashboard.siswa');
            } elseif ($user->role === 'pembina') {
                return redirect()->route('dashboard.pembina');
            } else {
                return redirect()->route('login')->withErrors('Role tidak dikenali.');
            }
        }

        return back()->withErrors('Login gagal. Periksa username dan password Anda.');
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
