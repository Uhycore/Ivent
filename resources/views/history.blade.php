<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="min-h-screen bg-base-200 p-6">
    <div class="container mx-auto max-w-4xl">
        <h1 class="text-3xl font-bold mb-8 text-center">Daftar Pendaftaran</h1>

        <?php foreach ($pendaftaranList as $pendaftaran): ?>
        <div class="card bg-base-100 shadow-xl mb-8">
            <div class="card-body">
                <div class="flex justify-between items-start flex-wrap gap-2">
                    <div>
                        <h2 class="card-title text-xl">Pendaftaran ID: <?= htmlspecialchars($pendaftaran['id']) ?></h2>
                        <p class="text-sm opacity-70">User ID: <?= htmlspecialchars($pendaftaran['user_id']) ?></p>
                    </div>
                    <span
                        class="ml-4 px-3 py-1 text-sm rounded-full
    {{ $pendaftaran->status === 'diterima' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                        {{ ucfirst($pendaftaran->status) }}
                    </span>


                </div>

                <div class="divider">Informasi Event</div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="font-semibold">Event:</p>
                        <p><?= htmlspecialchars($pendaftaran['event']['nama_event']) ?>
                            (<?= htmlspecialchars($pendaftaran['event']['tipe_event']) ?>)</p>
                    </div>
                    <div>
                        <p class="font-semibold">Tanggal Daftar:</p>
                        <p><?= htmlspecialchars($pendaftaran['tanggal_daftar']) ?></p>
                    </div>
                </div>

                <?php if ($pendaftaran['tipe_pendaftaran'] === 'perorangan'): ?>
                <div class="divider">Informasi Peserta</div>
                <div class="bg-base-200 p-4 rounded-lg">
                    <div class="flex items-center mb-3">
                        <div class="badge badge-primary mr-2">Perorangan</div>
                        <h3 class="font-bold text-lg">
                            <?= htmlspecialchars($pendaftaran['perorangan']['nama_lengkap']) ?></h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="font-semibold">No HP:</p>
                            <p><?= htmlspecialchars($pendaftaran['perorangan']['no_hp']) ?></p>
                        </div>
                        <div>
                            <p class="font-semibold">Alamat:</p>
                            <p><?= htmlspecialchars($pendaftaran['perorangan']['alamat']) ?></p>
                        </div>
                    </div>
                </div>
                <?php elseif ($pendaftaran['tipe_pendaftaran'] === 'kelompok'): ?>
                <div class="divider">Informasi Kelompok</div>
                <div class="bg-base-200 p-4 rounded-lg">
                    <div class="flex items-center mb-3">
                        <div class="badge badge-secondary mr-2">Kelompok</div>
                        <h3 class="font-bold text-lg"><?= htmlspecialchars($pendaftaran['kelompok']['nama_kelompok']) ?>
                        </h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="font-semibold">No HP Ketua:</p>
                            <p><?= htmlspecialchars($pendaftaran['kelompok']['no_hp_ketua']) ?></p>
                        </div>
                        <div>
                            <p class="font-semibold">Alamat Ketua:</p>
                            <p><?= htmlspecialchars($pendaftaran['kelompok']['alamat_ketua']) ?></p>
                        </div>
                    </div>
                    <div>
                        <p class="font-semibold mb-2">Anggota Kelompok:</p>
                        <div class="overflow-x-auto">
                            <table class="table table-zebra">
                                <thead>
                                    <tr>
                                        <th>No.</th>

                                        <th>No HP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pendaftaran['kelompok']['anggota_kelompok'] as $i => $anggota): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>

                                        <td><?= htmlspecialchars($anggota['no_hp']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="card-actions justify-end mt-4">
                    <button class="btn btn-outline btn-sm"><i class="fas fa-print mr-1"></i> Print</button>
                    <form action="{{ route('checkout') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="pendaftaran_id" value="<?= htmlspecialchars($pendaftaran['id']) ?>">
                        <button type="submit" class="btn btn-outline btn-sm">
                            <i class="fas fa-money-bill-wave mr-1"></i> Bayar
                        </button>
                    </form>



                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <div class="flex justify-between mt-6">
            <a href="../index.php" class="btn btn-outline"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar</a>
            <div>
                <button class="btn btn-outline mr-2"><i class="fas fa-chevron-left"></i></button>
                <button class="btn btn-outline"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
</body>

</html>
