<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <input type="text" id="username" name="username" placeholder="Email atau Username" required />
                <input type="password" id="password" name="password" placeholder="Password" required />
                <button type="submit">Login</button>
            </form>
            <p>Belum punya akun? <a href="#" onclick="switchToRegister()">Daftar di sini</a></p>
        </div>
    </div>
    <!-- Popup Register -->
    <div class="popup" id="registerPopup">
        <div class="popup-content">
            <span class="close-btn" onclick="closeRegister()">&times;</span>
            <h2>Register</h2>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <input type="text" name="username" id="username" placeholder="username" required />
                <input type="number" name="no_hp" id="no_hp" placeholder="no hp" required />
                <input type="text" name="alamat" id="alamat" placeholder="alamat" required />
                <input type="password" name="password" id="password" placeholder="Password" required />
                <input type="email" name="email" id="email" placeholder="Email" required />
                <button type="submit">Register</button>
            </form>
            <p>Sudah punya akun? <a href="#" onclick="switchToLogin()">Login di sini</a></p>
        </div>
        <!-- <div class="popup" id="DaftarPopup">
    <div class="popup-content">
        <span class="close-btn" onclick="closedaftar()">&times;</span>
        <h2>Register</h2>
        <form>
        <input type="text" placeholder="Nama Lengkap" required />
        <input type="email" placeholder="Email" required />
        <input type="text" placeholder="Username" required />
        <input type="password" placeholder="Password" required />
        <button type="submit">Register</button>
        </form>
        
    </div> -->
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
            <a href="{{ route('history') }}">
                <li> My ticket</li>
            </a>
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
    <section class="hero" id="home">
        <div class="hero-left" data-aos="fade-right" data-aos-duration="2000">
            <h1 class="judul">Temukan dan Daftar Event Terbaik dengan Mudah</h1><br>
            <h4 class="subjudul">Cari event favoritmu, daftar online, dan <br>ikuti acaranya tanpa ribet</h4>
            <button class="btn">
                <a href="#event">Jelahi Event</a>
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 12H5m14 0-4 4m4-4-4-4" />
                </svg>
            </button>
        </div>
        <div class="hero-right" data-aos="fade-left" data-aos-duration="2000">
            <img src="{{ asset('images/hero1.png') }}" alt="hero image">
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
            <h4 class="about-3" data-aos="fade-right" data-aos-duration="1000">Ivent adalah platform event digital
                yang memudahkan kamu untuk menemukan, mendaftar, dan mengikuti berbagai acara menarik seperti seminar,
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
                            Ivent hanya menampilkan event yang telah dikurasi dengan baik, sehingga pengguna mendapatkan
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
                            Proses daftar event di Ivent mudah, tanpa ribet. Kamu bisa melihat detail event, lokasi, dan
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
                            Dengan mengikuti event melalui Ivent, kamu turut mendukung komunitas, UMKM, dan para kreator
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
                <p class="testimoni-text">“Website ini sangat membantu saya menemukan event menarik di kota saya!”</p>
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
                <p class="testimoni-text">“Web-nya responsif dan update. Event lokal jadi lebih mudah dijangkau.”</p>
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
                    <div style="width: 30px; height: 30px; background-color: #d2dcff; border-radius: 50%;"></div>
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
                    <li><a href="#" style="color: #333; text-decoration: none;">Personal AI Manager</a></li>
                    <li><a href="#" style="color: #333; text-decoration: none;">AI Business Writer</a></li>
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
                    <li><a href="#" style="color: #333; text-decoration: none;">Press Conferences</a></li>
                </ul>
                </div>

                <!-- Get the App -->
                <div style="flex: 1 1 150px; margin-bottom: 1rem;">
                <h4 style="margin-bottom: 1rem;">Get the app</h4>
                <button style="display: flex; align-items: center; border: 1px solid #ccc; background: white; padding: 0.5rem 1rem; border-radius: 999px; margin-bottom: 0.5rem; cursor: pointer; hover: background-color: #d2dcff;">
                    Windows
                </button>
                <button style="display: flex; align-items: center; border: 1px solid #ccc; background: white; padding: 0.5rem 1rem; border-radius: 999px; cursor: pointer;">
                    &nbsp;macOS
                </button>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div style="background-color: #d2dcff; color: black; padding: 1rem 2rem; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; font-size: 0.9rem;">
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

        <script>
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


            function switchToLogin() {
                closeRegister();
                openLogin();
            }
            // Mulai scroll otomatis saat halaman selesai dimuat
            window.onload = autoScroll;

            AOS.init();
        </script>
        
</body>

</html>
