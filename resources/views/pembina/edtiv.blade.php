<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Aktivitas</title>
</head>
<body>

    <div class="container">
        @extends('layouts.app')

        @section('title', 'Edit Data Aktivitas')

        @section('content')
        <h2>Edit Data Aktivitas</h2>

        @if($errors->any())
            <div style="color:red; background:#ffebee; padding:10px; margin-bottom:10px;">
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('aktivitas.update', $aktivitas->id_aktivitas) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Hidden fields untuk ID -->
            <input type="hidden" name="id_pembina" value="{{ $aktivitas->id_pembina }}">
            <input type="hidden" name="id_eskul" value="{{ $aktivitas->id_eskul }}">

            <label for="pembina">Pembina</label><br>
            <input type="text" id="pembina" value="{{ $aktivitas->pembina->nama_pembina ?? '-' }}" disabled><br><br>

            <label for="eskul">Eskul</label><br>
            <input type="text" id="eskul" value="{{ $aktivitas->eskul->nama_eskul ?? '-' }}" disabled><br><br>

            <label for="tanggal">Tanggal</label><br>
            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $aktivitas->tanggal) }}" required><br><br>

            <label for="jam">Jam (HH:MM)</label><br>
            <input type="text" name="jam" id="jam" placeholder="10:40" value="{{ old('jam', $aktivitas->jam) }}" required><br><br>

            <label for="jenis_aktivitas">Jenis Aktivitas</label><br>
            <input type="text" name="jenis_aktivitas" id="jenis_aktivitas" value="{{ old('jenis_aktivitas', $aktivitas->jenis_aktivitas) }}" required><br><br>

            <label for="tempat">Tempat</label><br>
            <input type="text" name="tempat" id="tempat" value="{{ old('tempat', $aktivitas->tempat) }}" required><br><br>

            <button type="submit">Perbarui</button>
        </form>

        <p><a href="{{ route('aktivitas.index') }}">← Kembali ke Daftar Aktivitas</a></p>
        @endsection
    </div>

</body>
</html>