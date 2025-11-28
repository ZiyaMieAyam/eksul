<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Siswa;
use App\Models\Kehadiran;
use App\Models\Pendaftaran;
use App\Models\Prestasi;
use App\Models\Eskul;
use App\Models\User;

class SiswaController extends Controller
{
    // dashboard siswa
    public function dashboard()
    {
        // ambil user yang login dan record siswa terkait
        $user = auth()->user();
        $siswa = $user->siswa ?? Siswa::where('id_user', $user->id_user)->first();

        if (! $siswa) {
            return redirect()->route('login')->withErrors('Akun belum terdaftar sebagai siswa.');
        }

        // Ambil hanya prestasi yang sudah Diverifikasi milik siswa ini
        $prestasis = Prestasi::with('eskul')
            ->where('id_siswa', $siswa->id_siswa)
            ->where('status', 'Diverifikasi')
            ->get();

        return view('dashboard.dashboardsiswa', compact('siswa', 'prestasis'));
    }

    /**git
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Siswa::all();
        return view('guru.dasis', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guru.tamsis');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'nama_siswa' => 'required|string|max:100',
            'kelas'      => 'required|string|max:50',
            'alamat'     => 'nullable'
        ]);

        Siswa::create([
            'id_user'    => $request->input('id_user'),
            'nama_siswa' => $request->input('nama_siswa'),
            'kelas'      => $request->input('kelas'),
            'alamat'     => $request->input('alamat'),
        ]);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $siswa = Siswa::with('pendaftarans')->findOrFail($id);
        $daftarEskul = Eskul::all();
        $pendaftaranDiterima = $siswa->pendaftarans->where('status', 'Diterima')->first();
        $eskulTerpilih = $pendaftaranDiterima->id_eskul ?? null;
        return view('guru.edsis', compact('siswa', 'daftarEskul', 'eskulTerpilih'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nis'        => 'required|string|max:50',
            'password'   => 'nullable|string|min:6',
            'nama_siswa' => 'required|string|max:100',
            'kelas'      => 'required|string|max:50',
            'alamat'     => 'nullable|string',
            'id_eskul'   => 'nullable|integer|exists:eskuls,id_eskul',
        ]);

        $siswa = Siswa::findOrFail($id);
        $nis = $request->input('nis');

        $user = $siswa->id_user ? User::find($siswa->id_user) : null;
        if ($user) {
            if ($user->username !== $nis) {
                if (User::where('username', $nis)->where('id_user', '!=', $user->id_user)->exists()) {
                    return back()->withErrors(['nis' => 'NIS sudah dipakai oleh akun lain.'])->withInput();
                }
                $user->username = $nis;
            }
        } else {
            $user = User::where('username', $nis)->first();
            if (!$user) {
                $plain = $request->filled('password') ? $request->input('password') : Str::random(8);
                $user = User::create([
                    'username' => $nis,
                    'password' => Hash::make($plain),
                    'role' => 'siswa',
                ]);
                session()->flash('info', "Akun baru dibuat: username={$user->username} password={$plain}");
            }
            $siswa->id_user = $user->id_user;
        }

        if ($request->filled('password') && $user) {
            $user->password = Hash::make($request->input('password'));
        }
        if ($user) $user->save();

        // gunakan coalese() supaya alamat tidak null (default string kosong)
        $siswa->update([
            'nis' => $nis,
            'nama_siswa' => $request->input('nama_siswa'),
            'kelas' => $request->input('kelas'),
            'alamat' => $request->input('alamat') ?? '',
        ]);

        if ($request->filled('id_eskul')) {
            Pendaftaran::updateOrCreate(
                ['id_siswa' => $siswa->id_siswa],
                ['id_eskul' => $request->input('id_eskul'), 'tanggal_daftar' => now()->toDateString(), 'status' => 'Diterima']
            );
        }

        return redirect()->route('siswa.index')->with('success', 'Siswa diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $siswa = Siswa::findOrFail($id);

    // Hapus semua pendaftaran terkait
    Pendaftaran::where('id_siswa', $siswa->id_siswa)->delete();

    // Hapus semua kehadiran terkait
    Kehadiran::where('id_siswa', $siswa->id_siswa)->delete();

    // Hapus semua prestasi terkait
    Prestasi::where('id_siswa', $siswa->id_siswa)->delete();

    // Hapus akun user terkait (opsional)
    if ($siswa->id_user) {
        $user = User::find($siswa->id_user);
        if ($user) {
            $user->delete();
        }
    }

    // Baru hapus siswa
    $siswa->delete();

    return redirect()->route('siswa.index')->with('success', 'Siswa beserta semua data terkait berhasil dihapus.');
}


    /**
     * Display the profile of the logged-in student.
     */
    public function profil()
    {
        $siswa = auth()->user()->siswa;

        $pendaftaran = $siswa->pendaftarans()->with('eskul')->get();

        return view('siswa.prosis', compact('siswa', 'pendaftaran'));
    }
}
