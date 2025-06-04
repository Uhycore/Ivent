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

<body class="bg-base-100 mt-16">
    <div class="drawer lg:drawer-open">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <!-- Sidebar -->
        @include('admin.sidebar')

        <div class="drawer-content flex flex-col">
            <!-- Navbar -->
            @include('admin.navbar')

            <!-- Page content -->
            <div class="p-4 md:p-6 ml-64">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Add New User</h1>
                    <a href="{{ route('admin.pengguna.index') }}" class="btn btn-ghost">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Users
                    </a>
                </div>

                <!-- Add User Form -->
                <div class="bg-base-100 p-6 rounded-lg shadow-md">
                    <form method="POST" action="{{ route('admin.pengguna.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Personal Information -->
                            <div class="form-control">
                                <label class="label" for="username">
                                    <span class="label-text">Username</span>
                                </label>
                                <input type="text" id="username" name="username" placeholder="Enter username"
                                    class="input input-bordered @error('username') input-error @enderror"
                                    value="{{ old('username') }}" required />
                                @error('username')
                                    <span class="text-error text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label" for="email">
                                    <span class="label-text">Email</span>
                                </label>
                                <input type="email" id="email" name="email" placeholder="Enter email"
                                    class="input input-bordered @error('email') input-error @enderror"
                                    value="{{ old('email') }}" required />
                                @error('email')
                                    <span class="text-error text-sm">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-control">
                                <label class="label" for="password">
                                    <span class="label-text">Password</span>
                                </label>
                                <input type="password" id="password" name="password" placeholder="Enter password"
                                    class="input input-bordered @error('password') input-error @enderror" required />
                                @error('password')
                                    <span class="text-error text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label" for="password_confirmation">
                                    <span class="label-text">Confirm Password</span>
                                </label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    placeholder="Confirm password" class="input input-bordered" required />
                            </div>

                            <!-- <div class="form-control">
                                <label class="label" for="full_name">
                                    <span class="label-text">Full Name</span>
                                </label>
                                <input type="text" id="full_name" name="full_name" placeholder="Enter full name"
                                    class="input input-bordered @error('full_name') input-error @enderror"
                                    value="{{ old('full_name') }}" required />
                                @error('full_name')
    <span class="text-error text-sm">{{ $message }}</span>
@enderror
                            </div> -->

                            <div class="form-control">
                                <label class="label" for="no_hp">
                                    <span class="label-text">No HP</span>
                                </label>
                                <input type="tel" id="no_hp" name="no_hp" placeholder="Enter phone number"
                                    class="input input-bordered @error('no_hp') input-error @enderror"
                                    value="{{ old('no_hp') }}" required />
                                @error('no_hp')
                                    <span class="text-error text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label" for="role">
                                    <span class="label-text">Role</span>
                                </label>
                                <select id="role" name="role"
                                    class="select select-bordered @error('role') select-error @enderror" required>
                                    <option value="" disabled selected>Select role</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Pengguna</option>

                                </select>
                                @error('role')
                                    <span
                                        class="text-error
                                    text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-control md:col-span-2">
                                <label class="label" for="alamat">
                                    <span class="label-text">Alamat</span>
                                </label>
                                <textarea id="alamat" name="alamat"
                                    class="textarea textarea-bordered h-24 @error('alamat') textarea-error @enderror" placeholder="Enter address"
                                    required>{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <span class="text-error text-sm">{{ $message }}</span>
                                @enderror
                            </div>



                            <!-- Profile Picture -->
                            <!-- <div class="form-control md:col-span-2">
                                <label class="label" for="profile_picture">
                                    <span class="label-text">Profile Picture</span>
                                </label>
                                <input type="file" id="profile_picture" name="profile_picture"
                                    class="file-input file-input-bordered w-full @error('profile_picture') file-input-error @enderror" />
                                @error('profile_picture')
    <span class="text-error text-sm">{{ $message }}</span>
@enderror
                            </div>
                        </div> -->
                            <div class="form-control mt-8 ">
                                <div class="flex justify-end gap-4 ">
                                    <a href="{{ route('admin.pengguna.index') }}" class="btn btn-ghost">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Add User</button>
                                </div>
                            </div>
                    </form>
                </div>

            </div>
        </div>



    </div>

</body>

</html>
