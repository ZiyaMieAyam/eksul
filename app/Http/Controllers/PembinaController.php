<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembina;
use App\Models\Aktivitas;
use App\Models\User;
use App\Models\Kehadiran;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\Prestasi;
use App\Models\Eskul;

class PembinaController extends Controller
{
    // dashboard pembina
    public function dashboard()
    {
        // Total SEMUA siswa dari tabel siswas (tanpa filter apapun)
        $totalSiswa = Siswa::count();

        // Statistik semua eskul dengan jumlah pendaftar
        $eskulStats = Eskul::withCount('pendaftaran')->get();

        return view('dashboard.dashboardpembina', compact(
            'totalSiswa',
            'eskulStats'
        ));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembinas = Pembina::with('user')->get();
        return view('pembina.dapim', compact('pembinas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'pembina')->get();
        return view('pembina.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'integer|exists:userss,id_user', // fix here
            'nama_pembina' => 'required|string|max:50',
        ]);

        Pembina::create($validated);
        return redirect()->route('pembina.index')->with('success', 'Pembina berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pembina = Pembina::with('user', 'aktivitas', 'eskuls')->findOrFail($id);
        return view('pembina.show', compact('pembina'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pembina = Pembina::findOrFail($id);
        $users = User::where('role', 'pembina')->get();
        return view('pembina.edit', compact('pembina', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_user' => 'required|integer|exists:userss,id_user', // fix here
            'nama_pembina' => 'required|string|max:50',
        ]);

        $pembina = Pembina::findOrFail($id);
        $pembina->update($validated);

        return redirect()->route('pembina.index')->with('success', 'Pembina berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pembina = Pembina::findOrFail($id);
        $pembina->delete();

        return redirect()->route('pembina.index')->with('success', 'Pembina berhasil dihapus.');
    }

    public function prestasiIndex()
    {
        $prestasi = Prestasi::with(['siswa', 'eskul'])->get();
        return view('pembina.dapres', compact('prestasi'));
    }
}