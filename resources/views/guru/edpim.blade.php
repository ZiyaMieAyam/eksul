{{-- filepath: resources/views/guru/edpim.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Data Pembina')

@section('content')
<h2>Edit Data Pembina</h2>

@if($errors->any())
    <div style="color:red; background:#ffebee; padding:10px; margin-bottom:10px;">
        <ul>
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('guru.updateim', $pembina->id_pembina) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="id_user">Pilih User (Username)</label><br>
    <select name="id_user" id="id_user" required>
        <option value="">-- Pilih User Pembina --</option>
        @foreach($users as $user)
            <option value="{{ $user->id_user }}" {{ $pembina->id_user == $user->id_user ? 'selected' : '' }}>
                {{ $user->username }}
            </option>
        @endforeach
    </select><br><br>

    <label for="nama_pembina">Nama Pembina</label><br>
    <input type="text" name="nama_pembina" id="nama_pembina" value="{{ old('nama_pembina', $pembina->nama_pembina) }}" required><br><br>

    <button type="submit">Update</button>
</form>

<p><a href="{{ route('guru.dapim') }}">← Kembali</a></p>
@endsection