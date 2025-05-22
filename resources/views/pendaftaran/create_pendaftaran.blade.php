<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Event - {{ $event->nama_event }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white shadow-md rounded-lg max-w-lg w-full p-6">
        <h2 class="text-3xl font-semibold mb-6 text-center">Daftar Event: <span
                class="text-blue-600">{{ $event->nama_event }}</span></h2>

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

            <div>
                <label for="tipe_pendaftaran" class="block mb-2 font-medium text-gray-700">Tipe Pendaftaran</label>
                <select id="tipe_pendaftaran" name="tipe_pendaftaran" required
                    class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                    @if ($event->tipe_event == 'perorangan' || $event->tipe_event == 'semua')
                        <option value="perorangan">Perorangan</option>
                    @endif
                    @if ($event->tipe_event == 'kelompok' || $event->tipe_event == 'semua')
                        <option value="kelompok">Kelompok</option>
                    @endif
                </select>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-md transition-colors duration-300">
                Daftar
            </button>
        </form>
    </div>
    <?php
    echo "<pre>";
    print_r($event->toArray());
    echo "</pre>";
    echo "<pre>";
    print_r($user->toArray());
    echo "</pre>";
    ?>

</body>

</html>
