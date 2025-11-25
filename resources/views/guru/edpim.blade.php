{{-- filepath: resources/views/guru/edpim.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Data Pembina')

@section('content')
<h2>Edit Data Pembina</h2>

<form action="{{ route('pembina.update', $pembina->id_pembina) }}" method="POST">
    @zzz
    @method('PUT')

    <label for="nama_pembina">Nama Pembina</label><br>
    <input type="text" name="nama_pembina" id="nama_pembina" value="{{ old('nama_pembina', $pembina->nama_pembina) }}" required><br><br>

    <button type="submit">Update</button>
</form>

<p><a href="{{ route('pembina.index') }}">← Kembali</a></p>
@endsection