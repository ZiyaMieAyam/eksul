@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
<h2>Data Siswa</h2>
<a href="{{ route('guru.tamsis') }}" class="btn btn-primary mb-2">Tambah Siswa</a>
<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Eskul</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $i => $siswa)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ optional($siswa->user)->username ?? '-' }}</td>
            <td>{{ $siswa->nama_siswa }}</td>
            <td>
                @php
                    $accepted = $siswa->pendaftarans->where('status','Diterima')->first();
                @endphp
                {{ $accepted->eskul->nama_eskul ?? '-' }}
            </td>
            <td>
                <a href="{{ route('guru.edsis', $siswa->id_siswa) }}">Edit</a>
                <form action="{{ route('guru.dsis', $siswa->id_siswa) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">Tidak ada data siswa.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
