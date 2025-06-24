<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Event - {{ $event->nama_event }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4" style="font-family: Poppins, sans-serif;">
    <div class="bg-white shadow-md rounded-lg max-w-6xl w-full p-6 flex flex-col lg:flex-row gap-8">

        <!-- DETAIL EVENT (KIRI) -->
        <div class="lg:w-1/2 w-full">
            <img src="{{ asset('storage/' . $event->gambar) }}" alt="Poster Event" class="rounded-lg mb-4 w-full object-cover max-h-80">
        

            <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $event->nama_event }}</h2>
            <ul class="text-gray-700 text-sm space-y-2">
                <li><strong>Tanggal:</strong> {{ $event->tanggal }}</li>
                <li><strong>Harga Tiket:</strong> Rp{{ number_format($event->harga_pendaftaran, 0, ',', '.') }}</li>
                <li><strong>Sisa Kuota:</strong> {{ $event->sisa_kuota }}</li>
                <li><strong>Tipe Event:</strong> {{ ucfirst($event->tipe_event) }}</li>
            </ul>

            <div class="mt-4">
                <h3 class="text-md font-semibold mb-1">Deskripsi Event</h3>
                <p class="text-sm text-gray-600 whitespace-pre-line">{{ $event->deskripsi }}</p>
            </div>
        </div>

        <!-- FORM PENDAFTARAN (KANAN) -->
        <div class="lg:w-1/2 w-full">
            <div class="bg-white shadow-md rounded-lg w-full p-6">
                <h2 class="text-xl font-semibold mb-6 text-center">Form Pendaftaran Event: <br><span
                        style="color:#1e2665">{{ $event->nama_event }}</span></h2>

                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pendaftaran.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $event->id }}" />

                    <div class="mb-6">
                        <label for="tipe_pendaftaran" class="block mb-2 text-sm font-medium text-gray-900">Tipe Pendaftaran</label>
                        <select id="tipe_pendaftaran" name="tipe_pendaftaran" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            onchange="toggleForm()">
                            @if ($event->tipe_event == 'perorangan' || $event->tipe_event == 'semua')
                                <option value="perorangan">Perorangan</option>
                            @endif
                            @if ($event->tipe_event == 'kelompok' || $event->tipe_event == 'semua')
                                <option value="kelompok">Kelompok</option>
                            @endif
                        </select>
                    </div>

                    {{-- Form Perorangan --}}
                    <div id="form_perorangan" class="space-y-6">
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" placeholder="Masukkan nama lengkap" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900">No HP</label>
                            <input type="text" name="no_hp" placeholder="Masukkan nomor HP" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                            <textarea name="alamat" rows="2" placeholder="Masukkan alamat"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                        </div>
                    </div>

                    {{-- Form Kelompok --}}
                    <div id="form_kelompok" class="space-y-6 hidden">
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Nama Kelompok</label>
                            <input type="text" name="nama_kelompok" required placeholder="Masukkan nama kelompok"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900">No HP Ketua</label>
                            <input type="text" name="no_hp_ketua" required placeholder="Masukkan nomor HP ketua"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Alamat Ketua</label>
                            <input type="text" name="alamat_ketua" required placeholder="Masukkan alamat ketua"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                        </div>

                        <div id="anggota_fields" class="space-y-4">
                            <label class="block mb-2 text-sm font-semibold text-gray-900">Anggota Kelompok</label>
                            @for ($i = 1; $i <= $event->max_anggota_kelompok; $i++)
                                <div class="flex space-x-2">
                                    <input type="text" name="nama_anggota[]" placeholder="Nama Anggota {{ $i }}" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" />
                                    <input type="text" name="no_hp_anggota[]" placeholder="No HP Anggota {{ $i }}" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" />
                                </div>
                            @endfor
                        </div>
                    </div>

                    <button style="background-color: #1e2665" type="submit" class="w-full text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Daftar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script Toggle Form -->
    <script>
        function toggleForm() {
            const tipe = document.getElementById('tipe_pendaftaran').value;
            const formPerorangan = document.getElementById('form_perorangan');
            const formKelompok = document.getElementById('form_kelompok');
            formPerorangan.classList.toggle('hidden', tipe !== 'perorangan');
            formKelompok.classList.toggle('hidden', tipe !== 'kelompok');
            setFormRequired(formPerorangan, tipe === 'perorangan');
            setFormRequired(formKelompok, tipe === 'kelompok');
        }

        function setFormRequired(container, isRequired) {
            const inputs = container.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                if (isRequired) input.setAttribute('required', 'required');
                else input.removeAttribute('required');
            });
        }

        document.getElementById('tipe_pendaftaran').addEventListener('change', toggleForm);
        document.addEventListener('DOMContentLoaded', toggleForm);
    </script>

    <!-- SweetAlert2 -->
    @if(session('success'))
        <script>
            if (!localStorage.getItem('notified')) {
                Swal.fire({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    timer: 3000,
                    showConfirmButton: false
                });
                localStorage.setItem('notified', 'true');
            }
        </script>
    @endif

    <script>
        window.addEventListener("pageshow", function (event) {
            const navigationType = performance.getEntriesByType("navigation")[0]?.type;
            if (navigationType !== 'back_forward') {
                localStorage.removeItem('notified');
            }
        });
    </script>
</body>
</html>