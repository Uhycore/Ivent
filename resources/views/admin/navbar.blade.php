<header class="h-16 bg-white shadow-md flex items-center justify-between px-6">
    <div class="text-xl font-semibold"></div>
    <div class="flex items-center space-x-4">

        <span class="text-gray-700 font-medium">Halo, Admin {{ Auth::user()->username }}</span>

        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Logout</button>
    </div>
</header>
