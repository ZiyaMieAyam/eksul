{{-- filepath: resources/views/guru/edskul.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Data Eskul')

@section('content')
<h2>Edit Data Eskul</h2>

<form action="{{ route('eskul.update', $eskul->id_eskul) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="nama_eskul">Nama Eskul</label><br>
    <input type="text" name="nama_eskul" id="nama_eskul" value="{{ old('nama_eskul', $eskul->nama_eskul) }}" required><br><br>

    <label for="jadwal_eskul">Jadwal Eskul</label><br>
    <input type="text" name="jadwal_eskul" id="jadwal_eskul" value="{{ old('jadwal_eskul', $eskul->jadwal_eskul) }}" required><br><br>

    <label for="materi">Materi</label><br>
    <textarea name="materi" id="materi" rows="3">{{ old('materi', $eskul->materi) }}</textarea><br><br>

    <label for="id_pembina">Pembina</label><br>
    <select name="id_pembina" id="id_pembina" required>
        @foreach($pembinas as $pembina)
            <option value="{{ $pembina->id_pembina }}" {{ $eskul->id_pembina == $pembina->id_pembina ? 'selected' : '' }}>
                {{ $pembina->nama_pembina }}
            </option>
        @endforeach
    </select><br><br>

    <button type="submit">Update</button>
</form>

<p><a href="{{ route('eskul.index') }}">← Kembali</a></p>
@endsection