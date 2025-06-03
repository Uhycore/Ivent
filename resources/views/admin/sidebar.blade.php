<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />
<aside id="sidebar" style="background-color: rgb(33, 37, 41);" class="shadow-md transition-width duration-300 w-56 flex flex-col overflow-y-auto h-screen fixed">
    
    <nav class="mt-0 flex-1 z-[1000]" style="background-color: rgb(33, 37, 41);">
        <ul>
        <a href="{{ route('admin.dashboard') }}">
                <li class="flex items-center px-6 py-3 cursor-pointer hover:bg-gray-700">
                    <span class="material-symbols-rounded mr-2" style="color: rgb(89, 92, 95);">person</span>
                    <span class="menu-text text-gray-400 hover:text-white">Dasboard</span>
                </li>
            </a>
            <!-- Pendaftar -->
            <a href="{{ route('admin.pendaftar') }}">
                <li class="flex items-center px-6 py-3 cursor-pointer hover:bg-gray-700">
                    <span class="material-symbols-rounded mr-2" style="color: rgb(89, 92, 95);">person</span>
                    <span class="menu-text text-gray-400 hover:text-white">Pendaftar</span>
                </li>
            </a>
            <!-- Pengguna -->
            <a href="{{ route('admin.pengguna.index') }}">
                <li class="flex items-center px-6 py-3 cursor-pointer hover:bg-gray-700">
                    <span class="material-symbols-rounded mr-2" style="color: rgb(89, 92, 95);">group</span>
                    <span class="menu-text text-gray-400 hover:text-white">Manajemen Pengguna</span>
                </li>
            </a>
            <!-- Event -->
            <a href="{{ route('admin.event.index') }}">
                <li class="flex items-center px-6 py-3 cursor-pointer hover:bg-gray-700">
                    <span class="material-symbols-rounded mr-2" style="color: rgb(89, 92, 95);">calendar_today</span>
                    <span class="menu-text text-gray-400 hover:text-white">Manajemen Event</span>
                </li>
            </a>
            <!-- Transaksi -->
            <a href="{{ route('admin.transaksi.index') }}">
                <li class="flex items-center px-6 py-3 cursor-pointer hover:bg-gray-700">
                    <span class="material-symbols-rounded mr-2" style="color: rgb(89, 92, 95);">receipt</span>
                    <span class="menu-text text-gray-400 hover:text-white">List Transaksi</span>
                </li>
            </a>
            
            <!-- If you want to keep the expandable submenu version -->
            {{-- <li class="px-6 py-3 mt-3 cursor-pointer hover:bg-gray-700" onclick="toggleEventSubmenu()">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <span class="material-symbols-rounded mr-2" style="color: rgb(89, 92, 95);">calendar_today</span>
                        <span class="menu-text text-gray-400 hover:text-white">Manajemen Event</span>
                    </div>
                    <span id="arrow" class="menu-text text-gray-400 hover:text-white">v</span>
                </div>
            </li>
            <ul id="event-submenu" class="pl-10 mt-3 hidden flex-col space-y-2 text-sm">
                <li class="hover:bg-gray-700 py-2"><a href="{{ route('admin.event.index') }}" class="text-gray-400 hover:text-white">Event</a></li>
                <li class="hover:bg-gray-700 py-2"><a href="#" class="text-gray-400 hover:text-white">Event Kelompok</a></li>
                <li class="hover:bg-gray-700 py-2"><a href="#" class="text-gray-400 hover:text-white">Event Perorangan</a></li>
            </ul> --}}
        </ul>
    </nav>
</aside>
<script>
    function toggleEventSubmenu() {
        const submenu = document.getElementById("event-submenu");
        const arrow = document.getElementById("arrow");

        if (submenu && arrow) {
            submenu.classList.toggle("hidden");
            arrow.textContent = submenu.classList.contains("hidden") ? "v" : "^";
        }
    }
</script>