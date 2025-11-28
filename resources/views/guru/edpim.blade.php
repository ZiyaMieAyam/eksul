{{-- filepath: resources/views/guru/edpim.blade.php --}}
@extends('layouts.app')
@section('title','Edit Pembina')
@section('content')
<h2>Edit Pembina</h2>
@if($errors->any())<div style="color:red"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif

<form action="{{ route('guru.updateim', $pembina->id_pembina) }}" method="POST">
    @csrf @method('PUT')

    <label>NIP (username)</label><br>
    <input type="text" name="nip" value="{{ old('nip', optional($pembina->user)->username) }}"><br><br>

    <label>Ubah Password (kosong = tidak diubah)</label><br>
    <input type="password" name="password"><br><br>

    <label>Nama Pembina</label><br>
    <input type="text" name="nama_pembina" value="{{ old('nama_pembina', $pembina->nama_pembina) }}" required><br><br>

    <button type="submit">Update</button>
</form>
@endsection