<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Checkout Pembayaran</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-lg w-full bg-white rounded-lg shadow-md p-8">
        <h1 class="text-2xl font-semibold mb-6 text-gray-800">Checkout Pembayaran</h1>

        <div class="mb-4">
            <p class="text-gray-600"><span class="font-semibold">Kode Transaksi:</span> {{ $kodeTransaksi }}</p>
            <p class="text-gray-600"><span class="font-semibold">Jumlah Bayar:</span> Rp
                {{ number_format($jumlahBayar, 0, ',', '.') }}</p>
        </div>

        <div class="mb-6">
            <p class="text-gray-600"><span class="font-semibold">Nama Pengguna:</span> {{ $user->username }}</p>
            <p class="text-gray-600"><span class="font-semibold">Nomor HP:</span> {{ $noHp }}</p>
        </div>

        <button id="pay-button"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition duration-300">
            Bayar Sekarang
        </button>
    </div>

    <script>
        const payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert('Pembayaran berhasil!');
                    // Redirect ke halaman sukses, misalnya:
                    window.location.href = '/payment/success';
                },
                onPending: function(result) {
                    alert('Pembayaran dalam proses, silakan tunggu.');
                },
                onError: function(result) {
                    alert('Pembayaran gagal, silakan coba lagi.');
                },
                onClose: function() {
                    alert('Pembayaran dibatalkan.');
                }
            });
        });
    </script>

</body>

</html>
