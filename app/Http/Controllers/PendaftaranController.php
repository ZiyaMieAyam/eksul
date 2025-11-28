<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\Eskul;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PendaftaranController extends Controller
{
    /**
     * Tampilkan riwayat pendaftaran siswa yang login.
     */
    public function index()
    {
        $eskuls = Eskul::all();
        return view('pembina.eskul_list', compact('eskuls'));
    }

    /**
     * Form daftar eskul (dafes.blade.php).
     */
    public function create()
    {
        $siswa = auth()->user()->siswa;
        $eskuls = Eskul::all();
        return view('siswa.dafes', compact('siswa', 'eskuls'));
    }

    /**
     * Simpan pendaftaran baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_eskul' => 'required|exists:eskuls,id_eskul',
        ]);
        $siswa = auth()->user()->siswa;
        Pendaftaran::create([
            'id_siswa' => $siswa->id_siswa,
            'id_eskul' => $request->id_eskul,
            'tanggal_daftar' => now(),
            'status' => 'Pending', // ubah dari 'Menunggu' ke 'Pending'
        ]);
        return redirect()->route('prosis')->with('success', 'Pendaftaran berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pendaftaran = Pendaftaran::with(['siswa', 'eskul'])->findOrFail($id);
        return view('siswa.detail_pendaftaran', compact('pendaftaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $siswas = Siswa::all();
        $eskuls = Eskul::all();
        return view('siswa.edit_pendaftaran', compact('pendaftaran', 'siswas', 'eskuls'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Jika hanya update status (verifikasi), validasi cukup status saja
        if ($request->has('status') && count($request->all()) == 3) { // status, _token, _method
            $request->validate([
                'status' => 'required|in:Pending,Diterima,Ditolak',
            ]);
            $pendaftaran = Pendaftaran::findOrFail($id);
            $pendaftaran->update(['status' => $request->status]);
            return redirect()->route('pendaftaran.index')->with('success', 'Status pendaftaran berhasil diperbarui.');
        }

        // Jika update seluruh data (edit form), validasi lengkap
        $validated = $request->validate([
            'id_siswa' => 'required|integer|exists:siswas,id_siswa',
            'id_eskul' => 'required|integer|exists:eskuls,id_eskul',
            'tanggal_daftar' => 'required|date',
            'status' => 'required|in:Pending,Diterima,Ditolak',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update($validated);

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil dihapus.');
    }

    // list eskul untuk dipilih
    public function indexEskul()
    {
        $eskuls = Eskul::all();
        return view('pembina.eskul_list', compact('eskuls'));
    }

    // detail pendaftar untuk satu eskul
    public function showEskul($id_eskul)
    {
        $eskul = Eskul::findOrFail($id_eskul);
        $pendaftarans = Pendaftaran::with('siswa')
            ->where('id_eskul', $id_eskul)
            ->orderBy('tanggal_daftar', 'asc')
            ->get();

        return view('pembina.dapen', compact('eskul', 'pendaftarans'));
    }

    // update status (Terima / Ditolak)
    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Diterima,Ditolak,Pending',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->status = $request->status;
        $pendaftaran->save();

        return back()->with('success', 'Status pendaftaran berhasil diubah menjadi: ' . $request->status);
    }
}
