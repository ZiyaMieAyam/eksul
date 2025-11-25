<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Aktivitas</title>
</head>
<body>

    <div class="container">
        <h1>Detail Aktivitas</h1>

        <table border="1" cellpadding="10">
            <tr>
                <th>ID Aktivitas</th>
                <td>{{ $aktivitas->id_aktivitas }}</td>
            </tr>
            <tr>
                <th>Pembina</th>
                <td>{{ $aktivitas->pembina->nama_pembina}}</td>
            </tr>
            <tr>
                <th>Eskul</th>
                <td>{{ $aktivitas->eskul->nama_eskul}}</td>
            </tr>
            <tr>
                <th>Tanggal Aktivitas</th>
                <td>{{ $aktivitas->tanggal_aktivitas }}</td>
            </tr>
            <tr>
                <th>Jam</th>
                <td>{{ $aktivitas->jam }}</td>
            </tr>
            <tr>
                <th>Jenis Aktivitas</th>
                <td>{{ $aktivitas->jenis_aktivitas }}</td>
            </tr>
            <tr>
                <th>Tempat</th>
                <td>{{ $aktivitas->tempat }}</td>
            </tr>
        </table>

        <p><a href="{{ route('aktivitas.index') }}">← Kembali ke Daftar Aktivitas</a></p>
    </div>

</body>
</html>