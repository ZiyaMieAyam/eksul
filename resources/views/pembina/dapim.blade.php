{{-- filepath: resources/views/pembina/dapim.blade.php --}}
@extends('layouts.app')

@section('title', 'Data Pembina')

@section('content')
<h2>Data Pembina</h2>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama Pembina</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pembinas as $i => $p)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $p->user->username ?? '-' }}</td>
            <td>{{ $p->nama_pembina }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3">Tidak ada data pembina.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection