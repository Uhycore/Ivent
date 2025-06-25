<!DOCTYPE html>
<html lang="en" class="h-screen">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/notification.js') }}"></script>
</head>

<body class="flex h-screen bg-gray-100 mt-16">
    <!-- Sidebar -->
    @include('admin.sidebar')

    <!-- Main Content -->
    <div class="md:pl-56 flex-1 flex flex-col min-h-screen">
        <!-- Navbar -->
        @include('admin.navbar')

        <!-- Main Body -->
        <main class="p-6 bg-gray-100 dark:bg-gray-100 flex-1 overflow-y-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Daftar Transaksi</h1>
            </div>
            <!-- Tabel Transaksi -->
            <form id="bulkDeleteForm" action="{{ route('admin.transaksi.bulkDelete') }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex flex-wrap gap-4 mb-4 items-center">
                    <button type="submit"
                        class="text-white flex bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Hapus Terpilih
                    </button>
                    <!-- <div class="flex items-center gap-3">
                        <label for="tanggalFilter" class="text-sm font-medium text-gray-700 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1">
                            Filter Tanggal
                            </span>
                        </label>
                        <input
                            type="date"
                            id="tanggalFilter"
                            name="tanggal"
                            class="text-sm border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm hover:shadow-md"/>
                    </div> -->
                    <div class="flex items-center gap-3">
                        <label for="statusFilter" class="text-sm font-medium text-gray-700 whitespace-nowrap">
                            Status
                        </label>
                        <select id="statusFilter" class="text-sm border border-gray-300 rounded-md px-3 py-2">
                            <option value="">Semua</option>
                            <option value="paid">Paid</option>
                            <option value="unpaid">Unpaid</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-3">
                        <label for="tanggalFilter" class="text-sm font-medium text-gray-700 whitespace-nowrap">
                            Tanggal
                        </label>
                        <input type="date" id="tanggalFilter"
                            class="text-sm border border-gray-300 rounded-md px-3 py-2" />
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
                <!-- Table Wrapper for Responsive -->
                <div class="overflow-x-auto shadow rounded border border-gray-200">
                    <table class="min-w-full table-fixed bg-white border border-gray-200 text-sm">
                        <thead class="bg-gray-100 text-gray-600 uppercase">
                            <tr>
                                <th class="px-3 py-3 border-b w-10">
                                    <input type="checkbox" id="select-all"
                                        class="form-checkbox h-4 w-4 text-blue-600 rounded focus:ring-blue-500">
                                </th>
                                <th class="px-3 py-3 border-b w-10">No</th>
                                <th class="px-3 py-3 border-b w-24">ID Pendaftar</th>
                                <th class="px-3 py-3 border-b w-28">Kode Transaksi</th>
                                <th class="px-3 py-3 border-b w-28">Username</th>
                                <th class="px-3 py-3 border-b w-40">Nama Event</th>
                                <th class="px-3 py-3 border-b w-32">Jumlah Bayar</th>
                                <th class="px-3 py-3 border-b w-20">Status</th>
                                <th class="px-3 py-3 border-b w-28">Tanggal</th>
                                <th class="px-3 py-3 border-b w-20 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($transaksiList as $trx)
                                <tr class="hover:bg-gray-50 text-gray-700"
                                    data-status="{{ strtolower($trx['status']) }}"
                                    data-tanggal="{{ date('Y-m-d', strtotime($trx['created_at'])) }}"
                                    data-event="{{ strtolower($trx['event']['nama_event']) }}">

                                    <td class="px-3 py-2 border-b">
                                        <input type="checkbox" name="selected[]" value="{{ $trx['id'] }}"
                                            class="form-checkbox h-4 w-4 text-blue-600 rounded focus:ring-blue-500">
                                    </td>
                                    <td class="px-3 py-2 border-b">{{ $loop->iteration }}</td>
                                    <td class="px-3 py-2 border-b truncate">{{ $trx['pendaftaran_id'] }}</td>
                                    <td class="px-3 py-2 border-b truncate">{{ $trx['kode_transaksi'] }}</td>
                                    <td class="px-3 py-2 border-b truncate">{{ $trx['user']['username'] }}</td>
                                    <td class="px-3 py-2 border-b truncate">{{ $trx['event']['nama_event'] }}</td>
                                    <td class="px-3 py-2 border-b truncate">
                                        Rp{{ number_format($trx['jumlah_bayar'], 0, ',', '.') }}
                                    </td>
                                    <td class="px-3 py-2 border-b">
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold
                                            @if ($trx['status'] === 'paid') bg-green-100 text-green-800
                                            @elseif($trx['status'] === 'unpaid') bg-red-100 text-red-800
                                            @else bg-gray-200 text-gray-700 @endif">

                                            @if ($trx['status'] === 'paid')
                                                <svg class="w-3.5 h-3.5 text-green-500" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414L8.414 15H6v-2.414l8.293-8.293a1 1 0 011.414 0zM5 16a1 1 0 001 1h2a1 1 0 001-1v-2H7a2 2 0 00-2 2z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @elseif ($trx['status'] === 'unpaid')
                                                <svg class="w-3.5 h-3.5 text-red-500" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11.414L11.414 6 10 7.414 8.586 6 8 6.586 9.414 8 8 9.414 8.586 10 10 8.586 11.414 10 12 9.414 10.586 8 12 6.586 11.414 6 10 7.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @endif

                                            {{ ucfirst($trx['status']) }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-2 border-b">{{ date('d-m-Y', strtotime($trx['created_at'])) }}
                                    </td>
                                    <td class="px-3 py-2 border-b text-center">
                                        <form action="{{ route('admin.transaksi.delete', $trx['id']) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700"
                                                onclick="return confirm('Yakin ingin menghapus event ini?')">
                                                <span class="material-symbols-rounded text-sm">delete</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- aril --}}
                    <div class="flex justify-first" id="pagination-controls"></div>

                </div>
            </form>
        </main>
    </div>

    {{-- aril --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const tanggalFilter = document.getElementById('tanggalFilter');
            const statusFilter = document.getElementById('statusFilter');
            const paginationContainer = document.getElementById('pagination-controls');
            const rowsPerPage = 10;
            let currentPage = 1;

            function getAllRows() {
                return Array.from(document.querySelectorAll('tbody tr'));
            }

            function getFilteredRows() {
                const searchTerm = searchInput?.value.toLowerCase() || '';
                const tanggal = tanggalFilter?.value || '';
                const status = statusFilter?.value.toLowerCase() || '';

                return getAllRows().filter(row => {
                    const eventName = row.getAttribute('data-event') || '';
                    const rowStatus = row.getAttribute('data-status') || '';
                    const rowTanggal = row.getAttribute('data-tanggal') || '';

                    const cocokSearch = eventName.includes(searchTerm);
                    const cocokTanggal = !tanggal || rowTanggal === tanggal;
                    const cocokStatus = !status || rowStatus === status;

                    return cocokSearch && cocokTanggal && cocokStatus;
                });
            }

            function displayRows(page, filteredRows) {
                const start = (page - 1) * rowsPerPage;
                const end = start + rowsPerPage;

                getAllRows().forEach(row => row.style.display = 'none');
                filteredRows.slice(start, end).forEach(row => row.style.display = '');
            }

            function setupPagination(filteredRows) {
                const pageCount = Math.ceil(filteredRows.length / rowsPerPage);
                paginationContainer.innerHTML = '';
                if (pageCount <= 1) return;

                const createButton = (text, disabled, onClick, isActive = false) => {
                    const btn = document.createElement('button');
                    btn.textContent = text;
                    btn.className =
                        `mx-1 px-3 py-1 border rounded ${isActive ? 'bg-black text-white' : 'bg-white text-black hover:bg-blue-100'} ${disabled ? 'opacity-50 cursor-not-allowed' : ''}`;
                    btn.disabled = disabled;
                    if (!disabled) btn.addEventListener('click', onClick);
                    return btn;
                };


                paginationContainer.appendChild(createButton('First', currentPage === 1, () => {
                    currentPage = 1;
                    applyFilterAndPaginate(false);
                }));


                paginationContainer.appendChild(createButton('<', currentPage === 1, () => {
                    currentPage--;
                    applyFilterAndPaginate(false);
                }));


                let start = currentPage - 2;
                let end = currentPage + 2;

                // Biar start gak kurang dari 1
                if (start < 1) {
                    end += (1 - start);
                    start = 1;
                }

                // Biar end gak lebih dari total halaman
                if (end > pageCount) {
                    start -= (end - pageCount);
                    end = pageCount;
                }

                // Jaga biar tetap minimal di 1
                start = Math.max(1, start);


                for (let i = start; i <= end; i++) {
                    paginationContainer.appendChild(createButton(i, false, () => {
                        currentPage = i;
                        applyFilterAndPaginate(false);
                    }, i === currentPage));
                }


                paginationContainer.appendChild(createButton('>', currentPage === pageCount, () => {
                    currentPage++;
                    applyFilterAndPaginate(false);
                }));

                paginationContainer.appendChild(createButton('Last', currentPage === pageCount, () => {
                    currentPage = pageCount;
                    applyFilterAndPaginate(false);
                }));
            }



            function applyFilterAndPaginate(resetPage = true) {
                const filteredRows = getFilteredRows();
                if (resetPage) currentPage = 1;

                displayRows(currentPage, filteredRows);
                setupPagination(filteredRows);
            }


            [searchInput, tanggalFilter, statusFilter].forEach(input => {
                if (input) input.addEventListener('input', () => applyFilterAndPaginate(true));
                if (input?.type === 'date') input.addEventListener('change', () => applyFilterAndPaginate(
                    true));
            });


            applyFilterAndPaginate();
        });
    </script>




    <!-- Checkbox Select All Script -->
    <script>
        document.getElementById('bulkDeleteForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Cegah submit default

            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Simpan pesan sukses sebelum submit
                    localStorage.setItem('success_message', 'Transaksi berhasil dihapus.');
                    // Submit form secara manual
                    e.target.submit();
                }
            });
        });

        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('input[name="selected[]"]');
            for (const checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        });
    </script>

    @if (session('success'))
        <script>
            localStorage.setItem('success_message', "{{ session('success') }}");
        </script>
    @endif

    @if (session('error'))
        <script>
            localStorage.setItem('error_message', "{{ session('error') }}");
        </script>
    @endif


    {{-- firman --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput'); // pencarian umum
            const tanggalFilter = document.getElementById('tanggalFilter'); // filter tanggal
            const statusFilter = document.getElementById('statusFilter'); // filter status
            const eventFilter = document.getElementById('eventFilter'); // filter nama event
            const rows = document.querySelectorAll('tbody tr');

            function filterRows() {
                const searchTerm = searchInput?.value.toLowerCase() || '';
                const tanggal = tanggalFilter?.value || '';
                const status = statusFilter?.value.toLowerCase() || '';
                const eventText = eventFilter?.value.toLowerCase() || '';

                rows.forEach(row => {
                    const eventName = row.getAttribute('data-event') || '';
                    const rowStatus = row.getAttribute('data-status') || '';
                    const rowTanggal = row.getAttribute('data-tanggal') || '';

                    const cocokSearch = eventName.includes(searchTerm);
                    const cocokTanggal = !tanggal || rowTanggal === tanggal;
                    const cocokStatus = !status || rowStatus === status;
                    const cocokEvent = !eventText || eventName.includes(eventText);

                    row.style.display = (cocokSearch && cocokTanggal && cocokStatus && cocokEvent) ? '' :
                        'none';
                });
            }

            if (searchInput) searchInput.addEventListener('input', filterRows);
            if (tanggalFilter) tanggalFilter.addEventListener('change', filterRows);
            if (statusFilter) statusFilter.addEventListener('change', filterRows);
            if (eventFilter) eventFilter.addEventListener('input', filterRows);
        });
    </script> --}}




</body>

</html>
