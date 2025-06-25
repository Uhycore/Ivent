<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Event Kelompok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<div class="flex h-screen">
    <aside class="w-64 h-full overflow-y-auto bg-white">
        @include('admin.sidebar')
    </aside>
    <div class="flex-1 flex flex-col">
        @include('admin.navbar')
        <main class="flex-1 p-6 overflow-y-auto mt-16">

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

                        <!-- Tipe Event -->
                        <div>
                            <label for="tipe_event" class="block text-gray-700 font-medium mb-1">Tipe Event</label>
                            <select id="tipe_event" name="tipe_event"
                                class="w-full border border-gray-300 rounded px-4 py-2 @error('tipe_event') border-red-500 @enderror"
                                required>
                                <option value="" disabled {{ old('tipe_event') ? '' : 'selected' }}>Pilih tipe
                                    event</option>
                                <option value="semua"
                                    {{ old('tipe_event', $event->tipe_event ?? '') == 'semua' ? 'selected' : '' }}>Semua
                                </option>
                                <option value="perorangan"
                                    {{ old('tipe_event', $event->tipe_event ?? '') == 'perorangan' ? 'selected' : '' }}>
                                    Perorangan</option>
                                <option value="kelompok"
                                    {{ old('tipe_event', $event->tipe_event ?? '') == 'kelompok' ? 'selected' : '' }}>
                                    Kelompok</option>
                            </select>
                            @error('tipe_event')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Kuota -->
                        <div>
                            <label for="kuota" class="block text-gray-700 font-medium mb-1">Kuota Peserta</label>
                            <input type="number" id="kuota" name="kuota" min="1"
                                class="w-full border border-gray-300 rounded px-4 py-2 @error('kuota') border-red-500 @enderror"
                                placeholder="Masukkan kuota peserta" value="{{ old('kuota', $event->kuota ?? '') }}"
                                required>
                            @error('kuota')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Sisa Kuota --}}
                        <div>
                            <label for="sisa_kuota" class="block text-gray-700 font-medium mb-1">Sisa Kuota</label>
                            <input type="number" id="sisa_kuota" name="sisa_kuota" min="0"
                                class="w-full border border-gray-300 rounded px-4 py-2 @error('sisa_kuota') border-red-500 @enderror"
                                placeholder="Masukkan sisa kuota"
                                value="{{ old('sisa_kuota', $event->sisa_kuota ?? '') }}" required>
                            @error('sisa_kuota')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Max Anggota Kelompok -->
                        <div>
                            <label for="max_anggota_kelompok" class="block text-gray-700 font-medium mb-1">Maksimal
                                Anggota Kelompok</label>
                            <input type="number" id="max_anggota_kelompok" name="max_anggota_kelompok" min="0"
                                class="w-full border border-gray-300 rounded px-4 py-2 @error('max_anggota_kelompok') border-red-500 @enderror"
                                placeholder="Masukkan maksimal anggota kelompok"
                                value="{{ old('max_anggota_kelompok', $event->max_anggota_kelompok ?? '') }}" required>
                            @error('max_anggota_kelompok')
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
                    <!-- Gambar -->
                    <div class="mt-4">
                        <label for="gambar" class="block text-gray-700 font-medium mb-1">Gambar</label>
                        <input type="file" id="gambar" name="gambar"
                            class="w-full border border-gray-300 rounded px-4 py-2 @error('gambar') border-red-500 @enderror"
                            accept="image/*">
                        @error('gambar')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        @if ($event->gambar)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $event->gambar) }}" alt="Gambar Event"
                                    class="w-32 h-32 object-cover rounded">
                            </div>
                        @endif
                    </div>

                    <!-- Harga Pendaftaran -->
                    <div class="mt-4">
                        <label for="harga_pendaftaran" class="block text-gray-700 font-medium mb-1">Harga
                            Pendaftaran</label>
                        <input type="number" id="harga_pendaftaran" name="harga_pendaftaran" min="0"
                            class="w-full border border-gray-300 rounded px-4 py-2 @error('harga_pendaftaran') border-red-500 @enderror"
                            placeholder="Masukkan harga pendaftaran"
                            value="{{ old('harga_pendaftaran', $event->harga_pendaftaran) }}" required>
                        @error('harga_pendaftaran')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
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
