{{-- filepath: resources/views/pembina/vepen.blade.php --}}
@extends('layouts.app')

@section('title', 'Verifikasi Pendaftaran')

@section('content')
<div style="text-align:center; margin-top:60px;">
    <h2>Yakin ingin mengubah status pendaftaran?</h2>
    <form action="{{ route('pendaftaran.update', $pendaftaran->id_pendaftaran) }}" method="POST" style="display:inline;">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" value="Diterima">
        <button type="submit" style="background:#4caf50; color:#fff; padding:10px 24px; border:none; border-radius:8px;">Terima</button>
    </form>
    <form action="{{ route('pendaftaran.update', $pendaftaran->id_pendaftaran) }}" method="POST" style="display:inline;">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" value="Ditolak">
        <button type="submit" style="background:#f44336; color:#fff; padding:10px 24px; border:none; border-radius:8px;">Tolak</button>
    </form>
    <br><br>
    <a href="{{ route('pendaftaran.index') }}">Batal</a>
</div>
@endsection