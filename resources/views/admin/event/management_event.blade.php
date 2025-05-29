<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Event Kelompok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

</head>

<body class="flex h-screen bg-gray-100">
    @include('admin.sidebar')
    <div class="flex-1 flex flex-col">
        @include('admin.navbar')
        <main class="flex-1 p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Event Kelompok</h1>
                <button onclick="window.location.href='{{ route('admin.event.create') }}'"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">+ Create
                    Event</button>
            </div>

            <div class="flex flex-wrap gap-4 mb-4">
                <select class="border-gray-300 rounded px-4 py-2 shadow text-gray-700">
                    <option value="">Filter by...</option>
                    <option value="upcoming">Upcoming</option>
                    <option value="past">Past</option>
                </select>
                <input type="text" placeholder="Search by name..."
                    class="flex-1 border border-gray-300 rounded px-4 py-2 shadow" />
            </div>
            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 shadow rounded">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                        <tr>
                            <th class="text-left px-6 py-3 border-b">ID</th>
                            <th class="text-left px-6 py-3 border-b">Nama Event</th>
                            <th class="text-left px-6 py-3 border-b">Tanggal</th>
                            <th class="text-left px-6 py-3 border-b">Deskripsi</th>
                            <th class="text-left px-6 py-3 border-b">Tipe Event</th>
                            <th class="text-center px-6 py-3 border-b">Kuota</th>
                            <th class="text-center px-6 py-3 border-b">Max Anggota Kelompok</th>
                            <th class="text-left px-6 py-3 border-b">Gambar</th>
                            <th class="text-left px-6 py-3 border-b">Harga pendaftaran</th>
                            <th class="text-center px-6 py-3 border-b">Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event as $events)
                            <tr class="hover:bg-gray-50 text-gray-700">
                                <td class="px-6 py-4 border-b">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 border-b">{{ $events->nama_event }}</td>
                                <td class="px-6 py-4 border-b">
                                    {{ \Carbon\Carbon::parse($events->tanggal)->format('d-m-Y') }}</td>
                                <td class="px-6 py-4 border-b">{{ $events->deskripsi }}</td>
                                <td class="px-6 py-4 border-b capitalize">{{ $events->tipe_event }}</td>
                                <td class="px-6 py-4 border-b text-center">{{ $events->kuota }}</td>
                                <td class="px-6 py-4 border-b text-center">
                                    {{ $events->max_anggota_kelompok ?? '-' }}
                                </td>
                                <td class="px-6 py-4 border-b">
                                    @if ($events->gambar)
                                        <img src="{{ asset('storage/' . $events->gambar) }}" alt="Gambar Event"
                                            class="w-16 h-16 object-cover rounded">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 border-b text-center">Rp. {{ $events->harga_pendaftaran }}</td>
                                <td class="px-6 py-4 border-b text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('admin.event.edit', $events->id) }}"
                                            class="bg-green-500 hover:bg-green-600 text-white text-sm px-3 py-1 rounded mr-2">
                                            Update
                                        </a>
                                        <form action="{{ route('admin.event.delete', $events->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded"
                                                onclick="return confirm('Yakin ingin menghapus event ini?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </main>

    </div>

</body>


</html>
