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

    <div class="container">
        <h1>Edit Data Aktivitas</h1>

            @if($errors->any())
                <div class="bg-red-300 p-3 mb-4 rounded border border-red-400 text-red-900 font-semibold">
                    {{ $errors->first() }}
                </div>
            @endif
            
            <form action="{{ route('aktivitas.update', $aktivitas->id_aktivitas) }}" method="POST">
                @csrf
                @method('PUT')

            <label for="id_pembina">Pembina</label><br>
            <select name="id_pembina" id="id_pembina" required>
                <option value="">-- Pilih Pembina --</option>
                @foreach($pembinas as $pembina)
                    <option value="{{ $pembina->id_pembina }}" {{ $aktivitas->id_pembina == $pembina->id_pembina ? 'selected' : '' }}>
                        {{ $pembina->nama_pembina }}
                    </option>
                @endforeach
            </select><br><br>

            <label for="id_eskul">Eskul</label><br>
            <select name="id_eskul" id="id_eskul" required>
                <option value="">-- Pilih Eskul --</option>
                @foreach($eskuls as $eskul)
                    <option value="{{ $eskul->id_eskul }}" {{ $aktivitas->id_eskul == $eskul->id_eskul ? 'selected' : '' }}>
                        {{ $eskul->nama_eskul }}
                    </option>
                @endforeach
            </select><br><br>

            <label for="tanggal_aktivitas">Tanggal</label><br>
            <input type="date" name="tanggal_aktivitas" id="tanggal_aktivitas" value="{{ $aktivitas->tanggal_aktivitas }}" required><br><br>

            <label for="jam">Jam</label><br>
            <input type="time" name="jam" id="jam" value="{{ $aktivitas->jam }}"><br><br>

            <label for="jenis_aktivitas">Jenis Aktivitas</label><br>
            <input type="text" name="jenis_aktivitas" id="jenis_aktivitas" value="{{ $aktivitas->jenis_aktivitas }}" required><br><br>

            <label for="tempat">Tempat</label><br>
            <input type="text" name="tempat" id="tempat" value="{{ $aktivitas->tempat }}"><br><br>

            <button type="submit">Perbarui</button>
        </form>

        <a href="{{ route('aktivitas.index') }}">← Kembali ke Daftar Aktivitas</a>
    </div>

</body>
</html>