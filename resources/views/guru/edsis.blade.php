@extends('layouts.app')

@section('title','Edit Data Siswa')
@section('content')
<h2>Edit Data Siswa</h2>

@if(session('success'))
    <div style="color:green">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div style="color:red">
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('guru.updatesis', $siswa->id_siswa) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="nis">NIS (username)</label><br>
    <input type="text" name="nis" id="nis" value="{{ old('nis', $siswa->user->username ?? '') }}" required><br><br>

    <label for="password">Password (kosong = tidak diubah)</label><br>
    <input type="password" name="password" id="password" placeholder="Kosong = tidak diubah"><br><br>

    <label for="nama_siswa">Nama Siswa</label><br>
    <input type="text" name="nama_siswa" id="nama_siswa" value="{{ old('nama_siswa', $siswa->nama_siswa) }}" required><br><br>

    <label for="kelas">Kelas</label><br>
    <input type="text" name="kelas" id="kelas" value="{{ old('kelas', $siswa->kelas) }}" required><br><br>

    <label for="id_eskul">Pilih Eskul</label><br>
    <select name="id_eskul" id="id_eskul">
        <option value="">-- Tidak memilih --</option>
        @foreach ($daftarEskul as $e)
            <option value="{{ $e->id_eskul }}" {{ $eskulTerpilih == $e->id_eskul ? 'selected' : '' }}>
                {{ $e->nama_eskul }}
            </option>
        @endforeach
    </select><br><br>

    <button type="submit">Update</button>
</form>
@endsection
