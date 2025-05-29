<aside id="sidebar" class="bg-white shadow-md transition-width duration-300 w-64 flex flex-col">
    <div class="h-16 flex items-center justify-between px-4 border-b">
        <span id="logoText" class="text-xl font-bold">Dashboard</span>
        <button onclick="toggleEventSubmenu()" class="text-gray-600 hover:text-gray-900">↔️</button>
    </div>
    <nav class="mt-0 flex-1 bg-blue-100">
        <ul>
            <!-- User -->
            <a href="{{ route('admin.pendaftar') }}">
                <li class="flex items-center px-6 py-3 hover:bg-gray-200 cursor-pointer">
                    <span class="material-icons mr-3">👤</span>
                    <span class="menu-text">pendaftar</span>
                </li>
            </a>
            <!-- User -->
            <a href="{{ route('admin.pengguna.index') }}">
                <li class="flex items-center px-6 py-3 hover:bg-gray-200 cursor-pointer">
                    <span class="material-icons mr-3">👤</span>
                    <span class="menu-text">Manajemen Pengguna</span>
                </li>
            </a>
            <!-- Admin -->
            <a href="{{ route('admin.event.index') }}">
                <li class="flex items-center px-6 py-3 hover:bg-gray-200 cursor-pointer">
                    <span class="mr-3">🛠️</span>
                    <span class="menu-text">Manajemen Event</span>
                </li>
            </a>
            <a href="{{ route('admin.transaksi.index') }}">
                <li class="flex items-center px-6 py-3 hover:bg-gray-200 cursor-pointer">
                    <span class="mr-3">🛠️</span>
                    <span class="menu-text">List Transaksi</span>
                </li>
            </a>
            <!-- Event -->
            {{-- <li class="px-6 py-3 hover:bg-gray-200 cursor-pointer" onclick="toggleEventSubmenu()">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <span class="mr-3">📅</span>
                        <span class="menu-text">Manajemen Event</span>
                    </div>
                    <span id="arrow" class="menu-text">v</span>
                </div>
            </li>
            <ul id="event-submenu" class="pl-10 hidden flex-col space-y-2 text-sm text-gray-700">
                <li id="event-submenu"><a href="../../admin/Event/EventList.php" class="hover:text-blue-600">Event</a>
                </li>
                <li id="event-submenu"><a href="../../admin/Event/KelompokList.php" class="hover:text-blue-600">Event
                        Kelompok</a></li>
                <li id="event-submenu"><a href="../../admin/Event/PeroranganList.php" class="hover:text-blue-600">Event
                        Perorangan</a></li>
            </ul> --}}
        </ul>
    </nav>
</aside>
<script>
    function toggleEventSubmenu() {
        const submenu = document.getElementById("event-submenu");
        const arrow = document.getElementById("arrow");

        submenu.classList.toggle("hidden");
        arrow.textContent = submenu.classList.contains("hidden") ? "v" : "^";
    }
</script>
