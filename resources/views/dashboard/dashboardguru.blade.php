<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>
</head>
<body>

@extends('layouts.app')

@section('title', 'Dashboard Guru')

@section('content')

<div style="display:flex;">    
    <main style="flex:1; padding:20px;">
        <h2>Dashboard Gurau</h2>

        <table border="1">
            <tr>
                <td>Data Siswa</td>
                <td>{{ $totalSiswa ?? 0 }}</td>
            </tr>
        </table>

        <h3>Ekstrakurikuler</h3>
        @forelse($eskulStats as $eskul)
            <div>
                <strong>{{ $eskul->nama_eskul }}</strong> — {{ $eskul->pendaftaran_count }} siswa
            </div>
        @empty
            <p>Tidak ada data eskul.</p>
        @endforelse
    </main>
</div>

@endsection

</body>
</html>