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
                <div class="mb-4 flex flex-wrap items-center gap-4 justify-between">
                    <div class="flex items-center gap-3">
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
                        </div>

                    <button type="submit" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Hapus Terpilih
                    </button>
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
                                <tr class="hover:bg-gray-50 text-gray-700">
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
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold
                                            @if ($trx['status'] === 'paid') bg-green-100 text-green-800
                                            @elseif($trx['status'] === 'unpaid') bg-red-100 text-red-800
                                            @else bg-gray-200 text-gray-700 @endif">
                                            
                                            @if ($trx['status'] === 'paid')
                                                <svg class="w-3.5 h-3.5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L8.414 15H6v-2.414l8.293-8.293a1 1 0 011.414 0zM5 16a1 1 0 001 1h2a1 1 0 001-1v-2H7a2 2 0 00-2 2z" clip-rule="evenodd"/>
                                                </svg>
                                            @elseif ($trx['status'] === 'unpaid')
                                                <svg class="w-3.5 h-3.5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11.414L11.414 6 10 7.414 8.586 6 8 6.586 9.414 8 8 9.414 8.586 10 10 8.586 11.414 10 12 9.414 10.586 8 12 6.586 11.414 6 10 7.414z" clip-rule="evenodd"/>
                                                </svg>
                                            @endif

                                            {{ ucfirst($trx['status']) }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-2 border-b">{{ date('d-m-Y', strtotime($trx['created_at'])) }}</td>
                                    <td class="px-3 py-2 border-b text-center">
                                        <form action="{{ route('admin.transaksi.delete', $trx['id']) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700"
                                                onclick="return confirm('Yakin ingin menghapus event ini?')">
                                                <span class="material-symbols-rounded text-sm">delete</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </main>
    </div>


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

        document.getElementById('select-all').addEventListener('change', function () {
            const checkboxes = document.querySelectorAll('input[name="selected[]"]');
            for (const checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        });
    </script>

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

 
</body>

</html>
