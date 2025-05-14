<!-- <div class="drawer-side">
    <label for="my-drawer" class="drawer-overlay"></label>
    <aside class="bg-base-100 w-80 h-full">
        <div class="p-4 bg-primary text-primary-content">
            <div class="flex items-center gap-4">
                <div class="avatar">
                    <div class="w-12 rounded-full">
                        <img src="https://api.dicebear.com/6.x/initials/svg?seed=Admin" alt="Admin" />
                    </div>
                </div>
                <div>
                    <h2 class="text-xl font-bold">Admin Panel</h2>
                    <p class="text-sm opacity-80">User Management</p>
                </div>
            </div>
        </div>
        <ul class="menu p-4 text-base-content">
            <li>
                <a href="index.html" class="active">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pengguna.index') }}">
                    <i class="fas fa-users"></i> Users
                </a>
            </li>
            <li>
                <details>
                    <summary>
                        <i class="fas fa-cog"></i> Settings
                    </summary>
                    <ul>
                        <li><a href="profile-settings.html">Profile</a></li>
                        <li><a href="system-settings.html">System</a></li>
                        <li><a href="security-settings.html">Security</a></li>
                    </ul>
                </details>
            </li>
            <li>
                <a href="reports.html">
                    <i class="fas fa-chart-bar"></i> Reports
                </a>
            </li>
            <li>
                <a href="logs.html">
                    <i class="fas fa-history"></i> Activity Logs
                </a>
            </li>
            <li class="mt-auto">
                <a href="login.html" class="text-error">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </aside>
</div> -->
<aside id="sidebar" class="bg-white shadow-md transition-width duration-300 w-64 flex flex-col">
  <div class="h-16 flex items-center justify-between px-4 border-b">
    <span id="logoText" class="text-xl font-bold">Dashboard</span>
    <button onclick="toggleSidebar()" class="text-gray-600 hover:text-gray-900">↔️</button>
  </div>
  <nav class="mt-0 flex-1 bg-blue-100">
    <ul>
      <!-- User -->
      <a href="{{ route('admin.pengguna.index') }}">
        <li class="flex items-center px-6 py-3 hover:bg-gray-200 cursor-pointer">
          <span class="material-icons mr-3">👤</span>
          <span class="menu-text">Manajemen User</span>
        </li>
      </a>
      <!-- Admin -->
      <a href="../../admin/Admin/AdminList.php">
        <li class="flex items-center px-6 py-3 hover:bg-gray-200 cursor-pointer">
          <span class="mr-3">🛠️</span>
          <span class="menu-text">Manajemen Admin</span>
        </li>
      </a>
      <!-- Event -->
        <li class="px-6 py-3 hover:bg-gray-200 cursor-pointer" onclick="toggleEventSubmenu()">
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <span class="mr-3">📅</span>
              <span class="menu-text">Manajemen Event</span>
            </div>
            <span id="arrow" class="menu-text">v</span>
          </div>
        </li>
        <ul id="event-submenu" class="pl-10 hidden flex-col space-y-2 text-sm text-gray-700">
          <li  id="event-submenu"><a href="../../admin/Event/EventList.php" class="hover:text-blue-600" >Event</a></li>
          <li  id="event-submenu"><a href="../../admin/Event/KelompokList.php" class="hover:text-blue-600" >Event Kelompok</a></li>
          <li  id="event-submenu"><a href="../../admin/Event/PeroranganList.php" class="hover:text-blue-600" >Event Perorangan</a></li>
        </ul>
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

