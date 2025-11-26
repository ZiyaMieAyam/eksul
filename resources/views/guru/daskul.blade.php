<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
{{-- ...existing code... --}}
@extends('layouts.app')

@section('title', 'Data Ekstrakurikuler')

@section('content')
<h2>Data Ekstrakurikuler</h2>

<a href="{{ route('eskul.create') }}">+ Tambah Eskul</a>

<table border="1" cellpadding="8" class="table-border">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Eskul</th>
            <th>Jadwal Eskul</th>
            <th>Materi</th>
            <th>Pembina Eskul</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $i => $eskul)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $eskul->nama_eskul ?? '-' }}</td>
            <td>{{ $eskul->jadwal_eskul ?? '-' }}</td>
            <td>{{ Str::limit($eskul->materi ?? '-', 80) }}</td>
            <td>{{ $eskul->pembina->nama_pembina ?? 'N/A' }}</td>
            <td>
                <a href="{{ route('eskul.edit', $eskul->id_eskul) }}">Edit</a>
                <form action="{{ route('eskul.destroy', $eskul->id_eskul) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7">Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
{{-- ...existing code... --}}
</body>
</html>