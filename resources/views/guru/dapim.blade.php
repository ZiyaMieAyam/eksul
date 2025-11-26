{{-- filepath: resources/views/pembina/dapim.blade.php --}}
@extends('layouts.app')

@section('title', 'Data Pembina')

@section('content')
<h2>Data Pembina</h2>
<a href="{{ route('guru.tampim') }}" class="btn btn-primary mb-2">Tambah Pembina</a>
<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>No</th>
            <th>Nip</th>
            <th>Nama Pembina</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pembinas as $i => $p)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $p->user->username ?? '-' }}</td>
            <td>{{ $p->nama_pembina }}</td>
            <td>
                <a href="{{ route('pembina.edit', $p->id_pembina) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('pembina.destroy', $p->id_pembina) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">Tidak ada data pembina.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection