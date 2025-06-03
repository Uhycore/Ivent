<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Event Kelompok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
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
                <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    Filter by
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownHover"
                    class="z-10 hidden bg-white divide-y divide-white-100 rounded-sm shadow-sm w-44">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-900 bg-white"
                        aria-labelledby="dropdownHoverButton">
                        <li>
                            <a href="#" class="block px-4 py-2 dark:hover:text-black">Upcoming</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 dark:hover:text-black">Past</a>
                        </li>
                    </ul>
                </div>
                <form class="flex-1">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="search" placeholder="Ketik sini..."
                            class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500" />
                        <button type="submit"
                            class="text-white absolute end-2 bottom-1.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
    <table class="table-auto w-full bg-white border border-gray-200 shadow-sm rounded text-xs">
        <thead class="bg-gray-100 text-gray-600 uppercase">
            <tr>
                <th class="px-2 py-2 whitespace-nowrap">#</th>
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
        <tbody>
            @foreach ($event as $events)
                <tr class="hover:bg-gray-50 text-gray-700">
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
</div>

        </main>
    </div>

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
</body>

</html>
