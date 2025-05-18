<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manajemen Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .transition-width {
            transition: width 0.3s;
        }
    </style>
</head>

<body class="flex h-screen bg-gray-100">
    @include('admin.sidebar')
    <div class="flex-1 flex flex-col">
        @include('admin.navbar')
        <main class="flex-1 p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Pengguna</h1>
                <button onclick="window.location.href='{{ route('admin.pengguna.create') }}'"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">Create Penguuna</button>
            </div>


            <!-- Filter and Search -->
            <div class="flex flex-wrap gap-4 mb-4">
                <select class="border-gray-300 rounded px-4 py-2 shadow text-gray-700">
                    <option value="">Filter by...</option>
                    <option value="admin">Admin</option>
                    <option value="customer">Customer</option>
                </select>
                <input type="text" placeholder="Search by name..."
                    class="flex-1 border border-gray-300 rounded px-4 py-2 shadow" />
            </div>
            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 shadow rounded">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                        <tr>
                            <th class="text-left px-6 py-3 border-b">NO</th>
                            <th class="text-left px-6 py-3 border-b">Username</th>
                            <th class="text-left px-6 py-3 border-b">NO HP</th>
                            <th class="text-left px-6 py-3 border-b">Alamat</th>
                            <th class="text-center px-6 py-3 border-b">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($admin as $admins)
                            <tr class="hover:bg-gray-50 text-gray-700">
                                <td class="px-6 py-4 border-b">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 border-b">{{ $admins->user->username }}</td>
                                <td class="px-6 py-4 border-b">{{ $admins->no_hp }}</td>
                                <td class="px-6 py-4 border-b">{{ $admins->alamat }}</td>
                                <td class="px-6 py-4 border-b text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('admin.pengguna.edit', $admins->user->id) }}"
                                            class="bg-green-500 hover:bg-green-600 text-white text-sm px-3 py-1 rounded mr-2">
                                            Update
                                        </a>
                                        <form action="{{ route('admin.pengguna.delete', $admins->user->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded"
                                                onclick="return confirm('Yakin ingin menghapus user ini?')">
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
