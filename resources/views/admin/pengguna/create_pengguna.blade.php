<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User - Admin Dashboard</title>
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
                    <h1 class="text-2xl font-bold">Add New User</h1>
                    <a href="index.html" class="btn btn-ghost">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Users
                    </a>
                </div>

                <!-- Add User Form -->
                <div class="bg-base-100 p-6 rounded-lg shadow-md">
                    <form>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Personal Information -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Username</span>
                                </label>
                                <input type="text" placeholder="Enter username" class="input input-bordered"
                                    required />
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Email</span>
                                </label>
                                <input type="email" placeholder="Enter email" class="input input-bordered" required />
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Password</span>
                                </label>
                                <input type="password" placeholder="Enter password" class="input input-bordered"
                                    required />
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Confirm Password</span>
                                </label>
                                <input type="password" placeholder="Confirm password" class="input input-bordered"
                                    required />
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Full Name</span>
                                </label>
                                <input type="text" placeholder="Enter full name" class="input input-bordered"
                                    required />
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">No HP</span>
                                </label>
                                <input type="tel" placeholder="Enter phone number" class="input input-bordered"
                                    required />
                            </div>

                            <div class="form-control md:col-span-2">
                                <label class="label">
                                    <span class="label-text">Alamat</span>
                                </label>
                                <textarea class="textarea textarea-bordered h-24" placeholder="Enter address" required></textarea>
                            </div>

                            <!-- User Role and Status -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">User Role</span>
                                </label>
                                <select class="select select-bordered w-full">
                                    <option disabled selected>Select role</option>
                                    <option>Admin</option>
                                    <option>Manager</option>
                                    <option>Staff</option>
                                    <option>User</option>
                                </select>
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Status</span>
                                </label>
                                <select class="select select-bordered w-full">
                                    <option disabled selected>Select status</option>
                                    <option>Active</option>
                                    <option>Inactive</option>
                                    <option>Pending</option>
                                </select>
                            </div>

                            <!-- Profile Picture -->
                            <div class="form-control md:col-span-2">
                                <label class="label">
                                    <span class="label-text">Profile Picture</span>
                                </label>
                                <input type="file" class="file-input file-input-bordered w-full" />
                            </div>
                        </div>

                        <div class="form-control mt-8">
                            <div class="flex justify-end gap-4">
                                <a href="index.html" class="btn btn-ghost">Cancel</a>
                                <button type="submit" class="btn btn-primary">Add User</button>
                            </div>
                        </div>
                    </form>
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
