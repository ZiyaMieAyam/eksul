@extends('layouts.app')

@section('title', 'Data Kehadiran')

@section('content')
<h2>Data Kehadiran</h2>
<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>No</th>
            <th>Ekstrakurikuler</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($eskuls as $eskul)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $eskul->nama_eskul }}</td>
            <td>
                <a href="{{ route('kehadiran.detail', $eskul->id_eskul) }}">Detail</a>
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
