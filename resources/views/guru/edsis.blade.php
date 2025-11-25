{{-- filepath: resources/views/guru/edsis.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Data Siswa')

@section('content')
<h2>Edit Data Siswa</h2>

<form action="{{ route('siswa.update', $data->id_siswa) }}" method="POST">
    @csrfz
    @method('PUT')

    <label for="nama_siswa">Nama Siswa</label><br>
    <input type="text" name="nama_siswa" id="nama_siswa" value="{{ old('nama_siswa', $data->nama_siswa) }}" required><br><br>

    <label for="kelas">Kelas</label><br>
    <input type="text" name="kelas" id="kelas" value="{{ old('kelas', $data->kelas) }}" required><br><br>

    <label for="alamat">Alamat</label><br>
    <textarea name="alamat" id="alamat" rows="4">{{ old('alamat', $data->alamat) }}</textarea><br><br>

    <button type="submit">Update</button>
</form>

<p><a href="{{ route('siswa.index') }}">← Kembali</a></p>
@endsection