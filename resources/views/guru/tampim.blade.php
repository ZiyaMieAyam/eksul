@extends('layouts.app')

@section('title', 'Tambah Data Pembina')

@section('content')
<h2>Tambah Data Pembina</h2>

<form action="{{ route('pembina.store') }}" method="POST">
    @csrf

    <label for="id_user">Pilih User (NIP/username)</label><br>
    <select name="id_user" id="id_user" required>
        <option value="">-- Pilih User Pembina --</option>
        @foreach(\App\Models\User::where('role','pembina')->get() as $user)
            <option value="{{ $user->id_user }}">{{ $user->username }}</option>
        @endforeach
    </select><br><br>

    <label for="nama_pembina">Nama Pembina</label><br>
    <input type="text" name="nama_pembina" id="nama_pembina" required><br><br>

    <button type="submit">Simpan</button>
</form>

<p><a href="{{ route('guru.dapim') }}">← Kembali</a></p>
@endsection