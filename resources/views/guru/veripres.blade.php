@extends('layouts.app')

@section('title', 'Verifikasi Prestasi')

@section('content')

<h2>Verifikasi Prestasi Siswa</h2>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Nama Prestasi</th>
            <th>Eskul</th>
            <th>Tanggal Diraih</th>
            <th>Tingkat</th>
            <th>Bukti</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($prestasis as $i => $p)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $p->siswa->nama_siswa }}</td>
            <td>{{ $p->nama_prestasi }}</td>
            <td>{{ $p->eskul->nama_eskul }}</td>
            <td>{{ $p->tanggal_diraih }}</td>
            <td>{{ $p->tingkat }}</td>
            <td>
                @if($p->bukti)
                    <a href="{{ asset('storage/' . $p->bukti) }}" target="_blank">Lihat</a>
                @else
                    -
                @endif
            </td>
            <td>
                <form action="{{ route('guru.prestasi.update', $p->id_prestasi) }}" method="POST" style="display:inline;">
                    @csrf @method('PUT')
                    <input type="hidden" name="status" value="Diverifikasi">
                    <button type="submit" onclick="return confirm('Terima prestasi ini?')">Terima</button>
                </form>
                <form action="{{ route('guru.prestasi.update', $p->id_prestasi) }}" method="POST" style="display:inline;">
                    @csrf @method('PUT')
                    <input type="hidden" name="status" value="Ditolak">
                    <button type="submit" onclick="return confirm('Tolak prestasi ini?')">Tolak</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8">Tidak ada prestasi yang perlu diverifikasi.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection