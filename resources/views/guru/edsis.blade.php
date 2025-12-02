{{-- filepath: resources/views/guru/edsis.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Data Siswa')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-red-50 via-orange-50 to-yellow-50 py-12 px-4 flex items-center justify-center">
    <div class="w-full max-w-2xl">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-red-700 to-red-600 p-8">
                <h2 class="text-3xl font-bold text-white text-center">Data Siswa</h2>
            </div>

            <!-- Form Content -->
            <div class="p-8 md:p-12">
                <form action="{{ route('siswa.update', $data->id_siswa) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="transform transition-all duration-200 hover:scale-[1.01]">
                        <label for="nama_siswa" class="block text-gray-700 text-sm font-semibold mb-2">Nama Siswa</label>
                        <input type="text" name="nama_siswa" id="nama_siswa" value="{{ old('nama_siswa', $data->nama_siswa) }}" required
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200 transition-all duration-200">
                    </div>

                    <div class="transform transition-all duration-200 hover:scale-[1.01]">
                        <label for="id_user" class="block text-gray-700 text-sm font-semibold mb-2">NIS</label>
                        <input type="text" name="id_user" id="id_user" value="{{ old('id_user', $data->id_user) }}"
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200 transition-all duration-200 bg-gray-50" readonly>
                    </div>

                    <div class="transform transition-all duration-200 hover:scale-[1.01]">
                        <label for="kelas" class="block text-gray-700 text-sm font-semibold mb-2">Kelas</label>
                        <input type="text" name="kelas" id="kelas" value="{{ old('kelas', $data->kelas) }}" required
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200 transition-all duration-200">
                    </div>

                    <div class="transform transition-all duration-200 hover:scale-[1.01]">
                        <label for="id_eskul" class="block text-gray-700 text-sm font-semibold mb-2">Ekstrakurikuler</label>
                        <select name="id_eskul" id="id_eskul"
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200 transition-all duration-200 appearance-none bg-white cursor-pointer">
                            <option value="">Pilih Ekstrakurikuler</option>
                            @foreach($eskuls ?? [] as $eskul)
                                <option value="{{ $eskul->id_eskul }}" {{ $data->id_eskul == $eskul->id_eskul ? 'selected' : '' }}>
                                    {{ $eskul->nama_eskul }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="transform transition-all duration-200 hover:scale-[1.01]">
                        <label for="alamat" class="block text-gray-700 text-sm font-semibold mb-2">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3"
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200 transition-all duration-200 resize-none">{{ old('alamat', $data->alamat) }}</textarea>
                    </div>

                    <div class="flex gap-4 pt-6">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white font-semibold py-3 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                            Update
                        </button>
                        <a href="{{ route('siswa.index') }}" class="flex-1 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-semibold py-3 rounded-xl text-center transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection