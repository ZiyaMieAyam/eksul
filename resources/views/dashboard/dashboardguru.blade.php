@extends('layouts.app')

@section('title', 'Dashboard Guru')

@section('content')
<main class="p-10 bg-gray-100 min-h-screen">
    <h2 class="text-4xl font-bold mb-8 text-gray-900">Dashboard Guru</h2>

    <!-- Data Siswa Card -->
    <div class="bg-gradient-to-r from-red-700 to-red-800 text-white p-10 rounded-2xl mb-12 flex items-center justify-between shadow-lg">
        <div class="text-5xl">👤</div>
        <div class="text-right flex-1 ml-8">
            <h3 class="text-lg font-normal">Data Siswa</h3>
            <p class="text-2xl font-bold mt-2">{{ $totalSiswa ?? 0 }} Siswa</p>
        </div>
    </div>

    <!-- Ekstrakurikuler Section -->
    <h3 class="text-2xl font-bold mb-6 text-gray-900">Ekstrakurikuler</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($eskulStats as $eskul)
            <div class="bg-gradient-to-br from-red-700 to-red-800 text-white p-8 rounded-2xl text-center flex flex-col justify-center items-center min-h-[150px] shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-200">
                <div class="w-16 h-16 mb-3 flex items-center justify-center text-4xl">
                    @if($eskul->id == 1)
                        🏐
                    @elseif($eskul->id == 2)
                        🏀
                    @elseif($eskul->id == 3)
                        ⚽
                    @elseif($eskul->id == 4)
                        ➕
                    @elseif($eskul->id == 5)
                        🏃
                    @elseif($eskul->id == 6)
                        👥
                    @else
                        ⭐
                    @endif
                </div>
                <div class="text-sm font-bold uppercase tracking-wide mb-2">{{ $eskul->nama_eskul }}</div>
                <div class="text-lg font-bold">{{ $eskul->pendaftaran_count ?? 0 }} Siswa</div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-400">Tidak ada data ekstrakurikuler.</div>
        @endforelse
    </div>
</main>
@endsection
