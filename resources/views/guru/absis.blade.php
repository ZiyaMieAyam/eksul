@extends('layouts.app')

@section('title', 'Absensi Siswa')

@section('content')
@if(isset($eskuls))
    <h2>Daftar Ekstrakurikuler</h2>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Eskul</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($eskuls as $i => $eskul)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $eskul->nama_eskul }}</td>
                <td>
                    <a href="{{ route('guru.absensi.detail', $eskul->id_eskul) }}">Detail Absensi</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3">Tidak ada data ekstrakurikuler</td>
            </tr>
            @endforelse
        </tbody>
    </table>
@elseif(isset($eskul) && isset($kehadirans))
    <h2>Absensi Siswa - Eskul: {{ $eskul->nama_eskul }}</h2>
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Status Kehadiran</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kehadirans as $tanggal => $absens)
                @forelse($absens as $i => $absen)
                <tr>
                    <td>{{ $loop->parent->iteration }}</td>
                    <td>{{ $absen->siswa->nama_siswa }}</td>
                    <td>{{ $absen->siswa->kelas }}</td>
                    <td>{{ $absen->status }}</td>
                    <td>{{ $absen->tanggal }}</td>
                </tr>
                @empty
                @endforelse
            @empty
            <tr>
                <td colspan="5">Belum ada absensi siswa untuk eskul ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <p><a href="{{ route('guru.datab') }}">← Kembali</a></p>
@endif
@endsection