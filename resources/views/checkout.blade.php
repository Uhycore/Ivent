<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title style="color: black">Checkout Pembayaran</title>
    <!-- Midtrans Snap -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- Tailwind + DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>
        /* Custom scrollbar untuk transaksi jika banyak */
        .scrollable {
            max-height: 220px;
            overflow-y: auto;
        }
    </style>
</head>

<body class="bg-[#d2dcff] h-screen flex items-center justify-center px-4">

    <div class="card w-full max-w-2xl bg-white shadow-xl rounded-xl overflow-y-auto max-h-[95vh] p-6 animate-fade-down">
        <h1 class="text-2xl font-bold text-center text-black mb-6">Checkout Pembayaran</h1>

        <div class="mb-6">
            <h2 class="font-semibold text-lg mb-2 text-gray-700">Detail Transaksi</h2>
            <div class="bg-gray-100 rounded-lg p-4 text-sm">
                <dl class="grid grid-cols-2 gap-3">
                    <dt class="text-gray-500">Kode Transaksi:</dt>
                    <dd class="font-semibold break-words">{{ $kodeTransaksi }}</dd>
                    <dt class="text-gray-500">Nama Event:</dt>
                    <dd class="font-semibold">{{ $eventName }}</dd>
                    <dt class="text-gray-500">Pendaftaran ID:</dt>
                    <dd class="font-semibold">{{ $pendaftaranId }}</dd>
                    <dt class="text-gray-500">Jumlah Bayar:</dt>
                    <dd class="font-bold text-blue-700 text-lg">Rp {{ number_format($jumlahBayar, 0, ',', '.') }}</dd>
                </dl>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="font-semibold text-lg mb-2 text-gray-700">Informasi Pengguna</h2>
            <div class="bg-gray-100 rounded-lg p-4 text-sm">
                <dl class="grid grid-cols-2 gap-3">
                    <dt class="text-gray-500">Nama Pengguna:</dt>
                    <dd class="font-semibold">{{ $user->username }}</dd>
                    <dt class="text-gray-500">Nomor HP:</dt>
                    <dd class="font-semibold">{{ $noHp }}</dd>
                    <dt class="text-gray-500">Alamat:</dt>
                    <dd class="font-semibold">{{ $alamat }}</dd>
                </dl>
            </div>
        </div>

        <button id="pay-button" type="button"
            class="w-full bg-black text-white rounded-lg py-2 text-sm font-semibold hover:opacity-90 transition mt-4">
            Bayar Sekarang
        </button>

        <div class="flex justify-center mt-4">
            <button onclick="window.location.href='../index.php/history'"
                class="text-sm text-black font-medium hover:underline">
                Kembali ke Riwayat
            </button>
        </div>
    </div>

    <!-- Bantuan -->
    <div class="fixed bottom-4 right-4">
        <div class="dropdown dropdown-top dropdown-end">
            <label tabindex="0" role="button"
                class="btn btn-circle btn-primary btn-sm shadow-md hover:scale-105 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <path d="M12 2a10 10 0 100 20 10 10 0 000-20z" />
                    <path d="M12 8v4" />
                    <circle cx="12" cy="16" r="1" />
                </svg>
            </label>
            <div tabindex="0"
                class="dropdown-content card card-compact w-64 p-4 bg-white shadow-md text-sm rounded-md">
                <div>
                    <h3 class="font-bold text-base mb-2">Butuh Bantuan?</h3>
                    <p>Hubungi: <a href="tel:08001234567"
                            class="text-blue-600 underline font-semibold">0800-123-4567</a></p>
                    <p>Email: <a href="mailto:support@example.com"
                            class="text-blue-600 underline font-semibold">support@example.com</a></p>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-down {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-down {
            animation: fade-down 0.5s ease-out;
        }
    </style>

    <script>
    const payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function (result) {
                
                    window.location.href = "{{ route('invoice', $kodeTransaksi) }}";
                
            },
            onPending: function (result) {
                Swal.fire({
                    icon: 'info',
                    title: 'Menunggu Pembayaran',
                    text: 'Transaksi sedang diproses. Silakan tunggu konfirmasi.',
                    confirmButtonColor: '#3085d6',
                });
            },
            onError: function (result) {
                Swal.fire({
                    icon: 'error',
                    title: 'Pembayaran Gagal',
                    text: 'Silakan coba lagi atau gunakan metode lain.',
                    confirmButtonColor: '#d33',
                });
            },
            onClose: function () {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pembayaran Dibatalkan',
                    text: 'Anda telah menutup pop-up pembayaran.',
                    confirmButtonColor: '#f59e0b',
                });
            }
        });
    });
</script>


</body>


</html>