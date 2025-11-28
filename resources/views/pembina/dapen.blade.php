{{-- filepath: resources/views/pembina/dapen.blade.php --}}
@extends('layouts.app')

@section('title', 'Data Pendaftaran')

@section('content')
<h2>Data Pendaftaran</h2>

@if(isset($eskul))
    <p><strong>Eskul: {{ $eskul->nama_eskul }}</strong> — <a href="{{ route('pendaftaran.index') }}">← Pilih Eskul Lain</a></p>
    
    @if(session('success'))
        <div style="background:lightgreen;padding:10px;margin-bottom:10px;">{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Tanggal Daftar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendaftarans as $i => $p)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $p->siswa->nama_siswa ?? '-' }}</td>
                <td>{{ $p->siswa->kelas ?? '-' }}</td>
                <td>{{ $p->tanggal_daftar }}</td>
                <td>{{ $p->status }}</td>
                <td>
                    @if($p->status === 'Pending')
                        <form action="{{ route('pendaftaran.update', $p->id_pendaftaran) }}" method="POST" style="display:inline;">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="Diterima">
                            <button type="submit" onclick="return confirm('Terima?')">Terima</button>
                        </form>
                        <form action="{{ route('pendaftaran.update', $p->id_pendaftaran) }}" method="POST" style="display:inline;">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="Ditolak">
                            <button type="submit" onclick="return confirm('Tolak?')">Tolak</button>
                        </form>
                    @else
                        <em>{{ $p->status }}</em>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Tidak ada pendaftaran.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
@else
    <p>Pilih eskul terlebih dahulu.</p>
@endif
@endsection