<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=visibility_off" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=visibility" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Ivent</title>
</head>
<?php

// echo "<pre>";
// print_r($events->toArray());
// echo "</pre>";
?>

<body>
    <!-- <a id="chatButton" href="{{ route('chat') }}" class="fixed bottom-6 right-6 bg-blue-900 text-white w-16 h-16 text-2xl flex items-center justify-center rounded-full shadow-lg hover:bg-gray-700 z-50">
  <i class="fa-solid fa-headset"></i>
</a> -->
    <button id="chatButton"
        class="fixed bottom-6 right-6 bg-blue-900 text-white w-16 h-16 text-2xl flex items-center justify-center rounded-full shadow-lg hover:bg-gray-700 z-50">
        <i class="fa-solid fa-headset"></i>
    </button>
    <script>
        document.getElementById("chatButton").addEventListener("click", function() {
            window.location.href = "/chat";
        });
    </script>
    <!-- Popup Login -->
    <div class="popup" id="loginPopup">
        <div class="popup-content">
            <span class="close-btn" onclick="closeLogin()">&times;</span>
            <h2>Login</h2>
            @if ($errors->has('login'))
                <div class="alert alert-danger text-red-600 text-sm mb-4">
                    {{ $errors->first('login') }}
                </div>
            @endif
            <form id="loginForm" action="{{ route('login') }}" method="POST">
                @csrf
                <input type="text" id="username" name="username" placeholder="Username" required>
                <div id="loginError" class="text-red-600 text-sm ml-0" style="margin-left:0 "></div>
                <div style="position: relative;">
                    <input style="padding-right: 40px;" type="password" id="password" name="password"
                        placeholder="Password" required>
                    <span onclick="togglePassword()"
                        style="position: absolute; right: 10px; top: 45px; transform: translateY(-50%); cursor: pointer;">
                        <span class="material-symbols-rounded">
                            visibility
                        </span>
                    </span>
                </div>

                <div class="flex justify-end items-right mb-2 text-sm">
                    <a href="#" onclick="openForgotPasswordPopup()" class="no-underline">Forgot Password?</a>
                </div>
                <button type="submit">Login</button>
                <p>Belum punya akun? <a href="#" onclick="switchToRegister()">Daftar di sini</a></p>
            </form>
        </div>
    </div>
    <!-- Popup Forgot Password -->
    <div class="popup" id="forgotPasswordPopup">
        <div class="popup-content">
            <span class="close-btn" onclick="closeForgot()">&times;</span>
            <h2>Lupa Password</h2>
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Masukkan Email" required />
                <button type="submit">Kirim Link Reset</button>
            </form>
            <p>Sudah ingat password? <a href="#" onclick="switchToLogin()">Login di sini</a></p>
        </div>
    </div>

    <script>
    window.onload = function () {
        setTimeout(() => {
            localStorage.removeItem('notified');
        }, 5000);
    };
