@extends('layouts.app')

@section('title', 'Input Prestasi')

@section('content')
<h2>Input Prestasi</h2>

@if($errors->any())
    <ul>
        @foreach($errors->all() as $err)
            <li style="color:red;">{{ $err }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('prestasi.store') }}" enctype="multipart/form-data">
    @csrf

    @if(Auth::user() && Auth::user()->role === 'siswa')
        <input type="hidden" name="id_siswa" value="{{ optional(Auth::user()->siswa)->id_siswa }}">

        <label>Pilih Eskul</label><br>
        <select name="id_eskul" required>
            <option value="">-- Pilih Eskul --</option>
            @foreach($pendaftarans ?? [] as $p)
                @if(isset($p->eskul))
                    <option value="{{ $p->eskul->id_eskul }}">{{ $p->eskul->nama_eskul }}</option>
                @endif
            @endforeach
        </select>
        <br><br>
    @else
        <label>Pilih Siswa</label><br>
        <select name="id_siswa" required>
            <option value="">-- Pilih Siswa --</option>
            @foreach($siswas ?? [] as $s)
                <option value="{{ $s->id_siswa }}">{{ $s->nama_siswa }} ({{ $s->kelas }})</option>
            @endforeach
        </select>
        <br><br>

        <label>Pilih Eskul</label><br>
        <select name="id_eskul" required>
            <option value="">-- Pilih Eskul --</option>
            @foreach($eskuls ?? [] as $e)
                <option value="{{ $e->id_eskul }}">{{ $e->nama_eskul }}</option>
            @endforeach
        </select>
        <br><br>
    @endif

    <label>Nama Prestasi</label><br>
    <input type="text" name="nama_prestasi" value="{{ old('nama_prestasi') }}" required><br><br>

    <label>Tanggal Diraih</label><br>
    <input type="date" name="tanggal_diraih" value="{{ old('tanggal_diraih') }}" required><br><br>

    <label>Tingkat</label><br>
    <select name="tingkat" required>
        <option value="">-- Pilih Tingkat --</option>
        <option value="Sekolah" {{ old('tingkat')=='Sekolah' ? 'selected':'' }}>Sekolah</option>
        <option value="Kota" {{ old('tingkat')=='Kota' ? 'selected':'' }}>Kota</option>
        <option value="Provinsi" {{ old('tingkat')=='Provinsi' ? 'selected':'' }}>Provinsi</option>
        <option value="Nasional" {{ old('tingkat')=='Nasional' ? 'selected':'' }}>Nasional</option>
    </select>
    <br><br>

    <label>Bukti (PDF)</label><br>
    <input type="file" name="bukti" accept=".pdf">
    <br><br>

    <button type="submit" onclick="this.disabled=true; this.form.submit();">Kirim Prestasi</button>
</form>

<p><a href="{{ route(Auth::user() && Auth::user()->role === 'pembina' ? 'pembina.prestasi.index' : 'dashboard.siswa') }}">← Kembali</a></p>
@endsection