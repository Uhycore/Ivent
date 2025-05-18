<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - Sistem Informasi TPQ</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center overflow-y-auto">

    <section id="content" class="flex min-h-screen w-full flex-col md:flex-row">

        <!-- Info Section -->
        <div class="bg-green-500 text-white w-full md:w-1/2 flex flex-col h-screen">
            <div class="flex-grow flex flex-col justify-center px-6 sm:px-10 md:px-16">
                <div class="text-center">
                    <img class="mb-4 w-20 h-20 md:w-24 md:h-24 rounded-full mx-auto"
                        src="{{ asset('images/profil.jpg') }}" alt="Logo TPQ">
                    <h2 class="text-xl sm:text-2xl md:text-3xl font-semibold text-left">Daftar Akun TPQ AL-Qohol</h2>
                    <p class="mt-2 text-sm sm:text-base lg:text-lg text-left">Lengkapi data di samping untuk mendaftar
                        akun.</p>
                </div>
            </div>
        </div>


        <!-- Form Register -->
        <section class="bg-gray-100 w-full md:w-1/2 flex flex-col items-center justify-center p-6 sm:p-10 md:p-12">

            <header
                class="bg-gray-200 text-gray-900 text-center text-base font-semibold py-2 px-4 rounded-t-md border border-gray-300 w-full max-w-md mx-auto">
                Formulir Pendaftaran Akun
            </header>

            <div
                class="bg-white text-gray-900 px-4 sm:px-6 rounded-b-md border-b border-r border-l border-gray-300 w-full max-w-md mx-auto">

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-4">
                        <ul class="list-disc pl-5 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4 py-6 text-sm">
                    @csrf

                    <div>
                        <label for="username" class="block font-semibold text-gray-700">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                            class="w-full px-3 py-2 bg-green-100 border border-gray-300 rounded-md text-gray-900"
                            required>
                    </div>

                    <div>
                        <label for="password" class="block font-semibold text-gray-700">Password</label>
                        <input type="password" id="password" name="password"
                            class="w-full px-3 py-2 bg-green-100 border border-gray-300 rounded-md text-gray-900"
                            required>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block font-semibold text-gray-700">Konfirmasi
                            Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full px-3 py-2 bg-green-100 border border-gray-300 rounded-md text-gray-900"
                            required>
                    </div>

                    <div>
                        <label for="no_hp" class="block font-semibold text-gray-700">Nomor HP</label>
                        <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                            class="w-full px-3 py-2 bg-green-100 border border-gray-300 rounded-md text-gray-900"
                            required>
                    </div>

                    <div>
                        <label for="alamat" class="block font-semibold text-gray-700">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="2"
                            class="w-full px-3 py-2 bg-green-100 border border-gray-300 rounded-md text-gray-900" required>{{ old('alamat') }}</textarea>
                    </div>

                    <div>
                        <label for="profile_picture" class="block font-semibold text-gray-700">Foto Profil
                            (Opsional)</label>
                        <input type="file" id="profile_picture" name="profile_picture"
                            class="w-full bg-green-100 border border-gray-300 rounded-md text-gray-900 px-3 py-1">
                    </div>

                    <button type="submit"
                        class="w-full bg-green-600 text-white py-2 px-4 rounded-md font-semibold transition duration-300 hover:bg-green-500">
                        Daftar
                    </button>
                </form>
            </div>

            <div class="text-center mt-4 text-sm">
                <p>Sudah punya akun? <a href="{{ route('login.form') }}" class="text-blue-600 underline">Login di
                        sini</a></p>
            </div>

            <div class="flex flex-col items-center mt-6 space-y-4 text-sm text-gray-500">
                <p>TPQ</p>
                <div class="flex space-x-2">
                    <p>© 2024 DSI ITATS</p>
                    <a href="#" class="text-blue-500 hover:underline">Privacy Policy</a>
                </div>

                <div class="flex justify-center items-center pt-2 space-x-4">
                    <a href="#" class="hover:text-gray-700"><i class="fab fa-instagram text-xl"></i></a>
                    <a href="#" class="hover:text-gray-700"><i class="fab fa-facebook text-xl"></i></a>
                    <a href="#" class="hover:text-gray-700"><i class="fab fa-twitter text-xl"></i></a>
                </div>
            </div>

        </section>
    </section>
</body>


</html>
