<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Checkout Pembayaran</title>

    <!-- Midtrans Snap -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

    <!-- Tailwind + DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Custom scrollbar untuk transaksi jika banyak */
        .scrollable {
            max-height: 220px;
            overflow-y: auto;
        }
    </style>
</head>

<body class="bg-blue-200 min-h-screen flex flex-col items-center justify-center p-6">

    <div class="card w-full max-w-lg bg-base-100 shadow-lg rounded-xl print:shadow-none">
        <div class="card-body p-6">

            <h1 class="card-title text-3xl font-bold justify-center text-center mb-6 text-primary">Checkout Pembayaran</h1>

            <div class="divider"></div>

            <section class="mb-6">
                <h2 class="font-semibold text-xl mb-3 text-neutral">Detail Transaksi</h2>
                <div class="bg-base-200 rounded-lg p-5 shadow-inner scrollable">
                    <dl class="grid grid-cols-2 gap-x-4 gap-y-3 text-sm sm:text-base">
                        <dt class="text-base-content/70 font-medium">Kode Transaksi:</dt>
                        <dd class="font-semibold break-words">{{ $kodeTransaksi }}</dd>
                        <dt class="text-base-content/70 font-medium">Nama Event:</dt>
                        <dd class="font-semibold break-words">{{ $eventName }}</dd>
                        <dt class="text-base-content/70 font-medium">Pendaftaran ID:</dt>
                        <dd class="font-semibold break-words">{{ $pendaftaranId }}</dd>

                        <dt class="text-base-content/70 font-medium">Jumlah Bayar:</dt>
                        <dd class="font-bold text-primary text-lg">Rp {{ number_format($jumlahBayar, 0, ',', '.') }}</dd>
                    </dl>
                </div>
            </section>

            <section class="mb-6">
                <h2 class="font-semibold text-xl mb-3 text-neutral">Informasi Pengguna</h2>
                <div class="bg-base-200 rounded-lg p-5 shadow-inner">
                    <dl class="grid grid-cols-2 gap-x-4 gap-y-3 text-sm sm:text-base">
                        <dt class="text-base-content/70 font-medium">Nama Pengguna:</dt>
                        <dd class="font-semibold break-words">{{ $user->username }}</dd>

                        <dt class="text-base-content/70 font-medium">Nomor HP:</dt>
                        <dd class="font-semibold break-words">{{ $noHp }}</dd>

                        <dt class="text-base-content/70 font-medium">Alamat:</dt>
                        <dd class="font-semibold break-words">{{ $alamat }}</dd>
                    </dl>
                </div>
            </section>

            <button id="pay-button" type="button" class="w-full text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                Bayar Sekarang
            </button>

            <div class="flex justify-center mt-4">
                <div class="badge badge-outline gap-2 px-4 py-3 rounded-lg flex items-center space-x-2 shadow-sm">
                    
                    <button onclick="window.location.href='../index.php/history'" class="text-primary font-semibold">kembali</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Bantuan -->
    <div class="fixed bottom-6 right-6 no-print">
        <div class="dropdown dropdown-top dropdown-end">
            <label tabindex="0" role="button" class="btn btn-circle btn-primary btn-sm shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                    <path
                        d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75" />
                    <circle cx="12" cy="17.25" r="0.25" />
                    <path
                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                </svg>
            </label>
            <div tabindex="0" class="dropdown-content card card-compact w-72 p-3 shadow-lg bg-base-100 text-base-content rounded-md">
                <div class="card-body p-0">
                    <h3 class="font-bold text-lg mb-2">Butuh Bantuan?</h3>
                    <p class="text-sm text-neutral">Hubungi CS di <a href="tel:08001234567" class="text-primary font-semibold underline">0800-123-4567</a> atau email ke <a href="mailto:support@example.com" class="text-primary font-semibold underline">support@example.com</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function (result) {
                    alert('Pembayaran berhasil!');
                    window.location.href = "{{ route('invoice', $kodeTransaksi) }}";
                },
                onPending: function (result) {
                    alert('Pembayaran dalam proses, silakan tunggu.');
                },
                onError: function (result) {
                    alert('Pembayaran gagal, silakan coba lagi.');
                },
                onClose: function () {
                    alert('Pembayaran dibatalkan.');
                }
            });
        });
    </script>
</body>

</html>