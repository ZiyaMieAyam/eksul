<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Aktivitas</title>
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
    </style>
</head>
<body class="bg-gray-100 font-sans">

    <div class="min-h-screen p-8 flex flex-col items-center">
        
        <h1 class="text-3xl font-bold text-gray-800 mb-8 max-w-2xl w-full">Tambah Data Aktivitas</h1>

        <div class="form-bg p-8 max-w-2xl w-full text-white rounded-lg shadow-xl">
            <h2 class="text-xl font-semibold mb-6">Data Aktivitas</h2>

            @if($errors->any())
                <div class="text-red-700 bg-red-100 p-3 mb-4 rounded border border-red-200">
                    <ul>
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('aktivitas.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="id_pembina" class="block text-sm font-medium mb-1">Pembina</label>
                    <select name="id_pembina" id="id_pembina" class="input-style" required>
                        <option value="">-- Pilih Pembina --</option>
                        @foreach($pembinas as $pembina)
                            <option value="{{ $pembina->id_pembina }}">{{ $pembina->nama_pembina }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="id_eskul" class="block text-sm font-medium mb-1">Eskul</label>
                    <select name="id_eskul" id="id_eskul" class="input-style" required>
                        <option value="">-- Pilih Eskul --</option>
                        @foreach($eskuls as $eskul)
                            <option value="{{ $eskul->id_eskul }}">{{ $eskul->nama_eskul }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="tanggal_aktivitas" class="block text-sm font-medium mb-1">Tanggal</label>
                    <input type="date" name="tanggal_aktivitas" id="tanggal_aktivitas" class="input-style" required>
                </div>

                <div class="mb-4">
                    <label for="jam" class="block text-sm font-medium mb-1">Jam</label>
                    <input type="time" name="jam" id="jam" class="input-style">
                    </div>

                <div class="mb-4">
                    <label for="jenis_aktivitas" class="block text-sm font-medium mb-1">Kegiatan</label>
                    <input type="text" name="jenis_aktivitas" id="jenis_aktivitas" class="input-style" required>
                </div>

                <div class="mb-6">
                    <label for="tempat" class="block text-sm font-medium mb-1">Tempat</label>
                    <input type="text" name="tempat" id="tempat" class="input-style">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-black text-white px-6 py-2 rounded-md font-semibold hover:bg-gray-800 transition duration-150">
                        Submit
                    </button>
                </div>
            </form>

        </div>
        
        <div class="mt-4 max-w-2xl w-full">
            <a href="{{ route('aktivitas.index') }}" class="text-blue-600 hover:text-blue-800">← Kembali ke Daftar Aktivitas</a>
        </div>

    </div>

</body>
</html>