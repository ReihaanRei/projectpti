<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite('resources/css/app.css')
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }

        .sidebar-collapsed {
            width: 80px;
            overflow: hidden;
        }

        .sidebar-collapsed .nav-text,
        .sidebar-collapsed .logo-text {
            display: none;
        }

        .sidebar-collapsed .menu-toggle i {
            transform: rotate(180deg);
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                z-index: 100;
                height: 100vh;
                transform: translateX(-100%);
            }

            .sidebar-open {
                transform: translateX(0);
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 90;
            }

            .overlay-open {
                display: block;
            }
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <button id="mobile-menu-button" class="md:hidden text-white mr-4">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <h1 class="text-white text-xl font-bold flex items-center">
                    <i class="fas fa-shield-alt mr-2"></i>
                    <span class="logo-text">Admin Panel</span>
                </h1>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button onclick="toggleDropdown()" class="text-white flex items-center focus:outline-none">
                        <i class="fas fa-user-circle text-xl"></i>
                        <span class="ml-2 hidden md:inline">Admin Demo</span>
                    </button>
                    <div id="userDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden">
                        <button type="button"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left"
                            onclick="alert('Prototype Only: Logout belum dihubungkan ke backend.')">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main layout: Sidebar + Content -->
    <div class="flex min-h-screen">
        <!-- Overlay for mobile -->
        <div id="overlay" class="overlay"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar bg-white shadow-md p-6">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-xl font-bold text-blue-600 logo-text">
                    <i class="fas fa-cog mr-2"></i>Admin Menu
                </h2>
                <button id="menu-toggle" class="menu-toggle text-gray-500 hidden md:block">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>

            <nav class="flex flex-col gap-2">
                <a href="#dashboard"
                    class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                    <i class="fas fa-tachometer-alt w-6 text-center"></i>
                    <span class="nav-text ml-3">Dashboard</span>
                </a>
                <a href="#list-produk"
                    class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                    <i class="fas fa-box-open w-6 text-center"></i>
                    <span class="nav-text ml-3">List Produk</span>
                </a>
                <a href="#kategori"
                    class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                    <i class="fas fa-tags w-6 text-center"></i>
                    <span class="nav-text ml-3">Kategori</span>
                </a>
            </nav>

            <div class="mt-auto pt-6 border-t border-gray-200"></div>
        </aside>

        <!-- Content -->
        <main class="flex-1 p-6">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-2xl font-semibold mb-6 flex items-center">
                    <i class="fas fa-tachometer-alt text-blue-500 mr-3"></i>
                    Dashboard Admin
                </h2>

                <!-- Stats Cards + Quick Actions -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Stats Section (2 columns) -->
                    <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kartu Statistik -->
                        <div class="card bg-white rounded-lg shadow p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-gray-500">Total Produk</p>
                                    <h3 class="text-3xl font-bold mt-2">128</h3>
                                </div>
                                <div class="bg-blue-100 p-3 rounded-full text-blue-600">
                                    <i class="fas fa-box-open text-xl"></i>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-sm text-green-500">
                                <i class="fas fa-arrow-up mr-1"></i>
                                <span>12 produk baru bulan ini</span>
                            </div>
                        </div>

                        <div class="card bg-white rounded-lg shadow p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-gray-500">Total Kategori</p>
                                    <h3 class="text-3xl font-bold mt-2">8</h3>
                                </div>
                                <div class="bg-green-100 p-3 rounded-full text-green-600">
                                    <i class="fas fa-tags text-xl"></i>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-sm text-green-500">
                                <i class="fas fa-arrow-up mr-1"></i>
                                <span>2 kategori baru bulan ini</span>
                            </div>
                        </div>
                    </div>

                    <!-- Aksi Cepat (1 column) -->
                    <div class="bg-white rounded-lg shadow p-6 h-fit">
                        <h3 class="text-xl font-semibold mb-4 flex items-center">
                            <i class="fas fa-bolt text-yellow-500 mr-3"></i>
                            Aksi Cepat
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <a href="#tambah-produk"
                                class="flex flex-col items-center justify-center p-4 border border-gray-200 rounded-lg hover:bg-blue-50 transition">
                                <i class="fas fa-plus-circle text-blue-500 text-2xl mb-2"></i>
                                <span class="text-sm text-center">Tambah Produk</span>
                            </a>
                            <a href="#tambah-kategori"
                                class="flex flex-col items-center justify-center p-4 border border-gray-200 rounded-lg hover:bg-blue-50 transition">
                                <i class="fas fa-tag text-green-500 text-2xl mb-2"></i>
                                <span class="text-sm text-center">Tambah Kategori</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Sidebar toggle
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const overlay = document.getElementById('overlay');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-collapsed');
        });

        mobileMenuButton.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-open');
            overlay.classList.toggle('overlay-open');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('sidebar-open');
            overlay.classList.remove('overlay-open');
        });

        // Dropdown toggle
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Close dropdown if clicked outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const button = event.target.closest('button');
            if (!event.target.closest('#userDropdown') && (!button || !button.onclick)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

</body>

</html>
