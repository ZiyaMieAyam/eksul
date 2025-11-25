<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @extends('layouts.app')

@section('title', 'Tambah Data Eskul')

@section('content')
<h2>Tambah Data Eskul</h2>

<form action="{{ route('eskul.store') }}" method="POST">
    @csrf

    <label for="nama_eskul">Nama Eskul</label><br>
    <input type="text" name="nama_eskul" id="nama_eskul" required><br><br>

    <label for="jadwal_eskul">Jadwal Eskul</label><br>
    <input type="text" name="jadwal_eskul" id="jadwal_eskul" required><br><br>

    <label for="materi">Materi</label><br>
    <textarea name="materi" id="materi" rows="3"></textarea><br><br>

    <label for="id_pembina">Pembina</label><br>
    <select name="id_pembina" id="id_pembina" required>
        @foreach($pembinas as $pembina)
            <option value="{{ $pembina->id_pembina }}">{{ $pembina->nama_pembina }}</option>
        @endforeach
    </select><br><br>

    <button type="submit">Simpan</button>
</form>

<p><a href="{{ route('eskul.index') }}">← Kembali</a></p>
@endsection

</body>
</html>