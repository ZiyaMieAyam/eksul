<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Aktivitas</title>
</head>
<body>

    @extends('layouts.app')

    @section('content')

    <h2>Daftar Aktivitas</h2>

    <a href="{{ route('aktivitas.create') }}">+ Tambah Aktivitas</a>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pembina</th>
                <th>Eskul</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Jenis Aktivitas</th>
                <th>Tempat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($aktivitas as $item)
            <tr>
                <td>{{ $item->id_aktivitas }}</td>
                <td>{{ $item->pembina->nama_pembina }}</td>
                <td>{{ $item->eskul->nama_eskul }}</td>
                <td>{{ $item->tanggal_aktivitas }}</td>
                <td>{{ $item->jam }}</td>
                <td>{{ $item->jenis_aktivitas }}</td>
                <td>{{ $item->tempat }}</td>
                <td>
                    <a href="{{ route('aktivitas.edit', $item->id_aktivitas) }}">Edit</a>
                    <form action="{{ route('aktivitas.destroy', $item->id_aktivitas) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">Tidak ada data aktivitas</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @endsection

</body>
</html>
