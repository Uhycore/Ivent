<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manajemen Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <script src="{{ asset('js/notification.js') }}"></script>

    <style>
        .transition-width {
            transition: width 0.3s;
        }
    </style>
</head>

<body class="flex h-screen bg-gray-100 mt-16">
    @include('admin.sidebar')

    <div class="flex-1 flex flex-col">
        @include('admin.navbar')

        <main class="flex-1 p-6 ml-64">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Pengguna</h1>
                <button onclick="window.location.href='{{ route('admin.pengguna.create') }}'"
                    class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 z-10">
                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">
                        Tambah Pengguna
                    </span>
                </button>
            </div>

                <!-- Search -->
            <div class="flex flex-wrap gap-4 mb-4 items-center">
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
                        <input type="search" id="search" placeholder="Ketik di sini..."
                            class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500" />
                        <button type="submit"
                            class="text-white absolute end-2 bottom-1.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 shadow rounded">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                        <tr>
                            <th class="text-left px-6 py-3 border-b">No</th>
                            <th class="text-left px-6 py-3 border-b">Username</th>
                            <th class="text-left px-6 py-3 border-b">Email</th>
                            <th class="text-left px-6 py-3 border-b">No HP</th>
                            <th class="text-left px-6 py-3 border-b">Alamat</th>
                            <th class="text-center px-6 py-3 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="userTable" class="text-sm">
                        @foreach ($pengguna as $penggunas)
                            <tr class="hover:bg-gray-50 text-gray-700">
                                <td class="px-6 py-4 border-b">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 border-b">{{ $penggunas->user->username }}</td>
                                <td class="px-6 py-4 border-b">{{ $penggunas->user->email }}</td>
                                <td class="px-6 py-4 border-b">{{ $penggunas->no_hp }}</td>
                                <td class="px-6 py-4 border-b">{{ $penggunas->alamat }}</td>
                                <td class="px-6 py-4 border-b text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('admin.pengguna.edit', $penggunas->user->id) }}"
                                            class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.pengguna.delete', $penggunas->user->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
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
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search');
        const userTable = document.getElementById('userTable');
        const rows = userTable.getElementsByTagName('tr');

        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase();

            Array.from(rows).forEach(row => {
                const cells = row.getElementsByTagName('td');
                let textContent = '';
                
                // Gabungkan semua isi teks dari kolom username, email, no hp, alamat
                for (let i = 1; i <= 4; i++) {
                    textContent += cells[i].textContent.toLowerCase() + ' ';
                }

                // Tampilkan baris jika cocok dengan keyword
                row.style.display = textContent.includes(keyword) ? '' : 'none';
            });
        });
    });
</script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
</body>

</html>