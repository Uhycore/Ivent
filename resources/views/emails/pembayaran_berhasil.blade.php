<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <div
        style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; max-width: 650px; margin: auto; background-color: #ffffff; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.07); padding: 30px; color: #333;">
        <div style="border-bottom: 2px solid #4CAF50; padding-bottom: 10px; margin-bottom: 20px;">
            <h1 style="color: #2e7d32; margin: 0;">Halo, {{ $user->username }}</h1>
            <p style="margin-top: 8px; font-size: 15px;">Berikut adalah rincian pembayaran Anda yang telah berhasil
                dikonfirmasi.</p>
        </div>

        <div
            style="background-color: #f1f8e9; padding: 15px 20px; border-left: 4px solid #81c784; margin-bottom: 20px; border-radius: 8px;">
            <p style="margin: 0; font-size: 15px;">Pembayaran dengan kode transaksi
                <strong>{{ $transaksi->kode_transaksi }}</strong> untuk event <strong>{{ $event->nama_event }}</strong>
                telah <span style="color: #2e7d32; font-weight: bold;">BERHASIL</span> dikonfirmasi.
            </p>
        </div>

        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <tr>
                <td style="padding: 10px 0; font-weight: 600; width: 40%;">Tanggal Event</td>
                <td>: {{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 0; font-weight: 600;">Deskripsi</td>
                <td>: {{ $event->deskripsi }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 0; font-weight: 600;"> Tipe Event</td>
                <td>: {{ ucfirst($event->tipe_event) }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 0; font-weight: 600;"> Kuota Maksimal</td>
                <td>: {{ $event->kuota }} peserta</td>
            </tr>
            <tr>
                <td style="padding: 10px 0; font-weight: 600;"> Sisa Kuota</td>
                <td>: {{ $event->sisa_kuota }} peserta</td>
            </tr>
            <tr>
                <td style="padding: 10px 0; font-weight: 600;">Harga Pendaftaran</td>
                <td>: Rp {{ number_format($event->harga_pendaftaran, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 0; font-weight: 600;"> Jumlah Bayar</td>
                <td>: <strong style="color: #388e3c;">Rp
                        {{ number_format($transaksi->jumlah_bayar, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <td style="padding: 10px 0; font-weight: 600;">Status Pembayaran</td>
                <td>: <span style="color: #2e7d32; font-weight: bold;">{{ ucfirst($transaksi->status) }}</span></td>
            </tr>
            <tr>
                <td style="padding: 10px 0; font-weight: 600;">Tanggal Pembayaran</td>
                <td>: {{ $transaksi->updated_at->format('d M Y H:i') }}</td>
            </tr>
        </table>

        <div style="margin-top: 30px; border-top: 1px solid #ccc; padding-top: 15px;">
            <p style="font-size: 15px;">Terima kasih telah mendaftar di acara kami. Jangan lupa untuk hadir tepat waktu
                dan persiapkan dirimu dengan baik. 😊</p>
        </div>
    </div>


</body>

</html>
