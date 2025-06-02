<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
  <!-- Navbar -->
  @include ('admin.navbar')
  
  <div class="flex pt-16">
    <!-- Sidebar -->
    @include ('admin.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-6 ml-0 md:ml-56 transition-all duration-300">
      <!-- Dashboard Section -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
      </div>

      <!-- Statistic Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 shadow rounded-2xl">
          <p class="text-sm text-gray-500">Total Users</p>
          <p class="text-2xl font-bold">2,340</p>
        </div>
        <div class="bg-white p-4 shadow rounded-2xl">
          <p class="text-sm text-gray-500">Sales Today</p>
          <p class="text-2xl font-bold">11.450.000</p>
        </div>
        <div class="bg-white p-4 shadow rounded-2xl">
          <p class="text-sm text-gray-500">New Orders</p>
          <p class="text-2xl font-bold">87</p>
        </div>
        <div class="bg-white p-4 shadow rounded-2xl">
          <p class="text-sm text-gray-500">Pending Tasks</p>
          <p class="text-2xl font-bold">14</p>
        </div>
      </div>

      <!-- Charts -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-4 shadow rounded-2xl">
          <h2 class="text-lg font-semibold mb-2">User Growth</h2>
          <canvas id="userGrowthChart"></canvas>
        </div>

        <div class="bg-white p-4 shadow rounded-2xl">
          <h2 class="text-lg font-semibold mb-2">Monthly Sales</h2>
          <canvas id="monthlySalesChart"></canvas>
        </div>
      </div>

      <!-- Example Table -->
      <div class="bg-white p-6 rounded-2xl shadow mb-10">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Detail Event</h2>

        <!-- Info Event -->
        <div class="bg-white p-6 rounded-xl shadow-md space-y-6 max-w-3xl mx-auto my-8">
          <div>
            <h2 class="text-lg font-semibold text-gray-800">Hackathon Nasional 2025</h2>
            <div class="flex gap-2 mt-2">
              <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Sukses</span>
              <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">Kelompok</span>
            </div>
          </div>

          <div>
            <h3 class="text-sm font-medium text-gray-600 mb-1">Ketua Kelompok</h3>
            <div class="text-sm text-gray-800">
              <p>Hasan Nur Habi</p>
              <p>📍 Jl. Margorejo Indah No. 21, Surabaya</p>
              <p>📞 0812-3456-7890</p>
            </div>
          </div>

          <div>
            <h3 class="text-sm font-medium text-gray-600 mb-1">Anggota Kelompok</h3>
            <ul class="text-sm text-gray-800 space-y-2">
              <li>
                <span class="font-medium">1. Sinta Maharani</span><br>
                📍 Jl. Pemalang Barat No. 5<br>
                📞 0813-2222-1111
              </li>
              <li>
                <span class="font-medium">2. Rafi Ramadhan</span><br>
                📍 Jl. Pucang Anom, Surabaya<br>
                📞 0812-9876-5432
              </li>
            </ul>
          </div>
        </div>
        
        <!-- Perorangan -->
        <div class="bg-white p-6 rounded-xl shadow-md max-w-3xl mx-auto my-8 space-y-6">
          <!-- Judul & Status -->
          <div>
            <h2 class="text-xl font-semibold text-gray-800">Lomba Fotografi Nasional 2025</h2>
            <div class="flex gap-2 mt-2">
              <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full">Pending</span>
              <span class="text-xs bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full">Perorangan</span>
            </div>
          </div>

          <!-- Informasi Pendaftar -->
          <div>
            <div class="text-sm text-gray-800 space-y-1">
              <p><span class="font-medium">Nama:</span> Sinta Maharani</p>
              <p><span class="font-medium">Alamat:</span> Jl. Pemalang Barat No. 5, Pemalang</p>
              <p><span class="font-medium">No. Telepon:</span> 0813-2222-1111</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Scripts -->
      <script>
        const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
        const userGrowthChart = new Chart(userGrowthCtx, {
          type: 'bar',
          data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            datasets: [{
              label: 'Users',
              data: [50, 100, 150, 120, 180],
              backgroundColor: '#3B82F6'
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: { display: false }
            },
            scales: {
              y: { beginAtZero: true }
            }
          }
        });

        const monthlySalesCtx = document.getElementById('monthlySalesChart').getContext('2d');
        const monthlySalesChart = new Chart(monthlySalesCtx, {
          type: 'line',
          data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            datasets: [{
              label: 'Sales',
              data: [200, 400, 300, 500, 700],
              borderColor: '#10B981',
              backgroundColor: 'rgba(16,185,129,0.1)',
              tension: 0.4,
              fill: true
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: { display: false }
            },
            scales: {
              y: { beginAtZero: true }
            }
          }
        });
      </script>
    </main>
  </div>
</body>
</html>