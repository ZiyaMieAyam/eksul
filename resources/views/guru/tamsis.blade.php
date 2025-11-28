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
            <div class="container">
                <h2>Tambah Data Siswa</h2>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('guru.storesis') }}" method="POST">
                    @csrf
                    <label for="nis">NIS (username)</label><br>
                    <input type="text" name="nis" id="nis" value="{{ old('nis') }}" required><br><br>

                    <label for="password">Password (opsional)</label><br>
                    <input type="password" name="password" id="password"><br><br>

                    <label for="nama_siswa">Nama Siswa</label><br>
                    <input type="text" name="nama_siswa" id="nama_siswa" value="{{ old('nama_siswa') }}" required><br><br>

                    <label for="kelas">Kelas</label><br>
                    <input type="text" name="kelas" id="kelas" value="{{ old('kelas') }}" required><br><br>

                    <label for="alamat">Alamat</label><br>
                    <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" required><br><br>

                    <label for="id_eskul">Pilih Eskul</label><br>
                    <select name="id_eskul" id="id_eskul">
                        <option value="">-- Tidak memilih --</option>
                        @foreach($eskuls as $e)
                            <option value="{{ $e->id_eskul }}">{{ $e->nama_eskul }}</option>
                        @endforeach
                    </select><br><br>

                    <button type="submit">Simpan</button>
                </form>
            </div>
        @endsection
    </div>

</body>
</html>
