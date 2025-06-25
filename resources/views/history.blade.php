<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
    <section class="navbar fixed ml-0 top-0 left-0 right-0 z-[100] px-[50px] py-[6px] flex justify-between items-center bg-[#ebedff] shadow-md rounded-[30px] transition-all duration-300 ease-in-out">
        <div class="logo" data-aos="fade-right" data-aos-duration="2000">
            <p>Ivent</p>
        </div>
        <ul data-aos="fade-down" data-aos-duration="2000">
            <li><a href="../landing_pages">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#event">Event</a></li>
            @auth
                <a href="{{ route('history') }}">
                <li>My ticket</li>
                </a>
            @else
                <span class="disabled-link">
                <li style="color: gray; cursor: not-allowed;">My ticket</li>
                </span>
            @endauth
        </ul>
        <div class="logout" data-aos="fade-left" data-aos-duration="2000">
            <div class="auth-buttons">
                @if (Auth::check())
                    <!-- Jika user sudah login -->
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <span class="text-gray-700 font-medium">Halo, {{ Auth::user()->username }}</span>
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded ml-4">
                            Logout
                        </button>
                    </form>
                @else
                    <!-- Jika belum login -->
                    <button onclick="openLogin()" type="button"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Login
                    </button>
                @endif
            </div>
        </div>
    </section>
    {{-- Card Pesanan --}}
    <div class="w-full flex justify-center mt-[50px]">
        <input id="searchEvent" type="text" placeholder="Cari event..." 
           class="w-[90%] md:w-[60%] px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
    </div>
    <div id="pendaftaranList" class="w-full sm:w-[95%] md:w-[90%] lg:w-[80%] xl:w-[75%] mx-auto bg-white rounded-2xl shadow-md p-6 my-6 border border-gray-200">
        <?php foreach ($pendaftaranList as $pendaftaran): ?>
        <!-- Card Tiket -->
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-5 my-6 space-y-4 hover:shadow-xl transition-all ring-1 ring-purple-100 card-item"
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
                <div id="paginationWrapper" class="flex justify-center mt-6">
                    <div id="pagination" class="flex space-x-2"></div>
                </div>

    </div>
    {{-- Footer --}}
    <footer class="mt-10 bg-[#c9cfff] text-grey-500 text-center py-4  bottom-0 left-0 right-0">
        <div class="text-sm">
            &copy; 2025 Event Registration. All rights reserved.
        </div>
        <div class="mt-1 text-xs">
            Developed with Ivennt Teams
        </div>
    </footer>

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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cards = Array.from(document.querySelectorAll('.card-item'));
        const paginationContainer = document.getElementById('pagination');
        const cardsPerPage = 5;
        let currentPage = 1;

        function showPage(page) {
            const start = (page - 1) * cardsPerPage;
            const end = start + cardsPerPage;

            cards.forEach((card, index) => {
                card.style.display = (index >= start && index < end) ? '' : 'none';
            });

            renderPagination();
        }

        function renderPagination() {
            const totalPages = Math.ceil(cards.length / cardsPerPage);
            paginationContainer.innerHTML = '';

            // Tombol sebelumnya
            const prevBtn = document.createElement('button');
            prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
            prevBtn.className = 'px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-100 transition';
            prevBtn.disabled = currentPage === 1;
            prevBtn.onclick = () => {
                if (currentPage > 1) {
                    currentPage--;
                    showPage(currentPage);
                    scrollToCards();
                }
            };
            paginationContainer.appendChild(prevBtn);

            // Tombol halaman
            for (let i = 1; i <= totalPages; i++) {
                const btn = document.createElement('button');
                btn.textContent = i;
                btn.className = `px-4 py-2 border rounded-md ${i === currentPage ? 'bg-[#829cfc] text-white' : 'hover:bg-gray-100 text-gray-700 border-gray-300'}`;
                btn.onclick = () => {
                    currentPage = i;
                    showPage(currentPage);
                    scrollToCards();
                };
                paginationContainer.appendChild(btn);
            }

            // Tombol selanjutnya
            const nextBtn = document.createElement('button');
            nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
            nextBtn.className = 'px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-100 transition';
            nextBtn.disabled = currentPage === totalPages;
            nextBtn.onclick = () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    showPage(currentPage);
                    scrollToCards();
                }
            };
            paginationContainer.appendChild(nextBtn);
        }

        function scrollToCards() {
            const top = document.getElementById('pendaftaranList').offsetTop - 50;
            window.scrollTo({ top, behavior: 'smooth' });
        }

        // Inisialisasi awal
        showPage(currentPage);
    });
</script>


</body>

</html>