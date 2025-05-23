<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pendaftar Event</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="flex h-screen bg-gray-100">
    @include('admin.sidebar')
    <div class="flex-1 flex flex-col">
        @include('admin.navbar')

        <!-- Main content -->
        <main class="flex-1 p-6 overflow-auto">
            @foreach ($pendaftarans as $pendaftaran)
                <div class="card bg-base-100 shadow-xl mb-6">
                    <div class="card-body">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                            <div>
                                <div class="flex items-center">
                                    <h2 class="card-title text-xl">{{ $pendaftaran->event->nama_event }}</h2>
                                    <span
                                        class="ml-4 px-3 py-1 text-sm rounded-full
                    {{ $pendaftaran->status === 'diterima' ? 'bg-green-200 text-green-800' : ($pendaftaran->status === 'ditolak' ? 'bg-red-200 text-red-800' : 'bg-yellow-200 text-yellow-800') }}">
                                        {{ ucfirst($pendaftaran->status) }}
                                    </span>
                                </div>
                                <div
                                    class="badge {{ $pendaftaran->tipe_pendaftaran === 'perorangan' ? 'badge-primary' : 'badge-secondary' }} mt-1">
                                    {{ ucfirst($pendaftaran->tipe_pendaftaran) }}
                                </div>
                            </div>
                            <div class="mt-2 md:mt-0">
                                <span class="text-sm text-gray-500">Didaftarkan oleh: </span>
                                <span class="font-medium">{{ $pendaftaran->user->username }}</span>
                            </div>
                        </div>


                        <div class="divider my-2"></div>

                        @if ($pendaftaran->tipe_pendaftaran === 'perorangan')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h3 class="font-bold">{{ $pendaftaran->perorangan['nama_lengkap'] }}</h3>
                                    <p class="text-sm">Pendaftar</p>
                                </div>

                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <i class="fas fa-phone-alt text-primary w-5 mr-2"></i>
                                        <span>{{ $pendaftaran->perorangan['no_hp'] }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-map-marker-alt text-primary w-5 mr-2"></i>
                                        <span>{{ $pendaftaran->perorangan['alamat'] }}</span>
                                    </div>
                                </div>
                            </div>
                        @elseif ($pendaftaran->tipe_pendaftaran === 'kelompok')
                            <div class="mb-4">


                                <!-- Nama Kelompok (ganti dari ketua) tanpa avatar -->
                                <div class="bg-base-200 p-4 rounded-lg mb-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm">Nama kelompok:</p>
                                            <h4 class="font-bold">{{ $pendaftaran->kelompok->nama_kelompok }}</h4>
                                        </div>

                                        <div class="space-y-2">
                                            <div class="flex items-center">
                                                <i class="fas fa-phone-alt text-secondary w-5 mr-2"></i>
                                                <span>{{ $pendaftaran->kelompok->no_hp_ketua }}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-map-marker-alt text-secondary w-5 mr-2"></i>
                                                <span>{{ $pendaftaran->kelompok->alamat_ketua }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Anggota -->
                                <h4 class="font-bold mb-2">Anggota Kelompok:</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach ($pendaftaran->kelompok->anggota_kelompok as $anggota)
                                        <div class="bg-base-200 p-4 rounded-lg">
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
        </main>

    </div>

</body>



</html>
