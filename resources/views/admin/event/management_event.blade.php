<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Event Kelompok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <script src="{{ asset('js/notification.js') }}"></script>
</head>

<body class="bg-gray-100 min-h-screen flex mt-16 z-0">
    @include('admin.sidebar')
    <div class="flex-1 flex flex-col">
        @include('admin.navbar')
        <!-- Content -->
        <main class="flex-1 p-6 ml-64">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Event</h1>
                <button onclick="window.location.href='{{ route('admin.event.create') }}'"
                    class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 z-10">
                    <span
                        class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">
                        Create Event
                    </span>
                </button>
            </div>

              <!-- Filter and Search -->
            <div class="flex flex-wrap gap-4 mb-4 items-center">
                
                <!-- Dropdown menu -->
                <div id="dropdownHover"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 p-2 space-y-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tipe</label>
                        <select id="filterTipe" class="border text-sm rounded px-2 py-1 w-full">
                            <option value="">Semua</option>
                            <option value="perorangan">Perorangan</option>
                            <option value="kelompok">Kelompok</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Harga</label>
                        <select id="filterHarga" class="border text-sm rounded px-2 py-1 w-full">
                            <option value="">Semua</option>
                            <option value="gratis">Gratis</option>
                            <option value="berbayar">Berbayar</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                        <select id="filterTanggal" class="border text-sm rounded px-2 py-1 w-full">
                            <option value="">Semua</option>
                            <option value="upcoming">Upcoming</option>
                            <option value="past">Past</option>
                        </select>
                    </div>
                </div>
                
                <div class="flex-1">
                    <label for="searchInput" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" id="searchInput" placeholder="Ketik di sini..."
                            class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
    <table class="table-auto w-full bg-white border border-gray-200 shadow-sm rounded text-xs">
        <thead class="bg-gray-100 text-gray-600 uppercase">
            <tr>
                <th class="px-2 py-2 whitespace-nowrap">NO</th>
                <th class="px-2 py-2 whitespace-nowrap">Nama</th>
                <th class="px-2 py-2 whitespace-nowrap">Tanggal</th>
                <th class="px-2 py-2 whitespace-nowrap">Deskripsi</th>
                <th class="px-2 py-2 whitespace-nowrap">Tipe</th>
                <th class="px-2 py-2 whitespace-nowrap text-center">Kuota</th>
                <th class="px-2 py-2 whitespace-nowrap text-center">Sisa</th>
                <th class="px-2 py-2 whitespace-nowrap text-center">Max</th>
                <th class="px-2 py-2 whitespace-nowrap">Poster</th>
                <th class="px-2 py-2 whitespace-nowrap">Harga</th>
                <th class="px-2 py-2 whitespace-nowrap text-center">Aksi</th>
            </tr>
        </thead>
        <tbody id="eventTableBody">
            @foreach ($event as $events)
                <tr class="hover:bg-gray-50 text-gray-700 row-item">
                    <td class="px-2 py-2">{{ $loop->iteration }}</td>
                    <td class="px-2 py-2">{{ $events->nama_event }}</td>
                    <td class="px-2 py-2">{{ \Carbon\Carbon::parse($events->tanggal)->format('d-m-Y') }}</td>
                    <td class="px-2 py-2">{{ Str::limit($events->deskripsi, 20) }}</td>
                    <td class="px-2 py-2 capitalize">{{ $events->tipe_event }}</td>
                    <td class="px-2 py-2 text-center">{{ $events->kuota }}</td>
                    <td class="px-2 py-2 text-center">{{ $events->sisa_kuota ?? '-' }}</td>
                    <td class="px-2 py-2 text-center">{{ $events->max_anggota_kelompok ?? '-' }}</td>
                    <td class="px-2 py-2">
                        @if ($events->gambar)
                            <img src="{{ asset('storage/' . $events->gambar) }}" alt="Gambar Event" class="w-10 h-10 object-cover rounded">
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-2 py-2 text-center">Rp{{ number_format($events->harga_pendaftaran, 0, ',', '.') }}</td>
                    <td class="px-2 py-2 text-center">
                        <div class="flex justify-center space-x-1">
                            <a href="{{ route('admin.event.edit', $events->id) }}"
                                class="text-blue-500 hover:text-blue-700">
                                <span class="material-symbols-rounded text-sm">edit_square</span>
                            </a>

                            <form action="{{ route('admin.event.delete', $events->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus event ini?')">
                                @csrf
                                <button type="submit"
                                    class="text-red-500 hover:text-red-700"
                                    onclick="return confirm('Yakin ingin menghapus event ini?')">
                                    <span class="material-symbols-rounded text-sm">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="paginationWrapper" class="sticky bottom-0 bg-white py-3 border-t border-gray-200 shadow-inner z-10">
                    <div id="pagination" class="flex justify-center gap-2"></div>
    </div>
</div>
        </main>
    </div>

@if(session('success'))
<script>
    localStorage.setItem('success_message', "{{ session('success') }}");
</script>
@endif

@if(session('error'))
<script>
    localStorage.setItem('error_message', "{{ session('error') }}");
</script>
@endif

    <script>
        function toggleCreateForm() {
            const form = document.getElementById('createEventForm');
            form.classList.toggle('hidden');
        }

        let collapsed = false;

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const logoText = document.getElementById('logoText');
            const menuTexts = document.querySelectorAll('.menu-text');

            collapsed = !collapsed;

            if (collapsed) {
                sidebar.classList.remove('w-64');
                sidebar.classList.add('w-20');
                logoText.classList.add('hidden');
                menuTexts.forEach(text => text.classList.add('hidden'));
            } else {
                sidebar.classList.remove('w-20');
                sidebar.classList.add('w-64');
                logoText.classList.remove('hidden');
                menuTexts.forEach(text => text.classList.remove('hidden'));
            }
        }
    </script>


 <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("searchInput");
            const filterTipe = document.getElementById("filterTipe");
            const filterHarga = document.getElementById("filterHarga");
            const filterTanggal = document.getElementById("filterTanggal");
            const rows = document.querySelectorAll("#eventTableBody tr");

            function filterTable() {
                const search = searchInput.value.toLowerCase();
                const tipe = filterTipe.value.toLowerCase();
                const harga = filterHarga.value;
                const tanggal = filterTanggal.value;
                const today = new Date();

                rows.forEach(row => {
                    const nama = row.children[1].textContent.toLowerCase();
                    const deskripsi = row.children[3].textContent.toLowerCase();
                    const tipeEvent = row.children[4].textContent.toLowerCase();
                    const hargaEvent = row.children[9].textContent.trim().replace(/[^\d]/g, '');
                    const tanggalEvent = row.children[2].textContent.trim();
                    
                    // Parse date (assuming format dd-mm-yyyy)
                    const [day, month, year] = tanggalEvent.split('-');
                    const eventDate = new Date(`${year}-${month}-${day}`);
                    
                    // Search matches
                    const matchSearch = search === '' || 
                                       nama.includes(search) || 
                                       deskripsi.includes(search);
                    
                    // Type matches
                    const matchTipe = tipe === '' || tipeEvent === tipe;
                    
                    // Price matches
                    const matchHarga = harga === '' ||
                                     (harga === "gratis" && parseInt(hargaEvent) === 0) ||
                                     (harga === "berbayar" && parseInt(hargaEvent) > 0);
                    
                    // Date matches
                    const matchTanggal = tanggal === '' ||
                                       (tanggal === "upcoming" && eventDate >= today) ||
                                       (tanggal === "past" && eventDate < today);

                    // Show/hide row based on all conditions
                    if (matchSearch && matchTipe && matchHarga && matchTanggal) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            }

            // Add event listeners
            searchInput.addEventListener("input", filterTable);
            filterTipe.addEventListener("change", filterTable);
            filterHarga.addEventListener("change", filterTable);
            filterTanggal.addEventListener("change", filterTable);
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const rows = Array.from(document.querySelectorAll('#eventTableBody .row-item'));
        const pagination = document.getElementById('pagination');
        const rowsPerPage = 10;
        let currentPage = 1;

        function displayRows() {
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            rows.forEach((row, index) => {
                row.style.display = index >= start && index < end ? '' : 'none';
            });

            renderPagination();
        }

        function renderPagination() {
            pagination.innerHTML = '';
            const pageCount = Math.ceil(rows.length / rowsPerPage);

            // Tombol Sebelumnya
            const prev = document.createElement('button');
            prev.innerHTML = '&larr;';
            prev.disabled = currentPage === 1;
            prev.className = `px-2 py-1 border rounded ${prev.disabled ? 'bg-gray-200 text-gray-400 cursor-not-allowed' : 'hover:bg-blue-100 text-gray-700'}`;
            prev.onclick = () => {
                if (currentPage > 1) {
                    currentPage--;
                    displayRows();
                    scrollToTable();
                }
            };
            pagination.appendChild(prev);

            // Tombol angka
            for (let i = 1; i <= pageCount; i++) {
                const btn = document.createElement('button');
                btn.textContent = i;
                btn.className = `px-3 py-1 rounded border ${i === currentPage ? 'bg-black text-white' : 'bg-white text-gray-700 hover:bg-blue-100'}`;
                btn.addEventListener('click', () => {
                    currentPage = i;
                    displayRows();
                    scrollToTable();
                });
                pagination.appendChild(btn);
            }

            // Tombol Selanjutnya
            const next = document.createElement('button');
            next.innerHTML = '&rarr;';
            next.disabled = currentPage === pageCount;
            next.className = `px-2 py-1 border rounded ${next.disabled ? 'bg-gray-200 text-gray-400 cursor-not-allowed' : 'hover:bg-blue-100 text-gray-700'}`;
            next.onclick = () => {
                if (currentPage < pageCount) {
                    currentPage++;
                    displayRows();
                    scrollToTable();
                }
            };
            pagination.appendChild(next);
        }

        function scrollToTable() {
            window.scrollTo({ top: 250, behavior: 'smooth' });
        }

        // Panggil pertama kali
        displayRows();
    });
</script>


</body>

</html>
