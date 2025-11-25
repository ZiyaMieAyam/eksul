{{-- filepath: resources/views/guru/datab.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Ekstrakurikuler')

@section('content')
<h2>Daftar Ekstrakurikuler</h2>
<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Eskul</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($eskuls as $eskul)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $eskul->nama_eskul }}</td>
            <td>
                <a href="{{ route('guru.absensi.detail', $eskul->id_eskul) }}">Detail Absensi</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3">Tidak ada data ekstrakurikuler</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection