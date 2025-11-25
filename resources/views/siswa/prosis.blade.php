{{-- filepath: resources/views/siswa/prosis.blade.php --}}
@extends('layouts.app')

@section('title', 'Profil Siswa')

@section('content')

<h2>Profil Saya</h2>

<p>Nama: {{ $siswa->nama_siswa }}</p>
<p>NIS: {{ $siswa->nis }}</p>
<p>Kelas: {{ $siswa->kelas }}</p>

<h3>Riwayat Pendaftaran</h3>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Eskul</th>
            <th>Tanggal Daftar</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pendaftaran as $i => $p)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $p->eskul->nama_eskul }}</td>
            <td>{{ $p->tanggal_daftar }}</td>
            <td>{{ $p->status }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4">Belum ada pendaftaran.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection