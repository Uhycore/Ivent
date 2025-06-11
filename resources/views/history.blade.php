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
            background-color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 80px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-30 bg-gradient-to-r from-[#b7bfff] to-[#c9cfff] shadow-md px-6 py-4 flex items-center justify-between animate-fade-down">
        <div class="flex items-center space-x-2">
            <h1 class="text-xl font-bold text-white tracking-wide">IVENT | <span class="text-black">Keranjang Event</span></h1>
        </div>

        <div class="hidden md:block">
            <button onclick="window.location.href='../index.php'" class="bg-white text-[#879ff7] border border-indigo-300 rounded-full px-4 py-2 font-medium hover:bg-indigo-100 transition duration-300">
            Explore Events
            </button>
        </div>
    </nav>



    <div class="w-full flex justify-center mt-6">
    <input id="searchEvent" type="text" placeholder="Cari event..." 
           class="w-[90%] md:w-[60%] px-4 py-2 border border-gray-300 rounded-lg shadow-sm 
                  focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
</div>




    
    <div id="pendaftaranList" class="w-full sm:w-[95%] md:w-[90%] lg:w-[80%] xl:w-[75%] mx-auto bg-white rounded-2xl shadow-md p-6 my-6 border border-gray-200">
        <?php foreach ($pendaftaranList as $pendaftaran): ?>
        <!-- Card Tiket -->
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-5 my-6 space-y-4 hover:shadow-xl transition-all ring-1 ring-purple-100"
     data-nama="<?= strtolower($pendaftaran['event']['nama_event']) ?>">

            <div class="flex justify-between items-center text-sm font-semibold text-gray-700">
                <span class="text-sm text-gray-500 mt-1">
                    <i class="fa fa-calendar mr-1"></i><?= htmlspecialchars($pendaftaran['tanggal_daftar']) ?>
                </span>
                <span class="<?= $pendaftaran['tipe_pendaftaran'] === 'perorangan' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800' ?> text-xs font-semibold px-2.5 py-0.5 rounded-full">
                    <?= ucfirst($pendaftaran['tipe_pendaftaran']) ?>
                </span>
            </div>
            
            <div class="flex gap-4">
                <img src="{{ asset('storage/' . $pendaftaran['event']['gambar']) }}" alt="Gambar Event" class="w-24 h-24 object-cover rounded-md" />
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
                <button class="px-4 py-2 border border-gray-300 text-sm rounded-md hover:bg-gray-100 transition" href="{{ route('invoice', ['id' => $pendaftaran['id']]) }}" target="_blank">
                    <i class="fas fa-print mr-1"></i> invoice
                </button>
                <?php if ($pendaftaran['status'] !== 'diterima'): ?>
                <form action="{{ route('checkout') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="pendaftaran_id" value="<?= htmlspecialchars($pendaftaran['id']) ?>">
                    <button type="submit" style="background-color: #829cfc;" class="px-4 py-2 text-white text-sm rounded-md hover:opacity-90 transition">
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

    <footer class="mt-10 bg-[#c9cfff] text-grey-500 text-center py-4  bottom-0 left-0 right-0 fixed">
        <div class="text-sm">
            &copy; 2025 Event Registration. All rights reserved.
        </div>
        <div class="mt-1 text-xs">
            Developed with Ivennt Teams
        </div>
    </footer>

    <script>
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
        function toggleAnggota(id) {
            const list = document.getElementById(id);
            list.classList.toggle("hidden");
        }
    </script>

  
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchEvent');
        const cards = document.querySelectorAll('#pendaftaranList [data-nama]');


        searchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase().trim();

            cards.forEach(card => {
                const namaEvent = card.dataset.nama;
                if (namaEvent.includes(query)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>

</body>

</html>