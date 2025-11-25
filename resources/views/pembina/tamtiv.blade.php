<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Aktivitas</title>
</head>
<body>

    <div class="container">
        <h1>Tambah Data Aktivitas</h1>

        @if($errors->any())
            <div style="color:red; background:#ffebee; padding:10px; margin-bottom:10px;">
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('aktivitas.store') }}" method="POST">
            @csrf

            <label for="id_pembina">Pembina</label><br>
            <select name="id_pembina" id="id_pembina" required>
                <option value="">-- Pilih Pembina --</option>
                @foreach($pembinas as $pembina)
                    <option value="{{ $pembina->id_pembina }}">{{ $pembina->nama_pembina }}</option>
                @endforeach
            </select><br><br>

            <label for="id_eskul">Eskul</label><br>
            <select name="id_eskul" id="id_eskul" required>
                <option value="">-- Pilih Eskul --</option>
                @foreach($eskuls as $eskul)
                    <option value="{{ $eskul->id_eskul }}">{{ $eskul->nama_eskul }}</option>
                @endforeach
            </select><br><br>

            <label for="tanggal_aktivitas">Tanggal</label><br>
            <input type="date" name="tanggal_aktivitas" id="tanggal_aktivitas" required><br><br>

            <label for="jam">Jam</label><br>
            <input type="time" name="jam" id="jam"><br><br>

            <label for="jenis_aktivitas">Jenis Aktivitas</label><br>
            <input type="text" name="jenis_aktivitas" id="jenis_aktivitas" required><br><br>

            <label for="tempat">Tempat</label><br>
            <input type="text" name="tempat" id="tempat"><br><br>

            <button type="submit">Simpan</button>
        </form>

        <a href="{{ route('aktivitas.index') }}">← Kembali ke Daftar Aktivitas</a>
    </div>

</body>
</html>
