<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex h-screen bg-gray-100">
    @include('admin.sidebar')
    <div class="flex-1 flex flex-col">
        @include('admin.navbar')
        <main class="flex-1 p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Daftar Transaksi</h1>
            </div>

            <!-- Tabel Transaksi -->
            <div class="overflow-x-auto">
                <form action="{{ route('admin.transaksi.bulkDelete') }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus transaksi terpilih?')">
                    @csrf
                    @method('DELETE')

                    <div class="mb-4">
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                            Hapus Terpilih
                        </button>
                    </div>

                    <!-- tabel mulai di sini -->
                    <table class="min-w-full bg-white border border-gray-200 shadow rounded">
                        <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                            <tr>
                                <th class="text-left px-6 py-3 border-b">
                                    <input type="checkbox" id="select-all" class="form-checkbox h-4 w-4 text-blue-600">
                                </th>
                                <th class="text-left px-6 py-3 border-b">No</th>
                                <th class="text-left px-6 py-3 border-b">Kode Transaksi</th>
                                <th class="text-left px-6 py-3 border-b">Username</th>
                                <th class="text-left px-6 py-3 border-b">Nama Event</th>
                                <th class="text-left px-6 py-3 border-b">Jumlah Bayar</th>
                                <th class="text-left px-6 py-3 border-b">Status</th>
                                <th class="text-left px-6 py-3 border-b">Tanggal</th>
                                <th class="text-center px-6 py-3 border-b">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($transaksiList as $trx)
                                <tr class="hover:bg-gray-50 text-gray-700">
                                    <td class="px-6 py-4 border-b">
                                        <input type="checkbox" name="selected[]" value="{{ $trx['id'] }}"
                                            class="form-checkbox h-4 w-4 text-blue-600">
                                    </td>
                                    <td class="px-6 py-4 border-b">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 border-b">{{ $trx['kode_transaksi'] }}</td>
                                    <td class="px-6 py-4 border-b">{{ $trx['user']['username'] }}</td>
                                    <td class="px-6 py-4 border-b">{{ $trx['event']['nama_event'] }}</td>
                                    <td class="px-6 py-4 border-b">
                                        Rp{{ number_format($trx['jumlah_bayar'], 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 border-b">
                                        <span
                                            class="px-2 py-1 rounded text-white text-sm
                                        @if ($trx['status'] === 'paid') bg-green-500
                                        @elseif($trx['status'] === 'unpaid') bg-red-500
                                        @else bg-gray-400 @endif">
                                            {{ ucfirst($trx['status']) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 border-b">{{ date('d-m-Y', strtotime($trx['created_at'])) }}
                                    </td>
                                    <td class="px-6 py-4 border-b text-center">
                                        <form action="{{ route('admin.transaksi.delete', $trx['id']) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </main>
    </div>
    <script>
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('input[name="selected[]"]');
            for (const checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        });
    </script>

</body>

</html>
