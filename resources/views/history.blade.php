<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Pendaftaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Daftar Pendaftaran</h1>

    <div class="max-w-4xl mx-auto space-y-6">
        <?php foreach ($pendaftaranList as $pendaftaran): ?>
        <div class="bg-white shadow rounded-lg p-6 border border-gray-200">
            <h2 class="text-xl font-semibold mb-2">Pendaftaran ID: <?= htmlspecialchars($pendaftaran['id']) ?></h2>
            <p><span class="font-medium">User ID:</span> <?= htmlspecialchars($pendaftaran['user_id']) ?></p>
            <p><span class="font-medium">Event:</span> <?= htmlspecialchars($pendaftaran['event']['nama_event']) ?>
                (<?= htmlspecialchars($pendaftaran['event']['tipe_event']) ?>)</p>
            <p><span class="font-medium">Tanggal Daftar:</span> <?= htmlspecialchars($pendaftaran['tanggal_daftar']) ?>
            </p>
            <p><span class="font-medium">Status:</span>
                <span
                    class="<?= $pendaftaran['status'] === 'Diterima' ? 'text-green-600' : ($pendaftaran['status'] === 'Menunggu' ? 'text-yellow-600' : 'text-red-600') ?>">
                    <?= htmlspecialchars($pendaftaran['status']) ?>
                </span>
            </p>

            <?php if ($pendaftaran['tipe_pendaftaran'] === 'perorangan'): ?>
            <div class="mt-4 p-4 bg-gray-50 rounded">
                <h3 class="font-semibold mb-2">Peserta Perorangan</h3>
                <p><span class="font-medium">Nama Lengkap:</span>
                    <?= htmlspecialchars($pendaftaran['perorangan']['nama_lengkap']) ?></p>
                <p><span class="font-medium">No HP:</span> <?= htmlspecialchars($pendaftaran['perorangan']['no_hp']) ?>
                </p>
                <p><span class="font-medium">Alamat:</span>
                    <?= htmlspecialchars($pendaftaran['perorangan']['alamat']) ?></p>
            </div>
            <?php elseif ($pendaftaran['tipe_pendaftaran'] === 'kelompok'): ?>
            <div class="mt-4 p-4 bg-gray-50 rounded">
                <h3 class="font-semibold mb-2">Kelompok</h3>
                <p><span class="font-medium">Nama Kelompok:</span>
                    <?= htmlspecialchars($pendaftaran['kelompok']['nama_kelompok']) ?></p>
                <p><span class="font-medium">No HP Ketua:</span>
                    <?= htmlspecialchars($pendaftaran['kelompok']['no_hp_ketua']) ?></p>
                <p><span class="font-medium">Alamat Ketua:</span>
                    <?= htmlspecialchars($pendaftaran['kelompok']['alamat_ketua']) ?></p>

                <h4 class="mt-3 font-semibold">Anggota Kelompok:</h4>
                <ul class="list-disc list-inside">
                    <?php foreach ($pendaftaran['kelompok']['anggota_kelompok'] as $anggota): ?>
                    <li><?= htmlspecialchars($anggota['nama_anggota']) ?> (No HP:
                        <?= htmlspecialchars($anggota['no_hp']) ?>)</li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
</body>

</html>