</script>

    <!-- Popup Register -->
    <div class="popup" id="registerPopup">
        <div class="popup-content">
            <span class="close-btn" onclick="closeRegister()">&times;</span>
            <h2>Register</h2>
            <form id="registerForm" action="{{ route('register') }}" method="POST">
                @csrf
                <input type="text" name="username" id="username" placeholder="username" required />
                <input type="number" name="no_hp" id="no_hp" placeholder="no hp" required />
                <input type="text" name="alamat" id="alamat" placeholder="alamat" required />
                <input type="password" name="password" id="password" placeholder="Password" required />
                <input type="email" name="email" id="email" placeholder="Email" required />
                <button type="submit">Register</button>
            </form>
            <div id="registerError" class="text-red-600 text-sm mt-2"></div>

            <p>Sudah punya akun? <a href="#" onclick="switchToLogin()">Login di sini</a></p>
        </div>

    </div>
    <div class="circle"></div>
    <div class="circle navbar-circle-top" data-aos="fade-down-right" data-aos-duration="2000"></div>
    <div class="circle navbar-circle-bottom" data-aos="fade-down-right" data-aos-duration="2000"></div>
    <div class="circle hero-circle-bottom" data-aos="fade-up-left" data-aos-duration="2000"></div>
    <div class="circle hero-circle-top" data-aos="fade-up-left" data-aos-duration="2000"></div>
    <section class="navbar">
        <div class="logo" data-aos="fade-right" data-aos-duration="2000">
            <p>Ivent</p>
        </div>
        <ul data-aos="fade-down" data-aos-duration="2000">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#event">Event</a></li>
            @auth
                <a href="{{ route('history') }}">
                    <li>My ticket</li>
                </a>
            @else
                <span class="disabled-link">
                    <li style="color: gray; cursor: not-allowed;">My ticket</li>
                </span>
            @endauth
        </ul>
        <div class="logout" data-aos="fade-left" data-aos-duration="2000">
            <div class="auth-buttons">
                @if (Auth::check())
                    <!-- Jika user sudah login -->

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <span class="text-gray-700 font-medium">Halo, {{ Auth::user()->username }}</span>
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded ml-4">
                            Logout
                        </button>
                    </form>
                @else
                    <!-- Jika belum login -->
                    <button onclick="openLogin()" type="button"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Login
                    </button>
                @endif
            </div>
        </div>
    </section>
    <section class="flex flex-col items-center justify-center min-h-screen bg-gray-100 gap-y-8 z-10 "
        data-aos="fade-up" data-aos-duration="2000">
        <!-- Carousel Wrapper -->
        <div class="relative overflow-hidden z-[50] rounded-2xl shadow-xl w-[900px] h-[500px] mb-5 mt-6">

            <!-- Slides -->
            <div id="carousel" class="flex transition-transform duration-700 ease-in-out w-[2400px] h-full">
    @foreach ($events as $event)
        <div class="w-[900px] h-full flex-shrink-0 relative group">
            @auth
                <a href="{{ route('pendaftaran.create', $event->id) }}">
                    <img src="{{ asset('storage/' . $event->gambar) }}"
                         class="w-full h-full object-cover bg-blue-500 rounded-2xl cursor-pointer"
                         alt="{{ $event->nama_event }}">
                </a>
            @else
                <img src="{{ asset('storage/' . $event->gambar) }}"
                     onclick="alert('Silakan login terlebih dahulu untuk mendaftar.')"
                     class="w-full h-full object-cover bg-blue-500 rounded-2xl cursor-not-allowed opacity-80"
                     alt="{{ $event->nama_event }}">
            @endauth
        </div>
    @endforeach
