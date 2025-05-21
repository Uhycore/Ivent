<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Sistem Informasi TPQ</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <!-- Fullscreen Content Section -->
    <section id="content" class="flex h-screen w-full flex-col md:flex-row">

        <!-- Info Section (Kiri, Hijau) -->
        <div id="info"
            class="bg-green-500 text-white w-full md:w-1/2 flex flex-col justify-center px-8 sm:px-12 md:px-20 h-screen">
            <div class="text-center">
                <img id="animationLogo" class="mb-4 w-24 h-24 rounded-full" src="{{ asset('images/profil.jpg') }}"
                    alt="Logo TPQ">

                <h2 class="text-2xl sm:text-3xl font-semibold text-left">Selamat Datang di TPQ AL-Qohol</h2>
                <p class="mt-2 text-base sm:text-lg lg:text-xl text-left">Hai! Silakan cek informasi berikut, ya...</p>
                <ul class="mt-2 text-left list-disc pl-5 text-sm sm:text-base lg:text-lg">
                    <li>Mahasiswa baru <strong>S-1 reguler</strong> tidak perlu mengentri KRS secara mandiri. KRS akan
                        terisi otomatis (paket) pada Semester 1.</li>
                    <li>Mahasiswa <strong>lama dan baru S-1 jalur RPL dan S-2</strong> dapat mengentri KRS mandiri dan
                        berkoordinasi dengan Dosen Wali.</li>
                    <li>Mahasiswa program <strong>MBKM</strong> dapat merencanakan konversi mata kuliah melalui <a
                            href="https://mbkm.itats.ac.id" class="text-yellow-200 underline"
                            target="_blank">SIM-MBKM</a>.</li>
                </ul>
            </div>
        </div>

        <!-- Login Form Section -->
        <section class="bg-gray-100 w-full md:w-1/2 flex flex-col items-center justify-center p-8 sm:p-12 md:p-16">

            <header
                class="bg-gray-200 text-gray-900 text-center text-base font-semibold py-2 px-4 rounded-t-md border border-gray-300 w-full max-w-sm mx-auto">
                Izinkan Sistem Mengidentifikasi Anda
            </header>

            <div
                class="bg-white text-gray-900 px-4 sm:px-6 rounded-b-md border-b border-r border-l border-gray-300 w-full max-w-sm mx-auto">

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-4" role="alert">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                <!-- Login Form -->
                <form action="{{ route('login') }}" method="POST" class="space-y-4 py-6">
                    @csrf

                    <div>
                        <label for="username" class="block text-sm font-semibold text-gray-700">Username</label>
                        <input type="text" id="username" name="username" placeholder="Contoh: Ariladmin"
                            class="w-full px-3 py-2 bg-green-100 border border-gray-300 rounded-md text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700">Kata Sandi</label>
                        <input type="password" id="password" name="password" placeholder="contoh: 2005-05-15"
                            class="w-full px-3 py-2 bg-green-100 border border-gray-300 rounded-md text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>

                    <button type="submit"
                        class="w-full bg-green-600 text-white py-2 px-4 rounded-md text-sm font-semibold transition duration-500 hover:bg-green-400">
                        Masuk
                    </button>
                </form>
            </div>

            <!-- Optional: Register & Social -->
            <div class="text-center mt-4">
                <p class="text-sm">Belum punya akun? <a href="{{ route('register') }}"
                        class="text-blue-600 underline">Daftar sekarang</a></p>
            </div>

            <!-- Footer & Sosmed -->
            <div class="flex flex-col items-center mt-6 space-y-4">
                <div class="text-center text-gray-500 text-sm flex flex-col items-center space-y-2">

                    <div class="flex space-x-2">
                        <p>© 2024 DSI ITATS</p>
                        <a href="#" class="text-blue-500 hover:underline">Privacy Policy</a>
                    </div>
                </div>

                <div class="flex justify-center items-center pt-4 space-x-4">
                    <a href="#" class="text-gray-500 hover:text-gray-700">
                        <i class="fab fa-instagram text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700">
                        <i class="fab fa-facebook text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700">
                        <i class="fab fa-twitter text-2xl"></i>
                    </a>
                </div>
            </div>
        </section>

    </section>
</body>

</html>
