<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kehadiran;
use App\Models\Siswa;
use App\Models\Eskul;

class KehadiranController extends Controller
{
    /**
     * Tampilkan data kehadiran
     */
    public function index()
    {
        $eskuls = Eskul::all(); // atau sesuai kebutuhan
        return view('pembina.datab', compact('eskuls'));
    }

    /**
     * Form absensi massal
     */
    public function create()
    {
        $siswas = Siswa::with('kelas')->get();
        $eskuls = Eskul::all();

        return view('pembina.absis', compact('siswas', 'eskuls'));
    }

    /**
     * Simpan absensi massal
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_eskul' => 'required|integer',
            'status' => 'required|array',
            'tanggal' => 'nullable|date', // terima tanggal jika dikirim
        ]);

        // gunakan tanggal yang diberikan atau default ke hari ini (format Y-m-d)
        $tanggal = $request->input('tanggal', date('Y-m-d'));

        foreach ($request->status as $id_siswa => $status) {
            Kehadiran::create([
                'id_siswa' => $id_siswa,
                'id_eskul' => $request->id_eskul,
                'status' => $status,
                'poin' => 100,
                'tanggal' => $tanggal,
            ]);
        }

        return redirect()->route('kehadiran.index')->with('success', 'Absensi berhasil disimpan.');
    }

    /**
     * Tampilkan detail absensi
     */
    public function show($id)
    {
        $item = Kehadiran::with(['siswa', 'eskul'])->findOrFail($id);
        return view('pembina.absis', compact('item'));
    }

    /**
     * Form edit absensi
     */
    public function edit($id)
    {
        $item   = Kehadiran::findOrFail($id);
        $siswas = Siswa::all();
        $eskuls = Eskul::all();

        return view('pembina.editabsen', compact('item', 'siswas', 'eskuls'));
    }

    /**
     * Update absensi
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_siswa' => 'required|integer|exists:siswas,id_siswa',
            'id_eskul' => 'required|integer|exists:eskuls,id_eskul',
            'tanggal'  => 'required|date',
            'status'   => 'required|string|max:50',
            'poin'     => 'nullable|integer',
        ]);

        $item = Kehadiran::findOrFail($id);
        $item->update($validated);

        return redirect()->route('kehadiran.index')
            ->with('success', 'Kehadiran berhasil diperbarui.');
    }

    /**
     * Hapus absensi
     */
    public function destroy($id)
    {
        $item = Kehadiran::findOrFail($id);
        $item->delete();

        return redirect()->route('kehadiran.index')
            ->with('success', 'Kehadiran berhasil dihapus.');
    }

    /**
     * Tampilkan detail absensi per eskul
     */
    public function detail($id_eskul)
    {
        $eskuls = Eskul::findOrFail($id_eskul);
        // Ambil siswa yang terdaftar di eskul ini (via pendaftaran)
        $siswas = Siswa::whereHas('pendaftarans', function($q) use ($id_eskul) {
            $q->where('id_eskul', $id_eskul)->where('status', 'Diterima');
        })->get();

        return view('pembina.absis', compact('eskuls', 'siswas'));
    }
}
