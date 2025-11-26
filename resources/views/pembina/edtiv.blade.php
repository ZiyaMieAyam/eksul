<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Aktivitas</title>
    {{-- Memuat Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Gaya kustom untuk warna form */
        .form-bg {
            background-color: #a00b14; /* Merah gelap untuk kotak form */
        }
        .input-style {
            /* Gaya input untuk input dan select */
            border-radius: 4px;
            padding: 8px 12px;
            width: 100%;
            background-color: white; 
            color: black;
            border: 1px solid #ccc;
        }
        .input-disabled {
            /* Gaya khusus untuk input yang dinonaktifkan */
            background-color: #f0f0f0; 
            color: #555;
            cursor: not-allowed;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">

    {{-- KONTEN UTAMA DIMULAI DI SINI --}}
    <div class="min-h-screen p-8 flex flex-col items-center">
        
        <h1 class="text-3xl font-bold text-gray-800 mb-8 max-w-2xl w-full">Edit Data Aktivitas</h1>

        <div class="form-bg p-8 max-w-2xl w-full text-white rounded-lg shadow-xl">
            <h2 class="text-xl font-semibold mb-6">Data Aktivitas</h2>

            @if($errors->any())
                <div class="bg-red-300 p-3 mb-4 rounded border border-red-400 text-red-900 font-semibold">
                    {{ $errors->first() }}
                </div>
            @endif
            
            <form action="{{ route('aktivitas.update', $aktivitas->id_aktivitas) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="id_pembina" value="{{ $aktivitas->id_pembina }}">
                <input type="hidden" name="id_eskul" value="{{ $aktivitas->id_eskul }}">
                
                <div class="mb-4">
                    <label for="pembina" class="block text-sm font-medium mb-1">Pembina</label>
                    <input type="text" id="pembina" class="input-style input-disabled" 
                        value="{{ $aktivitas->pembina->nama_pembina ?? '-' }}" disabled>
                </div>

                <div class="mb-4">
                    <label for="eskul" class="block text-sm font-medium mb-1">Eskul</label>
                    <input type="text" id="eskul" class="input-style input-disabled" 
                        value="{{ $aktivitas->eskul->nama_eskul ?? '-' }}" disabled>
                </div>

                <div class="mb-4">
                    <label for="tanggal" class="block text-sm font-medium mb-1">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="input-style" required
                        value="{{ old('tanggal', \Carbon\Carbon::parse($aktivitas->tanggal)->format('Y-m-d')) }}">
                </div>

                <div class="mb-4">
                    <label for="jam" class="block text-sm font-medium mb-1">Jam</label>
                    {{-- Menggunakan type="text" untuk mendukung rentang waktu seperti gambar awal --}}
                    <input type="time" name="jam" id="jam" placeholder="HH:MM atau HH:MM-HH:MM" class="input-style" 
                        value="{{ old('jam', $aktivitas->jam) }}" required>
                </div>

                <div class="mb-4">
                    <label for="jenis_aktivitas" class="block text-sm font-medium mb-1">Kegiatan</label>
                    <input type="text" name="jenis_aktivitas" id="jenis_aktivitas" class="input-style" required
                        value="{{ old('jenis_aktivitas', $aktivitas->jenis_aktivitas) }}">
                </div>

                <div class="mb-6">
                    <label for="tempat" class="block text-sm font-medium mb-1">Tempat</label>
                    <input type="text" name="tempat" id="tempat" class="input-style" required
                        value="{{ old('tempat', $aktivitas->tempat) }}">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-black text-white px-6 py-2 rounded-md font-semibold hover:bg-gray-800 transition duration-150">
                        Submit
                    </button>
                </div>
            </form>

        </div>
        
        <div class="mt-4 max-w-2xl w-full">
            <p><a href="{{ route('aktivitas.index') }}" class="text-blue-600 hover:text-blue-800">← Kembali ke Daftar Aktivitas</a></p>
        </div>

    </div>

</body>
</html>