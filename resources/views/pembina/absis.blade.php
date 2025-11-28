@extends('layouts.app')

@section('title', 'Input Absensi Siswa')

@section('content')
<h2>Input Absensi Siswa untuk Eskul: {{ $eskuls->nama_eskul ?? '-' }}</h2>

<form method="POST" action="{{ route('kehadiran.store') }}">
    @csrf
    <input type="hidden" name="id_eskul" value="{{ $eskuls->id_eskul }}">

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Status Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($siswas as $siswa)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $siswa->nama_siswa }}</td>
                <td>{{ $siswa->kelas }}</td>
                <td>
                    <select name="status[{{ $siswa->id_siswa }}]" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Hadir">Hadir</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Izin">Izin</option>
                        <option value="Alfa">Alfa</option>
                    </select>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Tidak ada siswa terdaftar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <button type="submit">Simpan Absensi</button>
</form>
@endsection