</div>

     

            <!-- <a href="#" onclick="opendaftar({{ $event->id }})">Daftar Sekarang</a> -->


            <!-- Tombol panah kiri -->
            <button onclick="prevSlide()"
                class="
                        absolute top-1/2 left-4 -translate-y-1/2
                        flex justify-center items-center 
                        bg-white/50 text-black hover:bg-white/70 
                        p-3 rounded-full shadow-lg z-20 transition">
                <span class="material-symbols-outlined text-2xl">chevron_left</span>
            </button>

            <!-- Tombol panah kanan -->
            <button onclick="nextSlide()"
                class="
                        absolute top-1/2 right-4 -translate-y-1/2 
                        flex justify-center items-center 
                        bg-white/50 text-black hover:bg-white/70 
                        p-3 rounded-full shadow-lg z-20 transition">
                <span class="material-symbols-outlined text-2xl">chevron_right</span>
            </button>

        </div>

        <!-- Dot Indicators -->
        <div id="dots" class="flex pt-5 space-x-2">
            <button onclick="goToSlide(0)" class="w-2 h-2 rounded-full bg-gray-400"></button>
            <button onclick="goToSlide(1)" class="w-2 h-2 rounded-full bg-gray-400"></button>
            <button onclick="goToSlide(2)" class="w-2 h-2 rounded-full bg-gray-400"></button>
        </div>
    </section>
    <section class="fitur">
        <H1>Kategori Event</H1>
        <h4>Kami memiliki beberapa kategori untuk event yang kita tampilkan, seperti</h4>
        <section class="persentase">
            <div class="persentase-1" data-aos="fade-right" data-aos-duration="1000">
                <h1 class="persentase-2"><span class="material-symbols-outlined">
                        school
                    </span></h1>
                <h3 class="persentase-3">Seminar & Workshop</h3>
            </div>
            <div class="persentase-1" data-aos="fade-right" data-aos-duration="1000">
                <h1 class="persentase-2"><span class="material-symbols-outlined">
                        celebration
                    </span></h1>
                <h3 class="persentase-3">Festival & Hiburan</h3>
            </div>
            <div class="persentase-1" data-aos="fade-left">
                <h1 class="persentase-2"><span class="material-symbols-outlined">
                        business_center
                    </span></h1>
                <h3 class="persentase-3">Career Fair & Job Expo</h3>
            </div>
            <div class="persentase-1" data-aos="fade-left">
                <h1 class="persentase-2"><span class="material-symbols-outlined">
                        sports_soccer
                    </span></h1>
                <h3 class="persentase-3">Lomba & Kompetisi</h3>
            </div>
        </section>
    </section>
    <section class="about" id="about" style="!margin-top: 2rem">
        <div class="about-left" data-aos="fade-up-right" data-aos-duration="1000">
            <img src="{{ asset('images/hero2.png') }}" alt="">
        </div>
        <div class="about-right">
            <h1 class="about-1" data-aos="fade-right" data-aos-duration="1000">Tentang Ivent</h1>
            <h2 class="about-2" data-aos="fade-right" data-aos-duration="1000">Cari event melalui Website</h2>
            <h4 class="about-3" data-aos="fade-right" data-aos-duration="1000">Ivent adalah platform event
                digital
                yang memudahkan kamu untuk menemukan, mendaftar, dan mengikuti berbagai acara menarik seperti
                seminar,
                konser, festival, dan olahraga—semua dalam satu tempat, cepat dan praktis.</h4>
            <div class="burger-about">
                <div class="ba-1" data-aos="fade-up" data-aos-duration="2000">
                    <div class="ba-logo">
                        <span class="material-symbols-outlined">
                            calendar_today
                        </span>
                    </div>
                    <div class="content">
                        <div class="ba-2">Event Berkualitas & Terverifikasi</div>
                        <div class="ba-3">
                            Ivent hanya menampilkan event yang telah dikurasi dengan baik, sehingga pengguna
                            mendapatkan
                            pengalaman terbaik di setiap acara.
                        </div>
                    </div>
                </div>
                <div class="ba-1" data-aos="fade-up" data-aos-duration="2000">
                    <div class="ba-logo">
                        <span class="material-symbols-outlined">
                            bolt
                        </span>
                    </div>
                    <div class="content">
                        <div class="ba-2"> Pendaftaran Cepat & Transparan</div>
                        <div class="ba-3">
                            Proses daftar event di Ivent mudah, tanpa ribet. Kamu bisa melihat detail event, lokasi,
                            dan
                            fasilitas dengan jelas sebelum mendaftar.
                        </div>
                    </div>
                </div>
                <div class="ba-1" data-aos="fade-up" data-aos-duration="2000">
                    <div class="ba-logo">
                        <span class="material-symbols-outlined">
                            handshake
                        </span>
                    </div>
                    <div class="content">
                        <div class="ba-2">Dukung Komunitas & Kreativitas Lokal</div>
                        <div class="ba-3">
                            Dengan mengikuti event melalui Ivent, kamu turut mendukung komunitas, UMKM, dan para
                            kreator
                            lokal yang menghadirkan acara penuh inspirasi.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr class="line-1">
    <section class="fungsi">
        <h1 class="fungsi-1">Bagaimana Cara Daftarnya?</h1>
        <h3 class="fungsi-2">
            Proses sederhana 4 langkah untuk menemukan dan mendaftar event yang kamu inginkan. <br>
        </h3>
        <div class="daftar-step">
            <div class="step-1" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
                <div class="step-number">1</div>
                <p class="step-title">Temukan event favoritmu</p>
            </div>
            <div class="step-1" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                <div class="step-number">2</div>
                <p class="step-title">Klik dan baca detailnya</p>
            </div>
            <div class="step-1" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000">
                <div class="step-number">3</div>
                <p class="step-title">Daftar dan dapatkan tiket/konfirmasi</p>
            </div>
            <div class="step-1" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                <div class="step-number">4</div>
                <p class="step-title">Hadiri dan nikmati acaranya!</p>
            </div>
        </div>
        <hr class="line-1">
    </section>
    <h1 class="info-event" id="event">Temukan Event Favoritmu!</h1>
    <section class="event" id="eventScroll">
        <!-- event -->
        @foreach ($events as $event)
            <div class="event-card">
                <img src="{{ asset('storage/' . $event->gambar) }}" alt="{{ $event->nama_event }}"
                    class="event-image" />
                <div class="event-info">
                    <h3 class="event-title">{{ $event->nama_event }}</h3>

                    {{-- Harga dan Tanggal --}}
                    <p class="event-meta">
                        <span class="price">Rp{{ number_format($event->harga_pendaftaran, 0, ',', '.') }}</span>
                        &nbsp;|&nbsp;
                        <span
                            class="date">{{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}</span>
                    </p>

                    @auth
                        <button class="btn-daftar">
                            <a href="{{ route('pendaftaran.create', $event->id) }}"
                                onclick="opendaftar({{ $event->id }})">Daftar</a>
                        </button>
                    @else
                        <button class="btn-daftar" disabled title="Silakan login terlebih dahulu">
                            <span style="color: gray; cursor: not-allowed;">Daftar</span>
                        </button>
                    @endauth

                    <span class="info-icon" onclick="showInfo('popup{{ $event->id }}')">i</span>
                </div>
            </div>


            <div class="event-popup" id="popup{{ $event->id }}">
                <div class="popup-content">
                    <span class="close-btn" onclick="hideInfo('popup{{ $event->id }}')">&times;</span>
                    <h3>{{ $event->nama_event }}</h3>
                    <p><strong>Deskripsi:</strong> {{ $event->deskripsi }}</p>
                    <p><strong>Kuota:</strong> {{ $event->kuota }}</p>

                    @if ($event->max_anggota_kelompok)
                        <p><strong>Maksimal Anggota Kelompok:</strong> {{ $event->max_anggota_kelompok }}</p>
                    @else
                        <p><strong>Tipe Event:</strong> Perorangan</p>
                    @endif

                    <button class="btn-daftar mt-4">
                        <a href="#" onclick="opendaftar({{ $event->id }})">Daftar Sekarang</a>
                    </button>
                </div>
            </div>
        @endforeach

    </section>
    <sectionc class="testimoni-container">
        <h2 class="testimoni-heading">Testimoni dari Pengguna</h2>
        <!-- Card 1 -->
        <div class="card-testi">
            <div class="testimoni-card" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom"
                data-aos-delay="100" data-aos-duration="1000">
                <p class="testimoni-text">“Website ini sangat membantu saya menemukan event menarik di kota saya!”
                </p>
                <div class="testimoni-user">– Sinta, Mahasiswa</div>
                <div class="testimoni-rating">⭐⭐⭐⭐⭐</div>
            </div>

            <!-- Card 2 -->
            <div class="testimoni-card" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom"
                data-aos-delay="200" data-aos-duration="1000">
                <p class="testimoni-text">“Tampilan simpel dan informasi event lengkap. Suka banget!”</p>
                <div class="testimoni-user">– Raka, Freelancer</div>
                <div class="testimoni-rating">⭐⭐⭐⭐</div>
            </div>

            <!-- Card 3 -->
            <div class="testimoni-card" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom"
                data-aos-delay="300" data-aos-duration="1000">
                <p class="testimoni-text">“Proses pendaftaran cepat dan mudah. Sangat direkomendasikan!”</p>
                <div class="testimoni-user">– Dewi, Karyawan</div>
                <div class="testimoni-rating">⭐⭐⭐⭐⭐</div>
            </div>

            <!-- Card 4 -->
            <div class="testimoni-card" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom"
                data-aos-delay="400" data-aos-duration="1000">
                <p class="testimoni-text">“Web-nya responsif dan update. Event lokal jadi lebih mudah dijangkau.”
                </p>
                <div class="testimoni-user">– Ari, Mahasiswa</div>
                <div class="testimoni-rating">⭐⭐⭐⭐</div>
            </div>
        </div>
        </section>
        <div style="height: 70px;"></div>
        <footer style="background-color: #f9fafb; font-family: sans-serif; margin-top: 10rem;">
            <!-- Upper Content -->
            <div style="display: flex; flex-wrap: wrap; justify-content: space-between; padding: 3rem 2rem;">
                <!-- Deskripsi & Logo -->
                <div style="flex: 1 1 200px; margin-bottom: 2rem;">
                    <div style="margin-bottom: 1rem;">
                        <div style="width: 30px; height: 30px; background-color: #d2dcff; border-radius: 50%;">
                        </div>
                    </div>
                    <h3 style="font-weight: 600; max-width: 250px;">
                        Penyedia website event terbaik di indonesia.
                    </h3>
                    <p style="margin-top: 1rem; font-size: 0.9rem; color: #666;">Luqmanul, 2023.</p>
                </div>

                <!-- Platform -->
                <div style="flex: 1 1 150px; margin-bottom: 1rem;">
                    <h4 style="margin-bottom: 1rem;">Platform</h4>
                    <ul style="list-style: none; padding: 0; line-height: 1.8;">
                        <li><a href="#" style="color: #333; text-decoration: none;">Plans & Pricing</a></li>
                        <li><a href="#" style="color: #333; text-decoration: none;">Personal AI Manager</a>
                        </li>
                        <li><a href="#" style="color: #333; text-decoration: none;">AI Business Writer</a>
                        </li>
                    </ul>
                </div>

                <!-- Company -->
                <div style="flex: 1 1 150px; margin-bottom: 1rem;">
                    <h4 style="margin-bottom: 1rem;">Company</h4>
                    <ul style="list-style: none; padding: 0; line-height: 1.8;">
                        <li><a href="#" style="color: #333; text-decoration: none;">Blog</a></li>
                        <li><a href="#" style="color: #333; text-decoration: none;">Careers</a></li>
                        <li><a href="#" style="color: #333; text-decoration: none;">News</a></li>
                    </ul>
                </div>

                <!-- Resources -->
                <div style="flex: 1 1 150px; margin-bottom: 1rem;">
                    <h4 style="margin-bottom: 1rem;">Resources</h4>
                    <ul style="list-style: none; padding: 0; line-height: 1.8;">
                        <li><a href="#" style="color: #333; text-decoration: none;">Documentation</a></li>
                        <li><a href="#" style="color: #333; text-decoration: none;">Papers</a></li>
                        <li><a href="#" style="color: #333; text-decoration: none;">Press Conferences</a>
                        </li>
                    </ul>
                </div>

                <!-- Get the App -->
                <div style="flex: 1 1 150px; margin-bottom: 1rem;">
                    <h4 style="margin-bottom: 1rem;">Get the app</h4>
                    <button
                        style="display: flex; align-items: center; border: 1px solid #ccc; background: white; padding: 0.5rem 1rem; border-radius: 999px; margin-bottom: 0.5rem; cursor: pointer; hover: background-color: #d2dcff;">
                        Windows
                    </button>
                    <button
                        style="display: flex; align-items: center; border: 1px solid #ccc; background: white; padding: 0.5rem 1rem; border-radius: 999px; cursor: pointer;">
                        &nbsp;macOS
                    </button>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div
                style="background-color: #d2dcff; color: black; padding: 1rem 2rem; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; font-size: 0.9rem;">
                <p style="margin: 0;">© 2023 Maxwell Inc. All rights reserved.</p>
                <div style="display: flex; gap: 1.5rem;">
                    <a href="#" style="color: black; text-decoration: none;">Terms of Service</a>
                    <a href="#" style="color: black; text-decoration: none;">Privacy Policy</a>
                    <a href="#" style="color: black; text-decoration: none;">Cookies</a>
                </div>
            </div>
        </footer>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
        <style>
            .material-symbols-rounded {
                font-variation-settings:
                    'FILL' 1,
                    'wght' 400,
                    'GRAD' 0,
                    'opsz' 24
            }
        </style>
        <script>
            // carousel auto scroll
            const carousel = document.getElementById("carousel");
            const dots = document.querySelectorAll("#dots button");
            const totalSlides = carousel.children.length;
            let index = 0;

            function showSlide(i) {
                index = (i + totalSlides) % totalSlides;
                carousel.style.transform = `translateX(-${index * 900}px)`;
                updateDots();
            }

            function nextSlide() {
                showSlide(index + 1);
            }

            function prevSlide() {
                showSlide(index - 1);
            }

            function goToSlide(i) {
                showSlide(i);
            }

            function updateDots() {
                dots.forEach((dot, i) => {
                    dot.classList.toggle("bg-gray-900", i === index);
                    dot.classList.toggle("bg-gray-400", i !== index);
                });
            }

            setInterval(nextSlide, 5000); // Auto-slide setiap 5 detik
            updateDots(); // Set awal dot aktif
            // password toggle
            function togglePassword() {
                var passwordInput = document.getElementById("password");
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                } else {
                    passwordInput.type = "password";
                }
            }
            // register
            document.getElementById('registerForm').addEventListener('submit', async function(e) {
                e.preventDefault();

                const form = this;
                const formData = new FormData(form);

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            "Accept": "application/json"
                        }
                    });


                    const result = await response.json();

                    if (response.ok) {
                        Swal.fire({
                            toast: true,
                            position: 'top-start',
                            icon: 'success',
                            title: 'Registrasi berhasil!',
                            text: "Silakan login untuk melanjutkan.",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });

                        closeRegister();
                        openLogin(); // Pastikan fungsi ini membuka popup login
                    } else {
                        const errorMsg = result.message || "Registrasi gagal. Silakan cek kembali.";
                        document.getElementById('registerError').textContent = errorMsg;
                    }
                } catch (err) {
                    console.error("Kesalahan:", err);
                    document.getElementById('registerError').textContent = "Terjadi kesalahan jaringan.";
                }
            });

            // login
            document.getElementById('loginForm').addEventListener('submit', async function(e) {
                e.preventDefault(); // mencegah reload halaman

                const form = this;
                const formData = new FormData(form);

                try {
                    const response = await fetch(form.action, {
                        method: "POST",
                        body: formData,
                        headers: {
                            "Accept": "application/json"
                        }
                    });

                    const result = await response.json();

                    if (response.ok) {
                        if (result.message) {
                            localStorage.setItem('login_success_message', result.message);
                        }

                        // Lanjut redirect
                        window.location.href = result.redirect || "/";
                    } else {
                        document.getElementById('loginError').textContent = result.message || "Login gagal.";
                    }
                } catch (err) {
                    console.error("Terjadi kesalahan:", err);
                    document.getElementById('loginError').textContent = "Terjadi kesalahan sistem.";
                }
            });


            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });


            function showInfo(id) {
                document.getElementById(id).style.display = "flex";
            }

            function hideInfo(id) {
                document.getElementById(id).style.display = "none";
            }
            const scrollContainer = document.getElementById("eventScroll");

            function autoScroll() {
                const maxScrollLeft = scrollContainer.scrollWidth - scrollContainer.clientWidth;

                let scrollStep = 1; // kecepatan scroll (1px per frame)
                let direction = 2; // 1 ke kanan, -1 ke kiri

                function scroll() {
                    scrollContainer.scrollLeft += scrollStep * direction;

                    // Balik arah jika sudah sampai ujung
                    if (scrollContainer.scrollLeft >= maxScrollLeft) {
                        direction = -1;
                    } else if (scrollContainer.scrollLeft <= 0) {
                        direction = 1;
                    }

                    requestAnimationFrame(scroll); // animasi mulus
                }

                scroll();
            }

            function openLogin() {
                document.getElementById('loginPopup').style.display = 'flex';
            }

            function closeLogin() {
                document.getElementById('loginPopup').style.display = 'none';
            }

            function closeForgot() {
                document.getElementById('forgotPasswordPopup').style.display = 'none';
            }

            function openRegister() {
                document.getElementById('registerPopup').style.display = 'flex';
            }

            function closeRegister() {
                document.getElementById('registerPopup').style.display = 'none';
            }

            function opendaftar() {
                document.getElementById('DaftarPopup').style.display = 'flex';
            }

            function closedaftar() {
                document.getElementById('DaftarPopup').style.display = 'none';
            }

            function switchToRegister() {
                closeLogin();
                openRegister();
            }

            function openForgotPasswordPopup() {
                document.getElementById('forgotPasswordPopup').style.display = 'flex';
            }

            function closeForgotPasswordPopup() {
                document.getElementById('forgotPasswordPopup').style.display = 'none';
            }


            function switchToLogin() {
                closeRegister();
                openLogin();
            }
            // Mulai scroll otomatis saat halaman selesai dimuat
            window.onload = autoScroll;

            AOS.init();
        </script>

        <!-- notifikasi forgot password -->
        @if (session('status'))
    <script>
        if (!localStorage.getItem('notified')) {
            Swal.fire({
                toast: true,
                position: 'top-start',
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('status') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });

            localStorage.setItem('notified', 'true');
        }
    </script>
@endif
@if ($errors->has('email'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-start',
            icon: 'error',
            title: 'Gagal!',
            text: "email salah atau tidak terdaftar",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    </script>
@endif



        <!-- SweetAlert2 -->
        @if (session('success'))
            <script>
                // Cek apakah notifikasi sudah pernah ditampilkan
                if (!localStorage.getItem('notified')) {
                    Swal.fire({
                        toast: true,
                        position: 'top-start',
                        icon: 'success',
                        title: ' berhasil!',
                        text: "{{ session('success') }}",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });

                    localStorage.setItem('notified', 'true');
                }
            </script>
        @endif
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const msg = localStorage.getItem('login_success_message');
                if (msg) {
                    Swal.fire({
                        toast: true,
                        position: 'top-start',
                        icon: 'success',
                        title: 'Login berhasil!',
                        text: msg,
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });

                    localStorage.removeItem('login_success_message');
                }
            });
        </script>



        <script>
            window.addEventListener("pageshow", function(event) {
                const navigationType = performance.getEntriesByType("navigation")[0]?.type;
                if (navigationType !== 'back_forward') {
                    localStorage.removeItem('notified');
                }
            });
        </script>


</body>

</html>
