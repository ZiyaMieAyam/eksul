<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login'); // Ini bakal jadi form login
    }  

    /**
     * Show the form for creating a new resource.
     */
    
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();

            return match($user->role) {
                'guru' => redirect()->intended('/dashboard/guru')->with('success', 'Login berhasil sebagai Guru.'),
                'pembina' => redirect()->intended('/dashboard/pembina')->with('success', 'Login berhasil sebagai Pembina.'),
                'siswa' => redirect()->intended('/dashboard/siswa')->with('success', 'Login berhasil sebagai Siswa.'),
                default => redirect()->intended('/'),
            };
        }

        return back()->withErrors(['username' => 'Username atau password salah'])->withInput();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

}
