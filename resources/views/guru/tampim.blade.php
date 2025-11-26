@extends('layouts.app')

@section('title', 'Tambah Data Pembina')

@section('content')
<h2>Tambah Data Pembina</h2>

<form action="{{ route('pembina.store') }}" method="POST">
    @csrf
    <label for="nip">NIP</label><br>
    <input type="text" name="nip" id="nip" required><br><br>

    <label for="nama_pembina">Nama Pembina</label><br>
    <input type="text" name="nama_pembina" id="nama_pembina" required><br><br>


    <button type="submit">Simpan</button>
</form>
 
<p><a href="{{ route('guru.dapim') }}">← Kembali</a></p>
@endsection