<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Event - {{ $event->nama_event }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white shadow-md rounded-lg max-w-xl w-full p-6">
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
                    class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2 shadow-sm"
                    onchange="toggleForm()">
                    @if ($event->tipe_event == 'perorangan' || $event->tipe_event == 'semua')
                        <option value="perorangan">Perorangan</option>
                    @endif
                    @if ($event->tipe_event == 'kelompok' || $event->tipe_event == 'semua')
                        <option value="kelompok">Kelompok</option>
                    @endif
                </select>
            </div>

            {{-- Form perorangan --}}
            <div id="form_perorangan" class="space-y-4">
                <div>
                    <label class="block font-medium">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-input w-full" />
                </div>
                <div>
                    <label class="block font-medium">No HP</label>
                    <input type="text" name="no_hp" class="form-input w-full" />
                </div>
                <div>
                    <label class="block font-medium">Alamat</label>
                    <textarea name="alamat" rows="2" class="form-textarea w-full"></textarea>
                </div>
            </div>

            <!-- Form Kelompok -->
            <div id="form_kelompok" class="space-y-4 hidden">
                <div>
                    <label class="block mb-1 font-medium">Nama Kelompok</label>
                    <input type="text" name="nama_kelompok" required class="w-full border rounded p-2" />
                </div>
                <div>
                    <label class="block mb-1 font-medium">No HP Ketua</label>
                    <input type="text" name="no_hp_ketua" required class="w-full border rounded p-2" />
                </div>
                <div>
                    <label class="block mb-1 font-medium">Alamat Ketua</label>
                    <input type="text" name="alamat_ketua" required class="w-full border rounded p-2" />
                </div>

                <div id="anggota_fields" class="space-y-2">
                    <label class="block mb-1 font-semibold text-gray-700">Anggota Kelompok</label>
                    @for ($i = 1; $i <= $event->max_anggota_kelompok; $i++)
                        <div class="flex space-x-2">
                            <input type="text" name="nama_anggota[]" placeholder="Nama Anggota {{ $i }}"
                                class="w-full border rounded p-2" required>
                            <input type="text" name="no_hp_anggota[]" placeholder="No HP Anggota {{ $i }}"
                                class="w-full border rounded p-2" required>
                        </div>
                    @endfor
                </div>
            </div>


            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-md transition-colors duration-300">
                Daftar
            </button>
        </form>
    </div>

    <script>
        function toggleForm() {
            const tipe = document.getElementById('tipe_pendaftaran').value;

            const formPerorangan = document.getElementById('form_perorangan');
            const formKelompok = document.getElementById('form_kelompok');

            // Tampilkan atau sembunyikan form
            formPerorangan.classList.toggle('hidden', tipe !== 'perorangan');
            formKelompok.classList.toggle('hidden', tipe !== 'kelompok');

            // Set required hanya di input yang terlihat
            setFormRequired(formPerorangan, tipe === 'perorangan');
            setFormRequired(formKelompok, tipe === 'kelompok');
        }

        function setFormRequired(container, isRequired) {
            const inputs = container.querySelectorAll('input');
            inputs.forEach(input => {
                if (isRequired) {
                    input.setAttribute('required', 'required');
                } else {
                    input.removeAttribute('required');
                }
            });
        }

        document.getElementById('tipe_pendaftaran').addEventListener('change', toggleForm);
        document.addEventListener('DOMContentLoaded', toggleForm);
    </script>



</body>

</html>
