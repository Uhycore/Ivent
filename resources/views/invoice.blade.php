<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Invoice <?= $invoice['kode_transaksi'] ?></title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <style>
    @media print {
      body {
        background: white !important;
      }
      .no-print {
        display: none !important;
      }
      .print-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0;
      }
    }
  </style>
</head>

<body class="bg-base-200 min-h-screen text-base-content">
  <div class="print-container container mx-auto px-4 py-8 max-w-4xl">
    <!-- Header -->
    <!-- Wrapper utama -->
<div class="bg-base-100 rounded-lg shadow-lg p-6 mb-6">

  <!-- Header -->
  <div class="flex justify-between items-center flex-wrap gap-4 mb-6">
    <div>
      <h1 class="text-2xl font-bold text-primary">
        <i class="fas fa-receipt mr-2"></i>Struk
      </h1>
      <p class="text-sm text-base-content/70">Detail transaksi pembayaran event</p>
    </div>
    <button onclick="window.print()" 
      class="no-print inline-flex items-center px-4 py-2 rounded border border-[#d2dcff] bg-[#d2dcff] text-[#416aff] font-semibold hover:bg-[#416aff] hover:text-white transition-colors duration-200">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
      </svg>
      Cetak Invoice
    </button>
  </div>

  <!-- Pengguna & Detail Event berdampingan -->
  <div class="grid md:grid-cols-2 gap-6 mb-6">
    
    <!-- Pengguna -->
    <div class="card bg-base-100 border border-base-300">
      <div class="card-body">
        <h2 class="card-title text-lg font-semibold border-b pb-2">Pengguna</h2>
        <div class="flex items-center gap-3 mt-3">
          <div class="avatar">
            <div class="w-12 rounded-full">
              <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=<?= $user['username'] ?>" alt="User Avatar" />
            </div>
          </div>
          <div>
            <p class="font-medium">Username:</p>
            <p><?= $user['username'] ?></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Detail Event -->
    <div class="card bg-base-100 border border-base-300">
      <div class="card-body">
        <h2 class="card-title text-lg font-semibold border-b pb-2">Detail Event</h2>
        <div class="space-y-2 mt-3">
          <div>
            <p class="font-medium">Nama Event:</p>
            <p class="text-lg"><?= $event['nama_event'] ?></p>
          </div>
          <div>
            <p class="font-medium">Tanggal:</p>
            <p><?= date('d F Y', strtotime($event['tanggal'])) ?></p>
          </div>
          <div>
            <p class="font-medium">Tipe Event:</p>
            <p><?= ucfirst($event['tipe_event']) ?></p>
          </div>
          <div>
            <p class="font-medium">Deskripsi:</p>
            <p class="text-base-content/80"><?= $event['deskripsi'] ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Informasi Transaksi -->
  <div class="card bg-base-100 border border-base-300 mb-6">
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
          <span class="font-semibold">Rp <?= number_format($invoice['jumlah_bayar'], 0, ',', '.') ?></span>
        </div>
        <div class="flex justify-between items-center">
          <span class="font-medium">Status:</span>
          <span class="<?= $invoice['status'] === 'paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?> text-xs font-semibold px-2.5 py-0.5 rounded-full">
            <?= strtoupper($invoice['status']) ?>
          </span>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="border-t mt-6 pt-4 text-center text-sm text-base-content/70">
    <p>Jika ada pertanyaan, silakan hubungi kami di support@event.com</p>
    <p class="mt-2 mb-4">© <?= date('Y') ?> Event Organizer. All rights reserved.</p>
  </div>

  <!-- Button Kembali -->
  <a href="{{ route('user.landing_pages') }}"
    class="no-print w-full inline-flex items-center justify-center border text-[#7e9aff] border-[#8ea7ff] bg-white hover:bg-[#8ea7ff] hover:text-white font-medium py-2 px-4 rounded transition-colors duration-200 mt-4">
    <i class="fas fa-arrow-left mr-2"></i>Kembali
  </a>
</div>

  </div>
</body>
</html>
