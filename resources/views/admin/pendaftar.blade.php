<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pendaftar Event</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <!-- Navbar (fixed at top) -->
    @include('admin.navbar')

    <div class="flex pt-16 h-[calc(100vh-4rem)]">
        <!-- Sidebar (fixed left) -->
        @include('admin.sidebar')

        <!-- Main content -->
        <main class="flex-1 p-6 ml-0 md:ml-56 overflow-y-auto">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Daftar Pendaftar Event</h1>

                @foreach ($pendaftarans as $eventId => $groupedPendaftarans)
                    @php
                        $eventName = $groupedPendaftarans->first()->event->nama_event;
                    @endphp


                    @foreach ($groupedPendaftarans as $pendaftaran)
                    <div class="card bg-white shadow-lg mb-6">
                        <div class="card-body p-6">
                                <h2 class="text-xl font-bold text-gray-800 mb-4">{{ $eventName }}</h2>  
                                <!-- Header Section -->
                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                                    <div>
                                        <div class="flex flex-wrap items-center gap-2">
                                            <a href="{{ route('pendaftaran.approve', $pendaftaran->id) }}"
                                                onclick="return confirm('Yakin ingin menyetujui?')"
                                                class="inline-flex items-center px-3 py-1 text-sm rounded-full cursor-pointer
                {{ $pendaftaran->status === 'diterima' ? 'bg-green-200 text-green-800 pointer-events-none' : 'bg-red-200 text-red-800' }}">
                                                <i class="fa fa-check-circle mr-1"></i>
                                                {{ ucfirst($pendaftaran->status) }}
                                            </a>

                                            <span
                                                class="badge {{ $pendaftaran->tipe_pendaftaran === 'perorangan' ? 'badge-primary' : 'badge-secondary' }}">
                                                <i
                                                    class="fa {{ $pendaftaran->tipe_pendaftaran === 'perorangan' ? 'fa-user' : 'fa-users' }} mr-1"></i>
                                                {{ ucfirst($pendaftaran->tipe_pendaftaran) }}
                                            </span>

                                            @if ($pendaftaran->created_at)
                                                <span class="text-xs text-gray-400 ml-1">
                                                    <i class="fa fa-calendar mr-1"></i>
                                                    {{ $pendaftaran->created_at->format('d M Y') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mt-4 md:mt-0 text-right space-y-1">
                                        <div class="text-sm text-gray-600">
                                            <span class="text-gray-500">Didaftarkan oleh:</span>
                                            <span
                                                class="font-semibold text-gray-800">{{ $pendaftaran->user->username }}</span>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            <i class="fa fa-id-badge mr-1 text-blue-600"></i>
                                            <span class="font-semibold text-blue-700">id pendaftaran : {{ $pendaftaran->id }}</span>
                                        </div>
                                    </div>

                                </div>

                                <div class="divider my-2"></div>


                                <!-- Individual Registration -->
                                @if ($pendaftaran->tipe_pendaftaran === 'perorangan')
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <h3 class="font-bold">{{ $pendaftaran->perorangan['nama_lengkap'] }}</h3>
                                            <p class="text-sm text-gray-500">Pendaftar</p>
                                        </div>

                                        <div class="space-y-2">
                                            <div class="flex items-center">
                                                <i class="fas fa-phone-alt text-blue-500 w-5 mr-2"></i>
                                                <span>{{ $pendaftaran->perorangan['no_hp'] }}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-map-marker-alt text-blue-500 w-5 mr-2"></i>
                                                <span>{{ $pendaftaran->perorangan['alamat'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($pendaftaran->tipe_pendaftaran === 'kelompok')
                                    <!-- Group Registration -->
                                    <div class="mb-4">
                                        <!-- Group Leader Info -->
                                        <div class="bg-gray-50 p-4 rounded-lg mb-4">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <p class="text-sm text-gray-500">Nama kelompok:</p>
                                                    <h4 class="font-bold">{{ $pendaftaran->kelompok->nama_kelompok }}
                                                    </h4>
                                                </div>

                                                <div class="space-y-2">
                                                    <div class="flex items-center">
                                                        <i class="fas fa-phone-alt text-purple-500 w-5 mr-2"></i>
                                                        <span>{{ $pendaftaran->kelompok->no_hp_ketua }}</span>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <i class="fas fa-map-marker-alt text-purple-500 w-5 mr-2"></i>
                                                        <span>{{ $pendaftaran->kelompok->alamat_ketua }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Group Members -->
                                        <h4 class="font-bold mb-2">Anggota Kelompok:</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            @foreach ($pendaftaran->kelompok->anggota_kelompok as $anggota)
                                                <div class="bg-gray-50 p-4 rounded-lg">
                                                    <div>
                                                        <h5 class="font-medium">{{ $anggota->nama_anggota }}</h5>
                                                        <div class="flex items-center mt-1">
                                                            <i class="fas fa-phone-alt text-gray-500 w-4 mr-2"></i>
                                                            <span class="text-sm">{{ $anggota->no_hp }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>

        </main>
    </div>
</body>

</html>
