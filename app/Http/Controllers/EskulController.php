<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eskul;
use App\Models\Pembina;

class EskulController extends Controller
{
    public function index()
    {
        // eager load pembina
        $data = Eskul::with('pembina')->get();
        return view('guru.daskul', compact('data'));
    }  

    public function create()
    {
        $pembinas = Pembina::all();
        return view('guru.tamskul', compact('pembinas'));
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'id_pembina'  => 'required|integer|exists:pembinas,id_pembina',
            'nama_eskul'  => 'required|string|max:50',
            'jadwal_eskul'=> 'required|string|max:50',
            'materi'      => 'nullable|string',
        ]);

        Eskul::create($validasi);
        return redirect()->route('eskul.index')->with('success', 'Eskul berhasil ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $eskul = Eskul::findOrFail($id);
        $pembinas = Pembina::all();
        return view('guru.edskul', compact('eskul', 'pembinas'));
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'id_pembina'  => 'required|integer|exists:pembinas,id_pembina',
            'nama_eskul'  => 'required|string|max:50',
            'jadwal_eskul'=> 'required|string|max:50',
            'materi'      => 'nullable|string',
        ]);

        $eskul = Eskul::findOrFail($id);
        $eskul->update($validasi);
        return redirect()->route('eskul.index')->with('success', 'Eskul berhasil diperbarui');
    }

    public function destroy($id)
    {
        $eskul = Eskul::findOrFail($id);
        $eskul->delete();
        return redirect()->route('eskul.index')->with('success', 'Eskul berhasil dihapus');
    }
}
