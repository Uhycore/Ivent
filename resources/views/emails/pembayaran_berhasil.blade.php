<h1>Halo, {{ $user->username }}</h1>

<p>Pembayaran Anda dengan kode transaksi <strong>{{ $transaksi->kode_transaksi }}</strong> untuk event
    <strong>{{ $event->nama_event }}</strong> telah berhasil dikonfirmasi.</p>

<table>
    <tr>
        <td><strong>Tanggal Event</strong></td>
        <td>: {{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}</td>
    </tr>
    <tr>
        <td><strong>Deskripsi</strong></td>
        <td>: {{ $event->deskripsi }}</td>
    </tr>
    <tr>
        <td><strong>Tipe Event</strong></td>
        <td>: {{ ucfirst($event->tipe_event) }}</td>
    </tr>
    <tr>
        <td><strong>Kuota Maksimal</strong></td>
        <td>: {{ $event->kuota }} peserta</td>
    </tr>
    <tr>
        <td><strong>Sisa Kuota</strong></td>
        <td>: {{ $event->sisa_kuota }} peserta</td>
    </tr>
    <tr>
        <td><strong>Harga Pendaftaran</strong></td>
        <td>: Rp {{ number_format($event->harga_pendaftaran, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td><strong>Jumlah Bayar</strong></td>
        <td>: Rp {{ number_format($transaksi->jumlah_bayar, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td><strong>Status Pembayaran</strong></td>
        <td>: {{ ucfirst($transaksi->status) }}</td>
    </tr>
    <tr>
        <td><strong>Tanggal Pembayaran</strong></td>
        <td>: {{ $transaksi->updated_at->format('d M Y H:i') }}</td>
    </tr>
</table>

<p>Terima kasih telah mendaftar di acara kami.</p>
