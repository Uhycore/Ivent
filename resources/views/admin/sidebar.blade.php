<div class="drawer-side">
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
</div>
