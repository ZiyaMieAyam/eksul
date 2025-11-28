<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Eskul;
use App\Models\Siswa;
use App\Models\Pembina;
use App\Models\User;
use App\Models\Pendaftaran;
use App\Models\Kehadiran;
use App\Models\Prestasi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function dashboard()
    {
        $totalSiswa = Siswa::count();
        $eskulStats = Eskul::withCount(['pendaftaran' => function($q) {
            $q->where('status', 'Diterima');
        }])->get();
        return view('dashboard.dashboardguru', compact('totalSiswa', 'eskulStats'));
    }

    public function index()
    {
        $data = Siswa::all();
        return view('guru.dasis', compact('data'));
    }

    public function create()
    {
        return view('guru.tampim');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jabatan' => 'required|string|max:25',
        ]);
        Guru::create($validated);
        return redirect()->route('guru.index')->with('success', 'Guru berhasil ditambahkan.');
    }

    public function show($id)
    {
        $guru = Guru::with('user')->findOrFail($id);
        return view('guru.show', compact('guru'));
    }

    public function edit($id)
    {
        $data = Siswa::findOrFail($id);
        return view('guru.edsis', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jabatan' => 'required|string|max:25',
        ]);
        $guru = Guru::findOrFail($id);
        $guru->update($validated);
        return redirect()->route('guru.index')->with('success', 'Guru berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();
        return redirect()->route('guru.index')->with('success', 'Guru berhasil dihapus.');
    }

    public function absensi()
    {
        $eskuls = Eskul::all();
        return view('guru.datab', compact('eskuls'));
    }

    public function absensiDetail($id_eskul)
    {
        $tanggal = request('tanggal', date('Y-m-d'));
        $eskul = Eskul::findOrFail($id_eskul);

        // ambil kehadiran untuk tanggal tertentu
        $kehadirans = \App\Models\Kehadiran::with('siswa')
            ->where('id_eskul', $id_eskul)
            ->where('tanggal', $tanggal)
            ->orderBy('id_siswa', 'asc')
            ->get();

        return view('guru.absis', compact('eskul', 'kehadirans', 'tanggal'));
    }

    public function dapim()
    {
        $pembinas = Pembina::with('user')->get();
        return view('guru.dapim', compact('pembinas'));
    }

    public function dasis()
    {
        // eager-load pendaftarans + eskul
        $data = Siswa::with(['user', 'pendaftarans.eskul'])->get();
        return view('guru.dasis', compact('data'));
    }

    public function tamsis()
    {
        $users = User::where('role', 'siswa')->get();
        $eskuls = Eskul::all();
        return view('guru.tamsis', compact('users', 'eskuls'));
    }

    public function storesis(Request $request)
    {
        $request->validate([
            'nis'         => 'required|string|unique:userss,username',
            'password'    => 'nullable|string|min:4',
            'nama_siswa'  => 'required|string|max:100',
            'kelas'       => 'required|string|max:20',
            'alamat'      => 'nullable|string',
            'id_eskul'    => 'nullable|integer|exists:eskuls,id_eskul',
        ]);

        DB::transaction(function () use ($request) {
            $plain = $request->password ?: $request->nis;

            // buat user login
            $user = User::create([
                'username' => $request->nis,
                'password' => Hash::make($plain),
                'role'     => 'siswa',
            ]);

            // buat data siswa dan kaitkan id_user
            $siswa = new Siswa();
            $siswa->id_user    = $user->id_user;
            $siswa->nama_siswa = $request->nama_siswa;
            $siswa->kelas      = $request->kelas;
            $siswa->alamat     = $request->alamat ?? '';
            $siswa->save();

            // jika pilih eskul, buat pendaftaran langsung Diterima
            if ($request->filled('id_eskul')) {
                Pendaftaran::create([
                    'id_siswa'      => $siswa->id_siswa,
                    'id_eskul'      => $request->id_eskul,
                    'tanggal_daftar'=> now()->toDateString(),
                    'status'        => 'Diterima',
                ]);
            }
        });

        return redirect()->route('siswa.index')->with('success', 'Siswa dan akun berhasil dibuat.');
    }

    public function edsis($id)
    {
        $siswa = Siswa::with('pendaftarans')->findOrFail($id);
        $eskuls = Eskul::all();
        // ambil eskul yang berstatus Diterima jika ada
        $selectedEskul = $data->pendaftarans->where('status', 'Diterima')->first();
        $selectedEskulId = $selectedEskul->id_eskul ?? null;
        return view('guru.edsis', compact('siswa', 'eskuls', 'selectedEskulId'));
    }

    public function updatesis(Request $request, $id)
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

        // gunakan coalese() supaya alamat tidak null
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

    public function destroyis($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }

    public function prestasiVerifikasi()
    {
        // Ambil hanya prestasi yang belum diverifikasi (status = Pending)
        $prestasis = Prestasi::with(['siswa', 'eskul'])
            ->where('status', 'Pending')
            ->get();

        return view('guru.veripres', compact('prestasis'));
    }

    /**
     * Update status prestasi (verifikasi oleh guru).
     */
    public function prestasiUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Diverifikasi,Ditolak',
        ]);

        $prestasi = Prestasi::findOrFail($id);
        $prestasi->status = $validated['status'];
        $prestasi->save();

        return redirect()->back()->with('success', 'Status prestasi berhasil diperbarui.');
    }

    // PEMBINA CRUD - TAMPIM (Tambah Pembina)
    public function tampim()
    {
        $users = User::where('role', 'pembina')->get();
        return view('guru.tampim', compact('users'));
    }

    // PEMBINA CRUD - STOREIM (Simpan Pembina)
    public function storeim(Request $request)
    {
        $request->validate([
            'nip'           => 'required|string|unique:userss,username',
            'password'      => 'nullable|string|min:4',
            'nama_pembina'  => 'required|string|max:100',
        ]);

        DB::transaction(function () use ($request) {
            $plain = $request->password ?: $request->nip;

            // buat user untuk pembina
            $user = User::create([
                'username' => $request->nip,
                'password' => Hash::make($plain),
                'role'     => 'pembina',
            ]);

            // buat data pembina
            Pembina::create([
                'id_user'      => $user->id_user,
                'nama_pembina' => $request->nama_pembina,
            ]);
        });

        return redirect()->route('guru.dapim')->with('success', 'Pembina dan akun berhasil dibuat.');
    }

    // PEMBINA CRUD - EDPIM (Edit Pembina)
    public function edpim($id)
    {
        $pembina = Pembina::findOrFail($id);
        $users = User::where('role', 'pembina')->get();
        return view('guru.edpim', compact('pembina', 'users'));
    }

    // PEMBINA CRUD - UPDATEIM (Update Pembina)
    public function updateim(Request $request, $id)
    {
        $validated = $request->validate([
            'id_user' => 'required|integer|exists:userss,id_user',
            'nama_pembina' => 'required|string|max:50',
        ]);

        $pembina = Pembina::findOrFail($id);
        $pembina->update($validated);
        return redirect()->route('guru.dapim')->with('success', 'Pembina berhasil diupdate');
    }

    // PEMBINA CRUD - DESTROYIM (Hapus Pembina)
    public function destroyim($id)
    {
        $pembina = Pembina::findOrFail($id);
        $pembina->delete();
        return redirect()->route('guru.dapim')->with('success', 'Pembina berhasil dihapus');
    }
}
