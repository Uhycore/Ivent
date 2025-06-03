<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #d2dcff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 80px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-30 text-white shadow-md px-6 py-4 flex items-center justify-between" style="background-color: #5d7ef3;">
        <!-- Tombol Back -->
        <button onclick="window.location.href='../index.php'" class="flex items-center hover:text-gray-300 transition">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back
        </button>
        <!-- Judul -->
        <h1 class="text-lg font-semibold">Daftar Pendaftaran</h1>
        <!-- Spacer -->
        <div class="w-12"></div>
    </nav>

    <div class="container mx-auto px-4 pb-20">
        <?php foreach ($pendaftaranList as $pendaftaran): ?>
        <!-- Card Tiket -->
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-5 my-6 space-y-4">
            <div class="flex justify-between items-center text-sm font-semibold text-gray-700">
                <span class="text-sm text-gray-500 mt-1">
                    <i class="fa fa-calendar mr-1"></i><?= htmlspecialchars($pendaftaran['tanggal_daftar']) ?>
                </span>
                <span class="<?= $pendaftaran['tipe_pendaftaran'] === 'perorangan' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800' ?> text-xs font-semibold px-2.5 py-0.5 rounded-full">
                    <?= ucfirst($pendaftaran['tipe_pendaftaran']) ?>
                </span>
            </div>
            
            <div class="flex gap-4">
                <!-- You can replace this with actual event image if available -->
                <img src="https://via.placeholder.com/100" alt="Poster Event" class="w-24 h-24 object-cover rounded-md" />
                <div class="flex-1">
                    <div class="text-base font-medium text-gray-800">
                        <?= htmlspecialchars($pendaftaran['event']['nama_event']) ?>
                    </div>
                    <div class="text-sm text-gray-500">
                        Kategori: <?= htmlspecialchars($pendaftaran['event']['tipe_event']) ?>
                    </div>
                    <span class="<?= $pendaftaran['status'] === 'diterima' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?> text-xs font-semibold px-2.5 py-0.5 rounded-full">
                        <?= ucfirst($pendaftaran['status']) ?>
                    </span>
                </div>
            </div>
            
            <?php if ($pendaftaran['tipe_pendaftaran'] === 'perorangan'): ?>
                <div class="text-base font-semibold text-gray-800">
                    Harga Tiket: <?= htmlspecialchars($pendaftaran['event']['harga_pendaftaran']) ?>
                </div>
                <div class="text-base font-semibold text-gray-800">
                    Peserta: <?= htmlspecialchars($pendaftaran['perorangan']['nama_lengkap']) ?>
                </div>

                
            <?php elseif ($pendaftaran['tipe_pendaftaran'] === 'kelompok'): ?>
                <div class="text-base font-semibold text-gray-800">
                    Harga Tiket: <?= htmlspecialchars($pendaftaran['event']['harga_pendaftaran']) ?>
                </div>
                <div class="text-base font-semibold text-gray-800">
                    Kelompok: <?= htmlspecialchars($pendaftaran['kelompok']['nama_kelompok']) ?>
                </div>
                
                
                <button onclick="toggleAnggota('anggota-<?= $pendaftaran['id'] ?>')" class="text-sm text-blue-600 hover:underline mt-2">
                    Lihat anggota kelompok
                </button>

                <!-- Detail anggota -->
                <div id="anggota-<?= $pendaftaran['id'] ?>" class="mt-3 space-y-2 hidden">
                    <?php foreach ($pendaftaran['kelompok']['anggota_kelompok'] as $i => $anggota): ?>
                    <div class="text-sm text-gray-700">
                        <strong><?= $i + 1 ?>.</strong> 
                        <?= htmlspecialchars($anggota['nama_anggota']) ?> 
                        (<?= htmlspecialchars($anggota['no_hp']) ?>)
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="flex justify-end mt-3 gap-4">
                <button class="px-4 py-2 border border-gray-300 text-sm rounded-md hover:bg-gray-100 transition" onclick="window.print()">
                    <i class="fas fa-print mr-1"></i> Print
                </button>
                <?php if ($pendaftaran['status'] !== 'diterima'): ?>
                <form action="{{ route('checkout') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="pendaftaran_id" value="<?= htmlspecialchars($pendaftaran['id']) ?>">
                    <button type="submit" style="background-color: #251f77;" class="px-4 py-2 text-white text-sm rounded-md hover:opacity-90 transition">
                        <i class="fas fa-money-bill-wave mr-1"></i> Bayar
                    </button>
                </form>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>

        <!-- Pagination -->
        <div class="flex justify-center mt-6">
            <div class="flex space-x-2">
                <button class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-100 transition">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-100 transition">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

    <footer class="mt-10 bg-[#5d7ef3] text-white text-center py-4">
        <div class="text-sm">
            &copy; 2025 Event Registration. All rights reserved.
        </div>
        <div class="mt-1 text-xs">
            Developed with 💙 by YourTeamName
        </div>
    </footer>

    <script>
        function toggleAnggota(id) {
            const list = document.getElementById(id);
            list.classList.toggle("hidden");
        }
    </script>
</body>

</html>