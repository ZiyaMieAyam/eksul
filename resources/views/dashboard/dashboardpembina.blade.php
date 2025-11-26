<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pembina</title>
    <style>
        main {
            flex: 1;
            padding: 40px;
            background-color: #f5f5f5;
        }

        h2 {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .data-siswa-card {
            background: linear-gradient(135deg, #b71c1c 0%, #d32f2f 100%);
            color: white;
            padding: 40px;
            border-radius: 20px;
            margin-bottom: 50px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .data-siswa-card .icon {
            font-size: 60px;
            margin-right: 40px;
        }

        .data-siswa-card .info h3 {
            font-size: 18px;
            margin: 0;
            font-weight: normal;
            text-align: right;
        }

        .data-siswa-card .info .count {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0 0 0;
            text-align: right;
        }

        h3 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .eskul-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .eskul-card {
            background: linear-gradient(135deg, #b71c1c 0%, #d32f2f 100%);
            color: white;
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 150px;
        }

        .eskul-card .icon-container {
            width: 60px;
            height: 60px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .eskul-card .icon-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .eskul-card .nama {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .eskul-card .count {
            font-size: 18px;
            font-weight: bold;
        }

        @media (max-width: 1200px) {
            .eskul-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .eskul-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

@extends('layouts.app')

@section('title', 'Dashboard Pembina')

@section('content')

<main>
    <h2>Dashboard</h2>

    <div class="data-siswa-card">
        <div class="icon">👤</div>
        <div class="info">
            <h3>Data Siswa</h3>
            <p class="count">{{ $totalSiswa ?? 0 }} Siswa</p>
        </div>
    </div>

    <h3>Ekstrakurikuler</h3>
    <div class="eskul-grid">
        @forelse($eskulStats as $eskul)
            <div class="eskul-card">
                <div class="icon-container">
                    <img src="{{ asset('images/eskul/' . $eskul->id . '.png') }}" alt="{{ $eskul->nama_eskul }}">
                    <img src="{{ asset('images/eskul/' . $eskul->id . '.webp') }}" alt="{{ $eskul->nama_eskul }}">
                </div>
                <div class="nama">{{ strtoupper($eskul->nama_eskul) }}</div>
                <div class="count">{{ $eskul->pendaftaran_count ?? 0 }} Siswa</div>
            </div>
        @empty
            <p>Tidak ada data eskul.</p>
        @endforelse
    </div>
</main>

@endsection

</body>
</html>