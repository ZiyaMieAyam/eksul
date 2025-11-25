<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestasi;
use App\Models\Siswa;
use App\Models\Eskul;
use Illuminate\Support\Str;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prestasi = Prestasi::with(['siswa', 'eskul'])->get();
        return view('pembina.dapres', compact('prestasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        // siswa: tampilkan eskul yang dia daftar (Diterima)
        if ($user->role === 'siswa') {
            $siswa = $user->siswa;
            if (!$siswa) {
                return redirect()->route('dashboard.siswa')->withErrors('Akun belum terdaftar sebagai siswa.');
            }
            $pendaftarans = $siswa->pendaftarans()->where('status', 'Diterima')->with('eskul')->get();
            return view('siswa.tampres', compact('pendaftarans'));
        }

        // pembina/guru: tampilkan form untuk memilih siswa + eskul
        if (in_array($user->role, ['pembina', 'guru'])) {
            $siswas = Siswa::all();
            $eskuls = Eskul::all();
            return view('pembina.tampres', compact('siswas', 'eskuls'));
        }

        // lainnya -> forbidden
        return redirect()->route('login')->withErrors('Akses tidak diizinkan.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'id_eskul' => 'required|exists:eskuls,id_eskul',
            'nama_prestasi' => 'required|string|max:100',
            'tanggal_diraih' => 'required|date',
            'tingkat' => 'required|string',
            // hanya terima PDF, max 4MB
            'bukti' => 'nullable|file|mimes:pdf|max:4096',
        ];

        if ($user->role !== 'siswa') {
            $rules['id_siswa'] = 'required|exists:siswas,id_siswa';
        }

        $validated = $request->validate($rules);

        $id_siswa = $user->role === 'siswa'
            ? ($user->siswa->id_siswa ?? null)
            : $validated['id_siswa'];

        if (!$id_siswa) {
            return back()->withErrors('Siswa tidak ditemukan.')->withInput();
        }

        $bukti = null;
        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $name = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.pdf';
            $bukti = $file->storeAs('prestasi', $name, 'public');
        }

        Prestasi::create([
            'id_siswa' => $id_siswa,
            'id_eskul' => $validated['id_eskul'],
            'nama_prestasi' => $validated['nama_prestasi'],
            'tanggal_diraih' => $validated['tanggal_diraih'],
            'tingkat' => $validated['tingkat'],
            'bukti' => $bukti,
            'status' => 'Pending',
        ]);

        if ($user->role === 'siswa') {
            return redirect()->route('dashboard.siswa')->with('success', 'Prestasi berhasil dikirim, menunggu verifikasi.');
        }

        return redirect()->route('pembina.prestasi.index')->with('success', 'Prestasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $prestasi = Prestasi::with(['siswa', 'eskul'])->findOrFail($id);
        return view('siswa.detail_prestasi', compact('prestasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $siswas = Siswa::all();
        $eskuls = Eskul::all();
        return view('siswa.edit_prestasi', compact('prestasi', 'siswas', 'eskuls'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_siswa' => 'required|integer|exists:siswas,id_siswa',
            'id_eskul' => 'required|integer|exists:eskuls,id_eskul',
            'nama_prestasi' => 'required|string|max:100',
            'tanggal_diraih' => 'required|date',
            'tingkat' => 'required|string|max:50',
            'bukti' => 'nullable|string|max:100',
            'status' => 'required|string|max:50',
        ]);

        $prestasi = Prestasi::findOrFail($id);
        $prestasi->update($validated);

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $prestasi->delete();

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil dihapus.');
    }
}
