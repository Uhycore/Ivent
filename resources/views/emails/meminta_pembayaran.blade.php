<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Berhasil</title>
</head>
<body>
    <h2>Halo {{ $user->name }},</h2>
    <p>Terima kasih telah mendaftar pada event <strong>{{ $pendaftaran->event->nama_event }}</strong>.</p>

    <p>Status pendaftaran Anda saat ini: <strong>{{ $pendaftaran->status }}</strong></p>

    <p>Salam,<br>Panitia</p>
</body>
</html>
