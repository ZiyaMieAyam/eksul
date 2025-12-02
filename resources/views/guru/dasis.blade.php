@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
<div class="p-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-bold text-gray-900">Data Siswa</h2>
            <a href="{{ route('guru.tamsis') }}" class="text-sm text-blue-600 hover:underline">Tambah Data</a>
        </div>

        <!-- card / background di belakang tabel -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- single table (header + body) supaya kolom selalu sejajar -->
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto data-table">
                    <thead>
                        <tr class="bg-red-700 text-white">
                            <th class="px-6 py-3 text-left text-sm font-semibold">NO</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">NIS</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Nama Lengkap</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Kelas</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Ekstrakurikuler</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        @forelse($data as $i => $siswa)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-700 w-16">{{ $i + 1 }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ optional($siswa->user)->username ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $siswa->nama_siswa }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $siswa->kelas }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $siswa->eskul->nama_eskul ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('guru.edsis', $siswa->id_siswa) }}" class="text-yellow-500 hover:text-yellow-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3L12 14H9v-3z"/></svg>
                                    </a>
                                    <form action="{{ route('guru.edsis', $siswa->id_siswa) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7L5 7M10 11v6m4-6v6M9 7l1-3h4l1 3"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                Tidak ada data siswa.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- small CSS to show clear horizontal + vertical separators and rounded header -->
<style>
    /* gunakan sedikit custom CSS untuk garis vertikal antar kolom dan rounded header */
    .data-table {
        border-collapse: collapse;
        width: 100%;
    }
    .data-table thead tr th:first-child { border-top-left-radius: 0.75rem; }
    .data-table thead tr th:last-child { border-top-right-radius: 0.75rem; }
    /* horizontal lines between rows */
    .data-table tbody tr { border-bottom: 1px solid #e5e7eb; }
    /* vertical separators between columns */
    .data-table td + td, .data-table th + th {
        border-left: 1px solid #f3f4f6;
    }
    /* slightly increase contrast for hover */
    .data-table tbody tr:hover { background-color: #f8fafc; }
</style>
@endsection