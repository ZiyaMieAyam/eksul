@extends('layouts.app')

@section('title', 'Tambah Data Pembina')

@section('content')
<h2>Tambah Data Pembina</h2>

@if($errors->any())
    <div style="color:red; background:#ffebee; padding:10px; margin-bottom:10px;">
        <ul>
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('guru.storeim') }}" method="POST">
    @csrf

    <label for="id_user">Pilih User Pembina</label><br>
    <select name="id_user" id="id_user" required>
        <option value="">-- Pilih User --</option>
        @foreach($users as $user)
            <option value="{{ $user->id_user }}">ID {{ $user->id_user }} - {{ $user->username }}</option>
        @endforeach
    </select><br><br>

    <label for="nama_pembina">Nama Pembina</label><br>
    <input type="text" name="nama_pembina" id="nama_pembina" required><br><br>

    <button type="submit">Simpan</button>
</form>

<p><a href="{{ route('guru.dapim') }}">← Kembali</a></p>
@endsection