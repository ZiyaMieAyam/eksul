<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
</head>
<body>

@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')

@if(session('success'))@endif

<h2>Selamat Datang di Portal Ekstrakurikuler!</h2>
<p>Bersama Ekskul, Raih Prestasi dan Temukan Bakatmu!</p>
<p>Gabung dan aktiflah di ekstrakurikuler sekolah untuk mengembangkan diri, menambah teman, dan meraih prestasi. Ayo daftar sekarang!</p>
<a href="{{ route('dafes') }}">Daftar Ekstrakurikuler</a>

<h3>Galeri Prestasi Siswa</h3>
@forelse($prestasis as $prestasi)
    <p>
        <b>{{ $prestasi->nama_prestasi }}</b>
        - {{ $prestasi->eskul->nama_eskul }}
    </p>
@empty
    <p>Belum ada prestasi yang ditampilkan.</p>
@endforelse

@endsection

</body>
</html>