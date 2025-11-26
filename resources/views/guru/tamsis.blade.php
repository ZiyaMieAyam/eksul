<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
</head>
<body>

    <div class="container">
        @extends('layouts.app')

        @section('title', 'Tambah Data Siswa')

        @section('content')
        <h2>Tambah Data Siswa</h2>

        @if($errors->any())
            <div style="color:red; background:#ffebee; padding:10px; margin-bottom:10px;">
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('guru.storesis') }}" method="POST">
            @csrf

            <label for="id_user">Pilih User (opsional)</label><br>
            <select name="id_user" id="id_user">
                <option value="">-- Pilih User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id_user }}">{{ $user->id_user }} - {{ $user->username }}</option>
                @endforeach
            </select><br><br>

            <label for="nama_siswa">Nama Siswa</label><br>
            <input type="text" name="nama_siswa" id="nama_siswa" value="{{ old('nama_siswa') }}" required><br><br>

            <label for="kelas">Kelas</label><br>
            <input type="text" name="kelas" id="kelas" value="{{ old('kelas') }}" required><br><br>

            <label for="alamat">Alamat</label><br>
            <textarea name="alamat" id="alamat" rows="4">{{ old('alamat') }}</textarea><br><br>

            <label for="id_eskul">Pilih Eskul (opsional)</label><br>
            <select name="id_eskul" id="id_eskul">
                <option value="">-- Tidak memilih --</option>
                @foreach($eskuls as $eskul)
                    <option value="{{ $eskul->id_eskul }}">{{ $eskul->nama_eskul }}</option>
                @endforeach
            </select><br><br>

            <button type="submit">Simpan</button>
        </form>

        <p><a href="{{ route('siswa.index') }}">← Kembali</a></p>
        @endsection
    </div>

</body>
</html>
