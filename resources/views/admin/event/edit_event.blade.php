<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Event Kelompok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<body class="flex h-screen bg-gray-100">
    @include('admin.sidebar')

    <div class="flex-1 flex flex-col">
        @include('admin.navbar')

        <main class="flex-1 p-6">
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Edit Event</h2>

                <form method="POST" action="{{ route('admin.event.update', $event->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Event -->
                        <div>
                            <label for="nama_event" class="block text-gray-700 font-medium mb-1">Nama Event</label>
                            <input type="text" id="nama_event" name="nama_event"
                                class="w-full border border-gray-300 rounded px-4 py-2 @error('nama_event') border-red-500 @enderror"
                                placeholder="Masukkan nama event" value="{{ old('nama_event', $event->nama_event) }}"
                                required>
                            @error('nama_event')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tanggal -->
                        <div>
                            <label for="tanggal" class="block text-gray-700 font-medium mb-1">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal"
                                class="w-full border border-gray-300 rounded px-4 py-2 @error('tanggal') border-red-500 @enderror"
                                value="{{ old('tanggal', $event->tanggal) }}" required>
                            @error('tanggal')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="md:col-span-2">
                            <label for="deskripsi" class="block text-gray-700 font-medium mb-1">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" rows="4"
                                class="w-full border border-gray-300 rounded px-4 py-2 @error('deskripsi') border-red-500 @enderror"
                                placeholder="Masukkan deskripsi event" required>{{ old('deskripsi', $event->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="mt-6">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                            Update Event
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
