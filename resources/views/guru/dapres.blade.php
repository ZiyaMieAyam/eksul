@extends('layouts.app')

@section('title', 'Prestasi Siswa')

@section('content')
<h2>Daftar Prestasi Siswa</h2>
<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Prestasi</th>
            <th>Eskul</th>
            <th>Tanggal Diraih</th>
            <th>Tingkat</th>
            <th>Status</th>
            <th>Bukti</th>
        </tr>
    </thead>
    <tbody>
        @forelse($prestasi as $i => $p)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $p->nama_prestasi }}</td>
            <td>{{ $p->eskul->nama_eskul ?? '-' }}</td>
            <td>{{ $p->tanggal_diraih }}</td>
            <td>{{ $p->tingkat }}</td>
            <td>{{ $p->status }}</td>
            <td>
                @if(!empty($p->bukti))
                    <a href="{{ route('prestasi.bukti', ['path' => $p->bukti]) }}" target="_blank" rel="noopener">Lihat</a>
                @else
                    -
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7">Belum ada data prestasi.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection