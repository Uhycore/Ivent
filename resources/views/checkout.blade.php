<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout Pembayaran</title>

    <!-- Midtrans Snap -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <!-- Tailwind + DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>


</head>

<body class="bg-base-200 min-h-screen flex items-center justify-center p-4">

    <div class="card max-w-lg w-full bg-base-100 shadow-xl print:shadow-none">
        <div class="card-body">
            <h1 class="card-title text-2xl font-bold mb-4">Checkout Pembayaran</h1>

            <div class="divider my-2"></div>

            <div class="space-y-4">
                <!-- Detail Transaksi -->
                <div class="bg-base-200 p-4 rounded-lg">
                    <h2 class="font-semibold text-lg mb-2">Detail Transaksi</h2>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div class="text-base-content/70">Kode Transaksi:</div>
                        <div class="font-medium">{{ $kodeTransaksi }}</div>

                        <div class="text-base-content/70">Jumlah Bayar:</div>
                        <div class="font-medium text-primary">Rp {{ number_format($jumlahBayar, 0, ',', '.') }}</div>
                    </div>
                </div>

                <!-- Informasi User -->
                <div class="bg-base-200 p-4 rounded-lg">
                    <h2 class="font-semibold text-lg mb-2">Informasi Pengguna</h2>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div class="text-base-content/70">Nama Pengguna:</div>
                        <div class="font-medium">{{ $user->username }}</div>

                        <div class="text-base-content/70">Nomor HP:</div>
                        <div class="font-medium">{{ $noHp }}</div>
                    </div>
                </div>
            </div>

            <div class="divider my-2"></div>

            <!-- Tombol bayar -->
            <div class="mt-4 no-print">
                <button id="pay-button"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200">
                    Bayar Sekarang
                </button>

                <div class="flex justify-center mt-4">
                    <div class="badge badge-outline gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75M6 21h12a2 2 0 002-2v-7a2 2 0 00-2-2H6a2 2 0 00-2 2v7a2 2 0 002 2z" />
                        </svg>
                        Transaksi Aman
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bantuan -->
    <div class="fixed bottom-4 right-4 no-print">
        <div class="dropdown dropdown-top dropdown-end">
            <div tabindex="0" role="button" class="btn btn-circle btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                </svg>
            </div>
            <div class="dropdown-content z-[1] card card-compact w-64 p-2 shadow bg-base-100 text-base-content">
                <div class="card-body">
                    <h3 class="font-bold">Butuh Bantuan?</h3>
                    <p class="text-sm">Hubungi CS di 0800-123-4567 atau email ke support@example.com</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert('Pembayaran berhasil!');
                    // Redirect ke halaman sukses, misalnya:
                    window.location.href = "{{ route('invoice', $kodeTransaksi) }}";

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
