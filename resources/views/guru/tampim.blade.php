@extends('layouts.app')

@section('title', 'Tambah Pembina')

@section('content')
<h2>Tambah Pembina</h2>

@if($errors->any())
    <div style="color:red; background:#ffebee; padding:10px; margin-bottom:10px;">
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('guru.storeim') }}" method="POST">
    @csrf

    <label for="nip">NIP (username)</label><br>
    <input type="text" name="nip" id="nip" value="{{ old('nip') }}" required><br><br>

    <label for="password">Password (opsional)</label><br>
    <input type="password" name="password" id="password"><br><br>

    <label for="nama_pembina">Nama Pembina</label><br>
    <input type="text" name="nama_pembina" id="nama_pembina" value="{{ old('nama_pembina') }}" required><br><br>

    <button type="submit">Simpan</button>
</form>

<p><a href="{{ route('guru.dapim') }}">← Kembali</a></p>
@endsection