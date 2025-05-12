<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-base-200">
    <div class="drawer lg:drawer-open">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />

        <div class="drawer-content flex flex-col">
            <!-- Navbar -->

            @include('admin.navbar')

            <!-- Page content -->
            <div class="p-4 md:p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">User Management</h1>
                    <a href="{{ route('admin.pengguna.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus mr-2"></i> Add New User
                    </a>
                </div>

                <!-- Search and filter -->
                <div class="flex flex-col md:flex-row gap-4 mb-6">
                    <div class="form-control flex-1">
                        <div class="input-group">
                            <input type="text" placeholder="Search users..." class="input input-bordered w-full" />
                            <button class="btn btn-square">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    {{-- <select class="select select-bordered w-full md:w-auto">
                        <option disabled selected>Filter by status</option>
                        <option>Active</option>
                        <option>Inactive</option>
                        <option>Pending</option>
                    </select> --}}
                </div>

                <!-- Users table -->
                <div class="overflow-x-auto bg-base-100 rounded-lg shadow">
                    <table class="table w-full">
                        <thead>
                            <tr>

                                <th>No</th>
                                <th>Username</th>
                                <th>No HP</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($pengguna as $penggunas)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $penggunas->user->username }}</td>
                                    <td>{{ $penggunas->no_hp }}</td>
                                    <td>{{ $penggunas->alamat }}</td>
                                    <td>
                                        <div class="flex gap-2">
                                            <a href="edit-user.html?id=1" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-error">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="flex justify-between items-center mt-6">
                    <div class="text-sm text-gray-500">
                        Showing 1-5 of 25 users
                    </div>
                    <div class="join">
                        <button class="join-item btn">«</button>
                        <button class="join-item btn btn-active">1</button>
                        <button class="join-item btn">2</button>
                        <button class="join-item btn">3</button>
                        <button class="join-item btn">4</button>
                        <button class="join-item btn">»</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        @include('admin.sidebar')

    </div>

    <script>
        // Simple toggle for mobile menu
        document.addEventListener('DOMContentLoaded', function() {
            const drawer = document.getElementById('my-drawer');

            // Close drawer when clicking on menu items on mobile
            if (window.innerWidth < 1024) {
                const menuItems = document.querySelectorAll('.drawer-side .menu a');
                menuItems.forEach(item => {
                    item.addEventListener('click', () => {
                        drawer.checked = false;
                    });
                });
            }
        });
    </script>
</body>

</html>
