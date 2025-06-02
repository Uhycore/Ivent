<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice <?= $invoice['kode_transaksi'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>



<body class="bg-base-200 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="bg-base-100 rounded-lg shadow-lg p-6 mb-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-primary"><i class="fas fa-receipt mr-2"></i>Invoice</h1>
                    <p class="text-sm text-base-content/70">Detail transaksi pembayaran event</p>
                </div>
                <div class="text-right">
                    <img src="{{ asset('images/profil.jpg') }}" alt="Logo" class="h-12 inline-block">
                </div>
            </div>

            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('user.landing_pages') }}" class="btn btn-outline btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <button class="btn btn-primary" onclick="window.print()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak Invoice
                </button>
            </div>

            <!-- Invoice Content -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Transaction Information -->
                <div class="card bg-base-100 border border-base-300">
                    <div class="card-body">
                        <h2 class="card-title text-lg font-semibold border-b pb-2">Informasi Transaksi</h2>
                        <div class="space-y-2 mt-3">
                            <div class="flex justify-between">
                                <span class="font-medium">Kode Transaksi:</span>
                                <span class="font-mono"><?= $invoice['kode_transaksi'] ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium">Tanggal Transaksi:</span>
                                <span><?= date('d F Y H:i:s', strtotime($invoice['created_at'])) ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium">Jumlah Bayar:</span>
                                <span class="font-semibold">Rp
                                    <?= number_format($invoice['jumlah_bayar'], 0, ',', '.') ?></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-medium">Status:</span>
                                <span
                                    class="badge <?= $invoice['status'] === 'paid' ? 'badge-success' : 'badge-error' ?>">
                                    <?= strtoupper($invoice['status']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Information -->
                <div class="card bg-base-100 border border-base-300">
                    <div class="card-body">
                        <h2 class="card-title text-lg font-semibold border-b pb-2">Pengguna</h2>
                        <div class="space-y-2 mt-3">
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="w-12 rounded-full">
                                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=<?= $user['username'] ?>"
                                            alt="User Avatar" />
                                    </div>
                                </div>
                                <div>
                                    <p class="font-medium">Username:</p>
                                    <p><?= $user['username'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Details -->
            <div class="card bg-base-100 border border-base-300 mt-6">
                <div class="card-body">
                    <h2 class="card-title text-lg font-semibold border-b pb-2">Detail Event</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                        <div>
                            <p class="font-medium">Nama Event:</p>
                            <p class="text-lg"><?= $event['nama_event'] ?></p>
                        </div>
                        <div>
                            <p class="font-medium">Tanggal:</p>
                            <p><?= date('d F Y', strtotime($event['tanggal'])) ?></p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="font-medium">Deskripsi:</p>
                            <p class="text-base-content/80"><?= $event['deskripsi'] ?></p>
                        </div>
                        <div>
                            <p class="font-medium">Tipe Event:</p>
                            <p><?= ucfirst($event['tipe_event']) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="border-t mt-6 pt-4 text-center text-sm text-base-content/70">
                <p>Jika ada pertanyaan, silakan hubungi kami di support@eventorganizer.com</p>
                <p class="mt-2">© <?= date('Y') ?> Event Organizer. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>

</html>
