@extends('layouts.app')

@section('title', 'Input Prestasi')

@section('content')

<h2>Input Prestasi Saya</h2>

@if($errors->any())
    <div style="color:red; background:#ffebee; padding:10px; margin-bottom:10px;">
        <ul>
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('prestasi.store') }}" enctype="multipart/form-data">
    @csrf

    <label>Nama Prestasi</label><br>
    <input type="text" name="nama_prestasi" required><br><br>

    <label>Pilih Eskul</label><br>
    <select name="id_eskul" required>
        <option value="">-- Pilih Eskul --</option>
        @foreach($pendaftarans as $p)
            <option value="{{ $p->eskul->id_eskul }}">{{ $p->eskul->nama_eskul }}</option>
        @endforeach
    </select><br><br>

    <label>Tanggal Diraih</label><br>
    <input type="date" name="tanggal_diraih" required><br><br>

    <label>Tingkat</label><br>
    <select name="tingkat" required>
        <option value="">-- Pilih Tingkat --</option>
        <option value="Sekolah">Sekolah</option>
        <option value="Kota">Kota</option>
        <option value="Provinsi">Provinsi</option>
        <option value="Nasional">Nasional</option>
    </select><br><br>

    <label>Bukti (PDF)</label><br>
    <input type="file" name="bukti" accept=".pdf"><br><br>

    <button type="submit" onclick="this.disabled=true; this.form.submit();">Kirim Prestasi</button>
</form>

<p><a href="{{ route('dashboard.siswa') }}">← Kembali</a></p>

@endsection