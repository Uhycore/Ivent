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

<body class="flex h-screen bg-gray-100">
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

                <div class="mb-4">
                    <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-200 text-sm">
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
                                        <span class="px-2 py-1 rounded text-white text-xs
                                            @if ($trx['status'] === 'paid') bg-green-500
                                            @elseif($trx['status'] === 'unpaid') bg-red-500
                                            @else bg-gray-400 @endif">
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
                                                class="bg-red-500 hover:bg-red-600 text-white text-xs px-2 py-1 rounded transition duration-200">
                                                Hapus
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
