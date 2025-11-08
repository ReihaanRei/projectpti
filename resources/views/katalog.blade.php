<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Helm Premium | UMKM Agus Jaya</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .animate-fade-in.show {
            opacity: 1;
            transform: translateY(0);
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #2563eb;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans antialiased text-gray-800">

    <!-- Navbar -->
    <x-navbar></x-navbar>

    <!-- Hero Section -->
    <div id="hero" class="relative overflow-hidden bg-gradient-to-br from-blue-600 to-blue-800 text-white">
        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_center,_rgba(255,255,255,0.1)_0%,_transparent_70%)] animate-[spin_15s_linear_infinite] origin-[50%_50%]">
        </div>
        <div class="max-w-7xl mx-auto px-4 py-20 sm:px-6 lg:px-8 relative z-10 text-center animate-fade-in"
            id="hero-content">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">Katalog Helm Premium Berkualitas</h1>
            <p class="text-xl max-w-2xl mx-auto mb-8">Temukan helm terbaik untuk keselamatan dan kenyamanan berkendara
                Anda</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#products"
                    class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold text-lg hover:bg-gray-100 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <i class="fas fa-helmet-safety mr-2"></i> Jelajahi Produk
                </a>
                <a href="https://wa.me/6281803185594" target="_blank"
                    class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:-translate-y-1">
                    <i class="fas fa-phone-alt mr-2"></i> Hubungi Kami
                </a>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-gray-50 to-transparent"></div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">

        <!-- Search and Filter -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-12 animate-fade-in">
            <form class="space-y-4 md:space-y-0 md:flex md:items-end md:space-x-4">
                <div class="flex-grow">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Produk</label>
                    <div class="relative">
                        <input type="text" id="search" placeholder="Cari helm..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition duration-300">
                        <button type="button"
                            class="absolute right-1 top-1 text-white px-4 py-2 font-medium bg-blue-500 rounded-lg hover:bg-blue-700 transition duration-300">
                            <i class="fas fa-search mr-2"></i> Cari
                        </button>
                    </div>
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select id="category"
                        class="w-full md:w-64 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm bg-white transition duration-300">
                        <option>Semua Kategori</option>
                        <option>Full Face</option>
                        <option>Half Face</option>
                        <option>Modular</option>
                    </select>
                </div>

                <div class="flex space-x-2">
                    <button type="button"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium flex items-center transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5">
                        <i class="fas fa-filter mr-2"></i> Filter
                    </button>
                    <button type="button"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-3 rounded-lg font-medium flex items-center transition duration-300">
                        <i class="fas fa-sync-alt mr-2"></i> Reset
                    </button>
                </div>
            </form>
        </div>

        <!-- Products Section -->
        <div id="products" class="mb-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold flex items-center gap-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">
                        <i class="fas fa-helmet-safety"></i>
                    </div>
                    <span>Daftar Produk</span>
                </h2>
                <div class="text-sm text-gray-500">Menampilkan 1–8 dari 20 produk</div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Produk contoh -->
                <div
                    class="group bg-white rounded-xl shadow-sm overflow-hidden hover:-translate-y-2 hover:shadow-md transition-all duration-300">
                    <div class="relative w-full h-56 bg-gray-50 overflow-hidden">
                        <img src="https://cdn.pixabay.com/photo/2016/09/22/12/51/motorcycle-1687612_1280.jpg"
                            alt="Helm Full Face" class="w-full h-full object-cover p-4">
                        <span
                            class="absolute top-3 right-3 bg-amber-500 text-white font-bold px-3 py-1 rounded-full text-xs shadow"><i
                                class="fas fa-certificate mr-1"></i> BARU</span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-lg truncate mb-2 group-hover:text-blue-600">Helm Full Face Racing</h3>
                        <p class="text-blue-600 font-semibold text-xl">Rp750.000</p>
                        <div class="mt-3">
                            <span
                                class="inline-block text-center w-full bg-blue-600 text-white py-2 rounded-lg text-sm hover:bg-blue-700 transition">Lihat
                                Detail →</span>
                        </div>
                    </div>
                </div>

                <!-- Duplikasi contoh -->
                <div
                    class="group bg-white rounded-xl shadow-sm overflow-hidden hover:-translate-y-2 hover:shadow-md transition-all duration-300">
                    <div class="relative w-full h-56 bg-gray-50 overflow-hidden">
                        <img src="https://cdn.pixabay.com/photo/2016/02/19/11/53/helmet-1209858_1280.jpg"
                            alt="Helm Half Face" class="w-full h-full object-cover p-4">
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-lg truncate mb-2 group-hover:text-blue-600">Helm Half Face Urban</h3>
                        <p class="text-blue-600 font-semibold text-xl">Rp450.000</p>
                        <div class="mt-3">
                            <span
                                class="inline-block text-center w-full bg-blue-600 text-white py-2 rounded-lg text-sm hover:bg-blue-700 transition">Lihat
                                Detail →</span>
                        </div>
                    </div>
                </div>

                <!-- Tambahkan produk lainnya sesuai kebutuhan -->
            </div>
        </div>
    </main>

    <!-- Footer -->
    <x-footer></x-footer>

    <!-- Back to Top -->
    <button id="back-to-top"
        class="fixed bottom-8 right-8 bg-blue-600 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center opacity-0 invisible transition-all duration-300 hover:bg-blue-700 transform hover:scale-110">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- JavaScript -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            const icon = this.querySelector('i');
            menu.classList.toggle('hidden');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        });

        // Back to top
        const backToTopButton = document.getElementById('back-to-top');
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.add('opacity-0', 'invisible');
                backToTopButton.classList.remove('opacity-100', 'visible');
            }
        });
        backToTopButton.addEventListener('click', () => window.scrollTo({
            top: 0,
            behavior: 'smooth'
        }));

        // Fade-in animation on scroll
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.animate-fade-in');
            elements.forEach(el => {
                const pos = el.getBoundingClientRect().top;
                const screen = window.innerHeight / 1.2;
                if (pos < screen) el.classList.add('show');
            });
        };
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
    </script>

</body>

</html>
