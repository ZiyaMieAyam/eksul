<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aktivitas;
use App\Models\Pembina;
use App\Models\Eskul;

class AktivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aktivitas = Aktivitas::with('pembina', 'eskul')->get();
        return view('pembina.dativ', compact('aktivitas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pembinas = Pembina::all();
        $eskuls = Eskul::all();
        return view('pembina.tamtiv', compact('pembinas', 'eskuls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pembina' => 'required|integer|exists:pembinas,id_pembina',
            'id_eskul' => 'required|integer|exists:eskuls,id_eskul',
            'tanggal_aktivitas' => 'required|date', // Ubah dari 'tanggal' menjadi 'tanggal_aktivitas'
            'jam' => 'nullable|date_format:H:i',
            'jenis_aktivitas' => 'required|string|max:100',
            'tempat' => 'nullable|string|max:100',
        ]);

        Aktivitas::create($validated);

        return redirect()->route('aktivitas.index')->with('success', 'Aktivitas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $aktivitas = Aktivitas::with('pembina', 'eskul')->findOrFail($id);
        return view('pembina.detiv', compact('aktivitas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $aktivitas = Aktivitas::findOrFail($id);
        $pembinas = Pembina::all();
        $eskuls = Eskul::all();
        return view('pembina.edtiv', compact('aktivitas', 'pembinas', 'eskuls'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_pembina' => 'required|integer',
            'id_eskul' => 'required|integer',
            'tanggal' => 'required|date',
            'jam' => 'nullable|date_format:H:i',
            'jenis_aktivitas' => 'required|string|max:100',
            'tempat' => 'nullable|string|max:255',
        ]);

        $aktivitas = Aktivitas::findOrFail($id);
        $aktivitas->update($request->all());

        return redirect()->route('aktivitas.index')->with('success', 'Aktivitas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aktivitas = Aktivitas::findOrFail($id);
        $aktivitas->delete();

        return redirect()->route('aktivitas.index')->with('success', 'Aktivitas berhasil dihapus.');
    }
}
