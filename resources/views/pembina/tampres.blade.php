<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Input Prestasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .input-style {
            border-radius: 4px;
            padding: 8px 12px;
            width: 100%;
            background-color: white;
            color: black;
            border: 1px solid #ccc;
        }
        .form-bg { background-color:#a00b14; }
    </style>
</head>
<body class="bg-gray-100 font-sans">

    <div class="min-h-screen p-8 flex flex-col items-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 max-w-2xl w-full">Input Prestasi</h1>

        <div class="p-8 max-w-2xl w-full text-white rounded-lg shadow-xl form-bg">
            <h2 class="text-xl font-semibold mb-6">Form Prestasi</h2>

            @if($errors->any())
                <div class="text-red-700 bg-red-100 p-3 mb-4 rounded border border-red-200 text-black">
                    <ul>
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('prestasi.store') }}" enctype="multipart/form-data" class="space-y-4 text-black">
                @csrf

                @if(Auth::user() && Auth::user()->role === 'siswa')
                    <input type="hidden" name="id_siswa" value="{{ optional(Auth::user()->siswa)->id_siswa }}">

                    <div>
                        <label class="block mb-1">Pilih Eskul</label>
                        <select name="id_eskul" required class="input-style">
                            <option value="">-- Pilih Eskul --</option>
                            @foreach($pendaftarans ?? [] as $p)
                                @if(isset($p->eskul))
                                    <option value="{{ $p->eskul->id_eskul }}">{{ $p->eskul->nama_eskul }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                @else
                    <div>
                        <label class="block mb-1">Pilih Siswa</label>
                        <select name="id_siswa" required class="input-style">
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($siswas ?? [] as $s)
                                <option value="{{ $s->id_siswa }}">{{ $s->nama_siswa }} ({{ $s->kelas }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1">Pilih Eskul</label>
                        <select name="id_eskul" required class="input-style">
                            <option value="">-- Pilih Eskul --</option>
                            @foreach($eskuls ?? [] as $e)
                                <option value="{{ $e->id_eskul }}">{{ $e->nama_eskul }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div>
                    <label class="block mb-1">Nama Prestasi</label>
                    <input type="text" name="nama_prestasi" value="{{ old('nama_prestasi') }}" required class="input-style">
                </div>

                <div>
                    <label class="block mb-1">Tanggal Diraih</label>
                    <input type="date" name="tanggal_diraih" value="{{ old('tanggal_diraih') }}" required class="input-style">
                </div>

                <div>
                    <label class="block mb-1">Tingkat</label>
                    <select name="tingkat" required class="input-style">
                        <option value="">-- Pilih Tingkat --</option>
                        <option value="Sekolah" {{ old('tingkat')=='Sekolah' ? 'selected':'' }}>Sekolah</option>
                        <option value="Kota" {{ old('tingkat')=='Kota' ? 'selected':'' }}>Kota</option>
                        <option value="Provinsi" {{ old('tingkat')=='Provinsi' ? 'selected':'' }}>Provinsi</option>
                        <option value="Nasional" {{ old('tingkat')=='Nasional' ? 'selected':'' }}>Nasional</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-1">Bukti (PDF)</label>
                    <input type="file" name="bukti" accept=".pdf" class="input-style">
                </div>

                <div class="flex justify-end">
                    <button type="submit" onclick="this.disabled=true; this.form.submit();" class="bg-black text-white px-6 py-2 rounded-md font-semibold hover:bg-gray-800 transition">
                        Kirim Prestasi
                    </button>
                </div>
            </form>

            <p class="mt-4">
                <a href="{{ route(Auth::user() && Auth::user()->role === 'pembina' ? 'pembina.prestasi.index' : 'dashboard.siswa') }}" class="text-white underline">← Kembali</a>
            </p>
        </div>
    </div>

</body>
</html>