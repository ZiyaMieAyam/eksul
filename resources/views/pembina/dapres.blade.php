@extends('layouts.app')

@section('title', 'Data Prestasi')

@section('content')

<h2>Data Prestasi Siswa</h2>

<a href="{{ route('prestasi.create') }}">+ Tambah Prestasi</a>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Nama Prestasi</th>
            <th>Eskul</th>
            <th>Tanggal Diraih</th>
            <th>Tingkat</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($prestasi as $i => $p)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $p->siswa->nama_siswa ?? '-' }}</td>
            <td>{{ $p->nama_prestasi }}</td>
            <td>{{ $p->eskul->nama_eskul ?? '-' }}</td>
            <td>{{ $p->tanggal_diraih }}</td>
            <td>{{ $p->tingkat }}</td>
            <td>{{ $p->status }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8">Tidak ada data prestasi.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection