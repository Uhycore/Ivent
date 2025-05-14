<div id="createEventForm" class="hidden bg-white shadow-md rounded-lg p-6 mb-6">
  <h2 class="text-xl font-semibold mb-4 text-gray-800">Create New Admin</h2>
  <form action="storeUser.php" method="POST" class="space-y-4">
    <div>
      <label class="block text-gray-700 font-medium mb-1">ID</label>
      <input type="text" name="id" class="w-full border border-gray-300 rounded px-4 py-2" required>
    </div>
    <div>
      <label class="block text-gray-700 font-medium mb-1">Nama Event</label>
      <select name="nama_event" class="w-full border border-gray-300 rounded px-4 py-2" required>
        <option value="">-- Pilih Kategori --</option>
        <option value="1">Perorangan</option>
        <option value="2">Beregu</option>
      </select>
    </div>
    <div>
      <label class="block text-gray-700 font-medium mb-1">Tanggal</label>
      <input type="text" name="tgl" class="w-full border border-gray-300 rounded px-4 py-2" required>
    </div>
    <div>
      <label class="block text-gray-700 font-medium mb-1">Deskripsi</label>
      <input type="text" name="deskripsi" class="w-full border border-gray-300 rounded px-4 py-2" required>
    </div>
    <div>
      <label class="block text-gray-700 font-medium mb-1">Upload Poster</label>
      <input type="file" name="poster" accept="image/*" class="w-full border border-gray-300 rounded px-4 py-2 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200">
    </div>
    <div class="flex justify-end">
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">Simpan</button>
    </div>
  </form>
</div>
