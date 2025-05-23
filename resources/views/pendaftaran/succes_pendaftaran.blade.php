<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-green-100 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white rounded-lg shadow-lg p-8 max-w-md text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-4 h-16 w-16 text-green-500" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2l4 -4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
        </svg>

        <h1 class="text-2xl font-bold text-green-600 mb-2">Pendaftaran Berhasil!</h1>
        <p class="text-gray-700 mb-4">
            Terima kasih telah mendaftar pada event <span class="font-semibold">{{ $event->nama_event }}</span>.
        </p>

        <a href="{{ route('beranda') }}"
            class="inline-block mt-4 bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
            Kembali ke Beranda
        </a>
    </div>

</body>

</html>
