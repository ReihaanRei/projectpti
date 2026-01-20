<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
        }

        .status-card {
            border-radius: 16px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .status-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 0 0 0 80px;
        }

        .status-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .nav-item {
            padding: 0.875rem 1rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-item:hover {
            background: linear-gradient(90deg, rgba(37, 99, 235, 0.1) 0%, rgba(37, 99, 235, 0.05) 100%);
            color: #2563EB;
            transform: translateX(5px);
        }

        .nav-item.active {
            background: linear-gradient(90deg, #2563EB 0%, #1D4ED8 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.2);
        }

        .quick-action-btn {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s ease;
        }

        .quick-action-btn:hover {
            background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.25);
        }

        .quick-action-btn:hover .action-icon {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .action-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            transition: all 0.3s ease;
        }

        .chart-container {
            background: white;
            border-radius: 20px;
            border: 1px solid #e5e7eb;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .chart-container:hover {
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.05);
        }

        .chart-tab {
            padding: 0.625rem 1.25rem;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
            background: #f3f4f6;
            color: #6b7280;
        }

        .chart-tab:hover {
            background: #e5e7eb;
        }

        .chart-tab.active {
            background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.2);
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(37, 99, 235, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(37, 99, 235, 0);
            }
        }

        .sidebar {
            transition: all 0.3s ease;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .user-dropdown {
            transition: all 0.3s ease;
            transform-origin: top right;
        }

        .user-dropdown.show {
            animation: scaleIn 0.2s ease;
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                z-index: 40;
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .mobile-menu-btn {
                display: block;
            }

            .content-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 30;
            }

            .content-overlay.active {
                display: block;
            }
        }

        .trend-indicator {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            gap: 0.25rem;
        }

        .trend-up {
            background: #d1fae5;
            color: #065f46;
        }

        .trend-down {
            background: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
    <!-- Top Navbar -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-700 py-4 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <button class="mobile-menu-btn text-white lg:hidden" onclick="toggleSidebar()">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="flex items-center gap-2">
                    <div class="bg-white/20 p-2.5 rounded-xl">
                        <i class="fas fa-shield-alt text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-white text-xl font-bold">Admin Dashboard</h1>
                        <p class="text-blue-100 text-xs">Panel Kontrol Administrasi</p>
                    </div>
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="relative">
                <button onclick="toggleUserDropdown()"
                    class="flex items-center gap-2 text-white focus:outline-none hover:bg-blue-700/30 px-3 py-2 rounded-xl transition-colors">
                    <div class="bg-white/20 p-1.5 rounded-full">
                        <i class="fas fa-user-circle text-xl"></i>
                    </div>
                    <div class="hidden md:block text-left">
                        <div class="font-medium">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-blue-200">Administrator</div>
                    </div>
                    <i class="fas fa-chevron-down text-sm"></i>
                </button>

                <div id="userDropdown"
                    class="user-dropdown hidden absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl overflow-hidden z-50 border border-gray-200">
                    <div class="p-4 border-b border-gray-100">
                        <div class="font-medium text-gray-900">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-500">Administrator</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-600 flex items-center gap-3 transition-colors">
                            <div class="bg-red-100 p-2 rounded-lg">
                                <i class="fas fa-sign-out-alt text-red-600"></i>
                            </div>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar Overlay (Mobile) -->
        <div class="content-overlay" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <aside class="sidebar bg-white shadow-xl w-64 lg:w-72 p-6">
            <nav class="space-y-1.5 mt-4">
                <a href="{{ route('adminDashboard') }}" class="nav-item active">
                    <div class="bg-blue-100 p-2 rounded-lg">
                        <i class="fas fa-tachometer-alt text-blue-600"></i>
                    </div>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.listProduct') }}" class="nav-item">
                    <div class="bg-blue-100 p-2 rounded-lg">
                        <i class="fas fa-box-open text-blue-600"></i>
                    </div>
                    <span>Produk</span>
                </a>
                <a href="{{ route('admin.listCategory') }}" class="nav-item">
                    <div class="bg-blue-100 p-2 rounded-lg">
                        <i class="fas fa-tags text-blue-600"></i>
                    </div>
                    <span>Kategori</span>
                </a>
                <a href="{{ route('admin.transactions') }}" class="nav-item">
                    <div class="bg-blue-100 p-2 rounded-lg">
                        <i class="fas fa-receipt text-blue-600"></i>
                    </div>
                    <span>Transaksi</span>
                </a>
            </nav>

            {{-- <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4">
                    <div class="flex items-center gap-3">
                        <div class="bg-blue-100 p-2.5 rounded-lg">
                            <i class="fas fa-chart-line text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Performa Sistem</p>
                            <p class="text-xs text-gray-500">Semua berjalan baik</p>
                        </div>
                    </div>
                </div>
            </div> --}}
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4 md:p-6 lg:p-8">
            <div class="max-w-7xl mx-auto space-y-6 md:space-y-8">
                <!-- Welcome Banner -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-6 md:p-8 text-white fade-in">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-2xl md:text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋
                            </h2>
                            <p class="text-blue-100">Kelola toko Anda dengan mudah melalui dashboard ini</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="bg-white/20 p-3 rounded-xl">
                                <i class="fas fa-calendar-alt text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-blue-200">Tanggal</p>
                                <p class="font-semibold">{{ now()->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 md:gap-6">
                    <div class="stat-card fade-in" style="animation-delay: 0.1s">
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-blue-100 p-3 rounded-xl">
                                <i class="fas fa-box text-blue-600 text-xl"></i>
                            </div>
                            <span class="trend-indicator trend-up">
                                <i class="fas fa-arrow-up"></i>
                                +{{ $produkBulanIni }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mb-1">Total Produk</p>
                        <h3 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $totalProduk }}</h3>
                        <p class="text-xs text-gray-500 mt-2">{{ $produkBulanIni }} produk baru bulan ini</p>
                    </div>

                    <div class="stat-card fade-in" style="animation-delay: 0.2s">
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-green-100 p-3 rounded-xl">
                                <i class="fas fa-tags text-green-600 text-xl"></i>
                            </div>
                            <span class="trend-indicator trend-up">
                                <i class="fas fa-arrow-up"></i>
                                +{{ $kategoriBulanIni }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mb-1">Total Kategori</p>
                        <h3 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $totalKategori }}</h3>
                        <p class="text-xs text-gray-500 mt-2">{{ $kategoriBulanIni }} kategori baru bulan ini</p>
                    </div>

                    {{-- <div class="stat-card fade-in" style="animation-delay: 0.3s">
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-purple-100 p-3 rounded-xl">
                                <i class="fas fa-users text-purple-600 text-xl"></i>
                            </div>
                            <span class="trend-indicator trend-up">
                                <i class="fas fa-arrow-up"></i>
                                +15%
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mb-1">Total Pengguna</p>
                        <h3 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $totalUsers ?? 'N/A' }}</h3>
                        <p class="text-xs text-gray-500 mt-2">Aktif dalam 30 hari terakhir</p>
                    </div>

                    <div class="stat-card fade-in" style="animation-delay: 0.4s">
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-orange-100 p-3 rounded-xl">
                                <i class="fas fa-coins text-orange-600 text-xl"></i>
                            </div>
                            <span class="trend-indicator trend-up">
                                <i class="fas fa-arrow-up"></i>
                                +30%
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mb-1">Total Pendapatan</p>
                        <h3 class="text-2xl md:text-3xl font-bold text-gray-900">
                            Rp{{ number_format($totalRevenue ?? 0, 0, ',', '.') }}
                        </h3>
                        <p class="text-xs text-gray-500 mt-2">Bulan ini</p>
                    </div> --}}
                </div>

                <!-- Transaction Status & Quick Actions -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Transaction Status -->
                    <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="status-card bg-gradient-to-br from-green-50 to-emerald-50 border border-green-200">
                            <div class="flex items-center justify-between mb-2">
                                <div class="bg-green-100 p-2.5 rounded-lg">
                                    <i class="fas fa-check-circle text-green-600"></i>
                                </div>
                                <span class="text-sm text-green-600 font-semibold">PAID</span>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-900">{{ $statusCounts['paid'] ?? 0 }}</h3>
                            <p class="text-sm text-gray-600 mt-1">Transaksi berhasil</p>
                        </div>

                        <div class="status-card bg-gradient-to-br from-yellow-50 to-amber-50 border border-yellow-200">
                            <div class="flex items-center justify-between mb-2">
                                <div class="bg-yellow-100 p-2.5 rounded-lg">
                                    <i class="fas fa-clock text-yellow-600"></i>
                                </div>
                                <span class="text-sm text-yellow-600 font-semibold">PENDING</span>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-900">{{ $statusCounts['pending'] ?? 0 }}</h3>
                            <p class="text-sm text-gray-600 mt-1">Menunggu konfirmasi</p>
                        </div>

                        <div class="status-card bg-gradient-to-br from-red-50 to-rose-50 border border-red-200">
                            <div class="flex items-center justify-between mb-2">
                                <div class="bg-red-100 p-2.5 rounded-lg">
                                    <i class="fas fa-times-circle text-red-600"></i>
                                </div>
                                <span class="text-sm text-red-600 font-semibold">CANCELLED</span>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-900">{{ $statusCounts['cancelled'] ?? 0 }}</h3>
                            <p class="text-sm text-gray-600 mt-1">Transaksi dibatalkan</p>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900">Aksi Cepat</h3>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('admin.createProduct') }}" class="quick-action-btn">
                                <div class="action-icon bg-blue-100 text-blue-600">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <span class="text-sm font-medium">Tambah Produk</span>
                            </a>
                            <a href="{{ route('admin.createCategory') }}" class="quick-action-btn">
                                <div class="action-icon bg-green-100 text-green-600">
                                    <i class="fas fa-tags"></i>
                                </div>
                                <span class="text-sm font-medium">Tambah Kategori</span>
                            </a>
                            <a href="{{ route('admin.transactions') }}" class="quick-action-btn">
                                <div class="action-icon bg-purple-100 text-purple-600">
                                    <i class="fas fa-receipt"></i>
                                </div>
                                <span class="text-sm font-medium">Lihat Transaksi</span>
                            </a>
                            <a href="{{ route('admin.listProduct') }}" class="quick-action-btn">
                                <div class="action-icon bg-orange-100 text-orange-600">
                                    <i class="fas fa-boxes"></i>
                                </div>
                                <span class="text-sm font-medium">Kelola Produk</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- <!-- Sales Chart -->
                <div class="chart-container fade-in">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Grafik Penjualan</h3>
                            <p class="text-sm text-gray-500">Monitor performa penjualan Anda</p>
                        </div>
                        <div class="flex gap-2 overflow-x-auto pb-2">
                            <button onclick="changeChart('daily')" class="chart-tab whitespace-nowrap active">Harian</button>
                            <button onclick="changeChart('weekly')" class="chart-tab whitespace-nowrap">Mingguan</button>
                            <button onclick="changeChart('monthly')" class="chart-tab whitespace-nowrap">Bulanan</button>
                            <button onclick="changeChart('yearly')" class="chart-tab whitespace-nowrap">Tahunan</button>
                        </div>
                    </div>
                    <canvas id="salesChart" height="120"></canvas>
                </div> --}}

                <div class="chart-container fade-in">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Grafik Penjualan</h3>
                            <p class="text-sm text-gray-500">Monitor performa penjualan Anda</p>
                        </div>

                        <div class="flex gap-2 overflow-x-auto">
                            <button data-type="daily" class="chart-tab active">Harian</button>
                            <button data-type="weekly" class="chart-tab">Mingguan</button>
                            <button data-type="monthly" class="chart-tab">Bulanan</button>
                            <button data-type="yearly" class="chart-tab">Tahunan</button>
                        </div>
                    </div>

                    <!-- FIX RESPONSIVE HEIGHT -->
                    <div class="relative h-[260px] md:h-[320px]">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>

                <!-- Recent Activity -->
                {{-- <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="chart-container">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aktivitas Terbaru</h3>
                        <div class="space-y-4">
                            @for ($i = 0; $i < 3; $i++)
                                <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="bg-blue-100 p-2.5 rounded-lg">
                                        <i class="fas fa-box text-blue-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Produk baru ditambahkan</p>
                                        <p class="text-xs text-gray-500">2 jam yang lalu</p>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div> --}}

                    {{-- <div class="chart-container">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik Sistem</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center p-4 bg-blue-50 rounded-xl">
                                <div class="text-2xl font-bold text-blue-600">99%</div>
                                <div class="text-sm text-gray-600 mt-1">Uptime</div>
                            </div>
                            <div class="text-center p-4 bg-green-50 rounded-xl">
                                <div class="text-2xl font-bold text-green-600">0.2s</div>
                                <div class="text-sm text-gray-600 mt-1">Response Time</div>
                            </div>
                            <div class="text-center p-4 bg-purple-50 rounded-xl">
                                <div class="text-2xl font-bold text-purple-600">1.2K</div>
                                <div class="text-sm text-gray-600 mt-1">Page Views</div>
                            </div>
                            <div class="text-center p-4 bg-orange-50 rounded-xl">
                                <div class="text-2xl font-bold text-orange-600">24</div>
                                <div class="text-sm text-gray-600 mt-1">Active Users</div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </main>
    </div>

    <script>
        const dataSet = {
            daily: @json($dailySales),
            weekly: @json($weeklySales),
            monthly: @json($monthlySales),
            yearly: @json($yearlySales),
        };

        const ctx = document.getElementById('salesChart').getContext('2d');

        let chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Total Penjualan',
                    data: [],
                    borderColor: '#2563EB',
                    backgroundColor: 'rgba(37, 99, 235, 0.12)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#2563EB',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 800,
                    easing: 'easeOutQuart'
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: ctx => `Rp ${ctx.raw.toLocaleString()}`
                        }
                    }
                },
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: v => `Rp ${v.toLocaleString()}`
                        },
                        grid: {
                            color: '#f3f4f6'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // ===== CHANGE DATA ONLY (NO DESTROY) =====
        function updateChart(type) {
            const data = dataSet[type];
            chart.data.labels = data.map(d => d.label);
            chart.data.datasets[0].data = data.map(d => d.total);
            chart.update();
        }

        // ===== TAB HANDLER (NO event BUG) =====
        document.querySelectorAll('.chart-tab').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.chart-tab')
                    .forEach(t => t.classList.remove('active'));

                btn.classList.add('active');
                updateChart(btn.dataset.type);
            });
        });

        // INIT
        document.addEventListener('DOMContentLoaded', () => {
            updateChart('daily');
        });
        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
            dropdown.classList.toggle('show');
        }

        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.content-overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('userDropdown');
            const userBtn = e.target.closest('button[onclick="toggleUserDropdown()"]');

            if (!dropdown.contains(e.target) && !userBtn) {
                dropdown.classList.add('hidden');
                dropdown.classList.remove('show');
            }
        });

        // Close sidebar on resize if needed
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                const sidebar = document.querySelector('.sidebar');
                const overlay = document.querySelector('.content-overlay');
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        });
    </script>

    <script>
        const dataSet = {
            daily: @json($dailySales),
            weekly: @json($weeklySales),
            monthly: @json($monthlySales),
            yearly: @json($yearlySales),
        };

        let chart;

        function changeChart(type) {
            const data = dataSet[type];
            const labels = data.map(d => d.label);
            const totals = data.map(d => d.total);

            if (chart) chart.destroy();

            // Update active tab
            document.querySelectorAll('.chart-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            event.target.classList.add('active');

            chart = new Chart(document.getElementById('salesChart'), {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                        label: 'Total Penjualan',
                        data: totals,
                        borderColor: '#2563EB',
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2,
                        pointBackgroundColor: '#2563EB',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            callbacks: {
                                label: function(context) {
                                    return `Rp ${context.raw.toLocaleString()}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false
                            },
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString();
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'nearest'
                    }
                }
            });
        }

        // Initialize with daily chart
        document.addEventListener('DOMContentLoaded', function() {
            changeChart('daily');
        });

        
    </script>
</body>

</html>
