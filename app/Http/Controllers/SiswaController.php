<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kehadiran;
use App\Models\Pendaftaran;
use App\Models\Prestasi; // Tambahkan ini

class SiswaController extends Controller
{
    // dashboard siswa
    public function dashboard()
    {
        $user = auth()->user();
        $siswa = $user->siswa ?? null;
        if (!$siswa) {
            // Redirect ke halaman error atau tampilkan pesan
            return redirect()->route('logout')->withErrors('Akun Anda belum terdaftar sebagai siswa.');
        }   
        $prestasis = Prestasi::where('id_siswa', $siswa->id_siswa)->get();
        return view('dashboard.dashboardsiswa', compact('siswa', 'prestasis'));
    }

    /**
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
            'nama_siswa' => 'required|string|max:100',
            'kelas'      => 'required|string|max:50',
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
        $data = Siswa::findOrFail($id);
        return view('guru.edsis', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user'    => 'nullable|integer',
            'nama_siswa' => 'required|string|max:100',
            'kelas'      => 'required|string|max:50',
            'alamat'     => 'nullable|string',
        ]);

        Siswa::where('id_siswa', $id)->update([
            'id_user'    => $request->input('id_user'),
            'nama_siswa' => $request->input('nama_siswa'),
            'kelas'      => $request->input('kelas'),
            'alamat'     => $request->input('alamat'),
        ]);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Siswa::findOrFail($id);
        $data->delete();

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus.');
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
