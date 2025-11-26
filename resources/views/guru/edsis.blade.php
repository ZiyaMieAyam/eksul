{{-- filepath: resources/views/guru/edsis.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Data Siswa')

@section('content')
<h2>Edit Data Siswa</h2>

@if($errors->any())
    <div style="color:red; background:#ffebee; padding:10px; margin-bottom:10px;">
        <ul>
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('guru.updatesis', $data->id_siswa) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="id_user">Pilih User (opsional)</label><br>
    <input type="text" name="id_user" id="id_user" value="{{ old('id_user', $data->id_user) }}"><br><br>

    <label for="nama_siswa">Nama Siswa</label><br>
    <input type="text" name="nama_siswa" id="nama_siswa" value="{{ old('nama_siswa', $data->nama_siswa) }}" required><br><br>

    <label for="kelas">Kelas</label><br>
    <input type="text" name="kelas" id="kelas" value="{{ old('kelas', $data->kelas) }}" required><br><br>

    <label for="alamat">Alamat</label><br>
    <textarea name="alamat" id="alamat" rows="4">{{ old('alamat', $data->alamat) }}</textarea><br><br>

    <label for="id_eskul">Pilih Eskul</label><br>
    <select name="id_eskul" id="id_eskul">
        <option value="">-- Tidak memilih --</option>
        @foreach($eskuls as $eskul)
            <option value="{{ $eskul->id_eskul }}" {{ (isset($selectedEskulId) && $selectedEskulId == $eskul->id_eskul) ? 'selected' : '' }}>
                {{ $eskul->nama_eskul }}
            </option>
        @endforeach
    </select><br><br>

    <button type="submit">Update</button>
</form>

<p><a href="{{ route('siswa.index') }}">← Kembali</a></p>
@endsection