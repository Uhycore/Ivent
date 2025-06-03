<!-- resources/views/components/form-popup.blade.php -->
<div id="formPopup" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white dark:bg-white p-6 rounded-lg w-full max-w-3xl relative overflow-y-auto max-h-[90vh]">
        <button onclick="closeForm()" class="absolute top-4 right-4 text-xl text-red-500 font-bold">&times;</button>

        <h2 class="text-xl font-bold mb-4 text-gray-800">
            Formulir Pendaftaran: <span class="text-[#001f3f]">{{ $event->nama_event }}</span>
        </h2>

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
                <label for="tipe_pendaftaran" class="block mb-2 text-sm font-medium text-gray-900 text-gray-900">Tipe Pendaftaran</label>
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

            <!-- Form Perorangan -->
            <div id="form_perorangan" class="space-y-6">
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 text-gray-900">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" placeholder="Masukkan Nama" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 text-gray-900">No HP</label>
                    <input type="text" name="no_hp" placeholder="08xxxxxxxxxx" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 text-gray-900">Alamat</label>
                    <textarea name="alamat" rows="2" placeholder="Masukkan alamat"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                </div>
            </div>

            <!-- Form Kelompok -->
            <div id="form_kelompok" class="space-y-6 hidden">
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 text-gray-900">Nama Kelompok</label>
                    <input type="text" name="nama_kelompok" required placeholder="Masukkan Nama Kelompok"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 text-gray-900">No HP Ketua</label>
                    <input type="text" name="no_hp_ketua" required placeholder="Masukkan No Hp Ketua"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 text-gray-900">Alamat Ketua</label>
                    <input type="text" name="alamat_ketua" required placeholder="Masukkan alamat Ketua"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                </div>

                <div id="anggota_fields" class="space-y-4">
                    <label class="block mb-2 text-sm font-semibold text-gray-900 text-gray-900">Anggota Kelompok</label>
                    @for ($i = 1; $i <= $event->max_anggota_kelompok; $i++)
                        <div class="flex space-x-2">
                            <input type="text" name="nama_anggota[]" placeholder="Nama Anggota {{ $i }}" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            <input type="text" name="no_hp_anggota[]" placeholder="No HP Anggota {{ $i }}" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                        </div>
                    @endfor
                </div>
            </div>

            <button type="submit"
                class="w-full bg-[#001f3f] hover:bg-[#003366] text-white font-semibold py-3 rounded-lg text-sm transition-colors duration-300 focus:ring-4 focus:ring-[#005599] focus:outline-none">
                Daftar
            </button>
        </form>
    </div>
</div>

<script>
// Fungsi yang bisa diakses global
window.popupFunctions = {
    openForm: function() {
        const popup = document.getElementById('formPopup');
        if (popup) {
            popup.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    },
    closeForm: function() {
        const popup = document.getElementById('formPopup');
        if (popup) {
            popup.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    },
    toggleForm: function() {
        const tipe = document.getElementById('tipe_pendaftaran')?.value;
        if (!tipe) return;
        
        const formPerorangan = document.getElementById('form_perorangan');
        const formKelompok = document.getElementById('form_kelompok');

        if (formPerorangan && formKelompok) {
            formPerorangan.classList.toggle('hidden', tipe !== 'perorangan');
            formKelompok.classList.toggle('hidden', tipe !== 'kelompok');
        }
    }
};

// Event saat DOM siap
document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi form toggle
    window.popupFunctions.toggleForm();
    
    // Click outside untuk close popup
    document.addEventListener('click', function(event) {
        const popup = document.getElementById('formPopup');
        if (event.target === popup) {
            window.popupFunctions.closeForm();
        }
    });
});
</script>