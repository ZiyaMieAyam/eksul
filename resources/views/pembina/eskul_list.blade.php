
@extends('layouts.app')

@section('title', 'Pilih Eskul')

@section('content')
<h2>Pilih Eskul untuk Lihat Pendaftaran</h2>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Eskul</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($eskuls as $i => $e)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $e->nama_eskul }}</td>
            <td>
                <a href="{{ route('pendaftaran.eskul', $e->id_eskul) }}">
                    <button>Detail</button>
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">Tidak ada eskul.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection