{{-- filepath: resources/views/siswa/dafes.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Ekstrakurikuler')

@section('content')
<h2>Form Pendaftaran Ekstrakurikuler</h2>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('dafes.store') }}">
    @csrf
    <table>
        <tr>
            <td>NIS</td>
            <td><input type="text" value="{{ optional($siswa->user)->username }}" readonly></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><input type="text" value="{{ $siswa->nama_siswa }}" readonly></td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td><input type="text" value="{{ $siswa->kelas }}" readonly></td>
        </tr>
        <tr>
            <td>Pilih Ekstrakurikuler</td>
            <td>
                <select name="id_eskul" required>
                    <option value="">-- Pilih --</option>
                    @foreach($eskuls as $eskul)
                        <option value="{{ $eskul->id_eskul }}">{{ $eskul->nama_eskul }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
    </table>
    <button type="submit">Daftar</button>
</form>
@endsection