<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar (fixed at top) -->
    @include('admin.navbar')

    <div class="flex pt-16 h-[calc(100vh-4rem)]">
        <!-- Sidebar (fixed left) -->
        @include('admin.sidebar')

        <!-- Main Content -->
        <main class="ml-0 lg:ml-64 w-full p-6 overflow-y-auto">
            <h2 class="text-2xl font-bold mb-6">Dashboard Overview</h2>

            <!-- Stat Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Total Users Card -->
                <div class="stats shadow bg-white">
                    <div class="stat">
                        <div class="stat-figure text-primary">
                            <i class="fas fa-users text-3xl"></i>
                        </div>
                        <div class="stat-title">Total Users</div>
                        <div class="stat-value text-primary">{{ $totalPengguna }}</div>
                        <div class="stat-desc">↗︎ 12% from last month</div>
                    </div>
                </div>

                <!-- Total Events Card -->
                <div class="stats shadow bg-white">
                    <div class="stat">
                        <div class="stat-figure text-secondary">
                            <i class="fas fa-calendar-alt text-3xl"></i>
                        </div>
                        <div class="stat-title">Total Events</div>
                        <div class="stat-value text-secondary">{{ $totalEvent }}</div>
                        <div class="stat-desc">↗︎ 8% from last month</div>
                    </div>
                </div>

                <!-- Total Registrations Card -->
                <div class="stats shadow bg-white">
                    <div class="stat">
                        <div class="stat-figure text-accent">
                            <i class="fas fa-ticket-alt text-3xl"></i>
                        </div>
                        <div class="stat-title">Total Registrations</div>
                        <div class="stat-value text-accent">{{ $totalPendaftaran }}</div>
                        <div class="stat-desc">↗︎ 15% from last month</div>
                    </div>
                </div>

                <!-- Total Revenue Card -->
                <div class="stats shadow bg-white">
                    <div class="stat">
                        <div class="stat-figure text-success">
                            {{-- <i class="fas fa-rupiyah-sign text-3xl"></i> --}}
                        </div>
                        <div class="stat-title">Total Revenue</div>
                        <div class="stat-value text-success">Rp. {{ number_format($totalTransaksi, 0, ',', '.') }}</div>
                        <div class="stat-desc">↗︎ 22% from last month</div>
                    </div>
                </div>

            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                <!-- Bar Chart: Participants per Event -->
                <div class="card bg-white shadow-md">
                    <div class="card-body">
                        <h3 class="card-title">Participants per Event</h3>
                        <div class="h-80">
                            <canvas id="participantsChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Line Chart: Revenue per Month -->
                <div class="card bg-white shadow-md">
                    <div class="card-body">
                        <h3 class="card-title">Revenue per Month</h3>
                        <div class="h-80">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart: Registration Status -->
            <div class="card bg-white shadow-md mt-6">
                <div class="card-body">
                    <h3 class="card-title">Registration Status Distribution</h3>
                    <div class="flex justify-center">
                        <div class="w-full md:w-1/2 lg:w-1/3 h-80">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Events Table -->
            <div class="card bg-white shadow-md mt-6">
                <div class="card-body">
                    <h3 class="card-title">Recent Events</h3>
                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <thead>
                                <tr>
                                    <th>Nama ivent</th>
                                    <th>Tanggal</th>
                                    <th>Tipe ivent</th>
                                    <th>Registrations</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($event as $event)
                                    <tr>
                                        <td>{{ $event['nama_event'] }}</td>
                                        <td>{{ \Carbon\Carbon::parse($event['tanggal'])->format('M d, Y') }}</td>
                                        <td>

                                            {{ ucfirst($event['tipe_event']) }}
                                        </td>
                                        <td>
                                            {{ $event['kuota']-$event['sisa_kuota'] }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </main>


    </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const pesertaPerEvent = @json($pesertaPerEvent);
        const pendapatanPerBulan = @json($pendapatanPerBulan);
        const statusPendaftaran = @json($statusPendaftaran);

        const eventLabels = pesertaPerEvent.map(e => 'Event #' + e.event_id);
        const pesertaCounts = pesertaPerEvent.map(e => e.total);

        const participantsCtx = document.getElementById('participantsChart').getContext('2d');
        new Chart(participantsCtx, {
            type: 'bar',
            data: {
                labels: eventLabels,
                datasets: [{
                    label: 'Jumlah Peserta',
                    data: pesertaCounts,
                    backgroundColor: '#3b82f6',
                    borderColor: '#2563eb',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const namaBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        const bulanPendapatan = pendapatanPerBulan.map(e => namaBulan[e.bulan - 1]);
        const nilaiPendapatan = pendapatanPerBulan.map(e => e.total);

        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: bulanPendapatan,
                datasets: [{
                    label: 'Pendapatan',
                    data: nilaiPendapatan,
                    borderColor: '#10b981',
                    backgroundColor: '#34d399',
                    tension: 0.2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const statusLabels = statusPendaftaran.map(e => e.status);
        const statusCounts = statusPendaftaran.map(e => e.total);

        const colors = ['#60a5fa', '#fcd34d', '#f87171', '#a78bfa', '#34d399']; // Bisa ditambah jika perlu

        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'pie',
            data: {
                labels: statusLabels,
                datasets: [{
                    label: 'Status Pendaftaran',
                    data: statusCounts,
                    backgroundColor: colors.slice(0, statusLabels.length)
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>


</body>

</html>
