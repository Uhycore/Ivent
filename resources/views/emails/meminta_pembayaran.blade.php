<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pendaftaran</title>
</head>

<body>
    <div
        style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; max-width: 650px; margin: auto; background-color: #ffffff; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.07); padding: 30px; color: #333;">

        <div style="border-bottom: 2px solid #3498db; padding-bottom: 10px; margin-bottom: 20px;">
            <h1 style="color: #2980b9; margin: 0;">Halo, {{ $user->username }}</h1>
            <p style="margin-top: 8px; font-size: 15px;">
                Pendaftaran Anda telah berhasil untuk event berikut:
            </p>
        </div>

        <div
            style="background-color: #eaf6ff; padding: 15px 20px; border-left: 4px solid #3498db; margin-bottom: 20px; border-radius: 8px;">
            <p style="margin: 0; font-size: 15px;">
                Status pendaftaran Anda saat ini adalah:
                <strong style="color: #f39c12;">{{ ucfirst($pendaftaran->status) }}</strong><br>
                Tipe pendaftaran: <strong>{{ ucfirst($pendaftaran->tipe_pendaftaran) }}</strong><br>
                Tanggal daftar:
                <strong>{{ \Carbon\Carbon::parse($pendaftaran->tanggal_daftar)->format('d M Y H:i') }}</strong>
            </p>
        </div>

        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <tr>
                <td style="padding: 10px 0; font-weight: 600; width: 40%;">Nama Event</td>
                <td>: {{ $event->nama_event }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 0; font-weight: 600;">Tanggal Event</td>
                <td>: {{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 0; font-weight: 600;">Deskripsi</td>
                <td>: {{ $event->deskripsi }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 0; font-weight: 600;">Tipe Event</td>
                <td>: {{ ucfirst($event->tipe_event) }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 0; font-weight: 600;">Harga Pendaftaran</td>
                <td>: Rp {{ number_format($event->harga_pendaftaran, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div style="margin-top: 30px; border-top: 1px solid #ccc; padding-top: 15px;">
            <p style="font-size: 15px;">
                Silakan tunggu informasi pembayaran dari panitia. Jika Anda memiliki pertanyaan lebih lanjut, hubungi
                kami melalui email ini. 🙏
            </p>
        </div>
    </div>
</body>

</html>
