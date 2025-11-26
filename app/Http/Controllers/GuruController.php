<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Eskul;
use App\Models\Siswa;
use App\Models\Pendaftaran;
use App\Models\Kehadiran;
use App\Models\Prestasi;

class GuruController extends Controller
{
    // dashboard guru
    public function dashboard()
    {
        // Total SEMUA siswa dari tabel siswas (tanpa filter apapun)
        $totalSiswa = Siswa::count();

        // Statistik semua eskul dengan jumlah pendaftar
        $eskulStats = Eskul::withCount('pendaftaran')->get();

        return view('dashboard.dashboardguru', compact(
            'totalSiswa',
            'eskulStats'
        ));
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
        return view('guru.tampim');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|integer|exists:userss,id_user',
            'nama_guru' => 'required|string|max:50',
            'jabatan' => 'required|string|max:25',
        ]);

        Guru::create($validated);
        return redirect()->route('guru.index')->with('success', 'Guru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $guru = Guru::with('user')->findOrFail($id);
        return view('guru.show', compact('guru'));
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
        $validated = $request->validate([
            'id_user' => 'required|integer|exists:userss,id_user',
            'nama_guru' => 'required|string|max:50',
            'jabatan' => 'required|string|max:25',
        ]);

        $guru = Guru::findOrFail($id);
        $guru->update($validated);

        return redirect()->route('guru.index')->with('success', 'Guru berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Guru berhasil dihapus.');
    }

    public function absensi()
    {
        $eskuls = Eskul::all();
        return view('guru.absis', compact('eskuls'));
    }

    public function absensiDetail($id_eskul)
    {
        $eskul = \App\Models\Eskul::findOrFail($id_eskul);
        $kehadirans = \App\Models\Kehadiran::with('siswa')
            ->where('id_eskul', $id_eskul)
            ->orderBy('tanggal', 'desc')
            ->get()
            ->groupBy('tanggal');
        return view('guru.absis', compact('eskul', 'kehadirans')); 
    }

    public function dapim()
    {
        $pembinas = \App\Models\Pembina::with('user')->get();
        return view('guru.dapim', compact('pembinas'));
    }

    public function dasis()
    {
        $data = Siswa::with(['user', 'eskul'])->get(); // Tambahkan with('eskul')
        return view('guru.dasis', compact('data'));
    }

    public function tamsis()
    {
        return view('guru.tamsis');
    }

    public function storesis(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:100',
            'kelas'      => 'required|string|max:50',
            'alamat'     => 'nullable|string',
        ]);

        Siswa::create([
            'id_user'    => $request->input('id_user'),
            'nama_siswa' => $request->input('nama_siswa'),
            'kelas'      => $request->input('kelas'),
            'alamat'     => $request->input('alamat'),
        ]);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil disimpan.');
    }

    public function edsis($id)
    {
        $data = Siswa::findOrFail($id);
        return view('guru.edsis', compact('data'));
    }

    public function updatesis(Request $request, $id)
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

    public function destroyis($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }

    public function prestasiVerifikasi()
    {
        $prestasis = Prestasi::with(['siswa', 'eskul'])
            ->where('status', 'Pending')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('guru.veripres', compact('prestasis'));
    }

    public function prestasiUpdate(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $prestasi->update(['status' => $request->status]);
        
        return redirect()->route('guru.prestasi.verifikasi')
            ->with('success', 'Prestasi berhasil diverifikasi.');
    }
}
