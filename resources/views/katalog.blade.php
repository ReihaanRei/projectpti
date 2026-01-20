<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Helm Premium | UMKM Agus Jaya</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom animations */
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

        /* Smooth fade-in for elements */
        .animate-fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .animate-fade-in.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Custom scrollbar */
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
    <x-navbar />

    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-blue-600 to-blue-800 text-white">
        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_center,_rgba(255,255,255,0.1)_0%,_transparent_70%)] animate-[spin_15s_linear_infinite] origin-[50%_50%]">
        </div>
        <div class="max-w-7xl mx-auto px-4 py-20 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center animate-fade-in" id="hero-content">
                <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">Katalog Helm Premium Berkualitas</h1>
                <p class="text-xl max-w-2xl mx-auto mb-8">Temukan helm terbaik untuk keselamatan dan kenyamanan
                    berkendara Anda</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#products"
                        class="btn-explore bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold text-lg hover:bg-gray-100 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        <i class="fas fa-helmet-safety mr-2"></i> Jelajahi Produk
                    </a>
                    <a href="https://wa.me/6281803185594"
                        class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:-translate-y-1">
                        <i class="fas fa-phone-alt mr-2"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-gray-50 to-transparent"></div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
        <!-- Search and Filter -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-12 animate-fade-in" id="search-section">
            <form method="GET" action="{{ route('catalogFilter') }}"
                class="space-y-4 md:space-y-0 md:flex md:items-end md:space-x-4">
                <div class="flex-grow">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Produk</label>
                    <div class="relative">
                        <input type="text" id="search" name="search" placeholder="Cari helm..."
                            value="{{ request('search') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition duration-300">
                        <button type="submit"
                            class="absolute right-1 top-1 text-white px-4 py-2 font-medium bg-blue-500 rounded-lg hover:bg-blue-700 transition duration-300">
                            <i class="fas fa-search mr-2"></i> Cari
                        </button>
                    </div>
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select id="category" name="category"
                        class="w-full md:w-64 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm appearance-none bg-white bg-no-repeat bg-[center_right_1rem] transition duration-300">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex space-x-2">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium flex items-center transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5">
                        <i class="fas fa-filter mr-2"></i> Filter
                    </button>
                    <a href="{{ route('katalog') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-3 rounded-lg font-medium flex items-center transition duration-300">
                        <i class="fas fa-sync-alt mr-2"></i> reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Products Section -->
        <div class="mb-8" id="products">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold flex items-center gap-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">
                        <i class="fas fa-helmet-safety"></i>
                    </div>
                    <span>Daftar Produk</span>
                </h2>

                @if ($products->count() > 0)
                    <div class="text-sm text-gray-500">
                        Menampilkan {{ $products->firstItem() }} - {{ $products->lastItem() }} dari
                        {{ $products->total() }} produk
                    </div>
                @endif
            </div>

            @if ($products->count() > 0)
                <div
                    class="grid grid-cols-2 xs:grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                    @foreach ($products as $product)
                        <a href="{{ route('productDetail', $product->id) }}"
                            class="group relative bg-white rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-md block">
                            <div class="relative w-full h-56 bg-gray-50 rounded-xl overflow-hidden">
                                @if ($product->thumbnail)
                                    <img src="{{ asset('storage/' . $product->thumbnail->image) }}"
                                        alt="{{ $product->nama }}" class="w-full h-full object-contain p-4"
                                        onerror="this.onerror=null;this.src='{{ asset('images/placeholder.png') }}';">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <i class="fas fa-helmet-safety text-5xl opacity-30"></i>
                                    </div>
                                @endif

                                @if ($product->is_new)
                                    <span
                                        class="absolute top-3 right-3 bg-amber-500 text-white font-bold px-3 py-1 rounded-full text-xs shadow">
                                        <i class="fas fa-certificate mr-1"></i> BARU
                                    </span>
                                @endif
                            </div>

                            <div class="p-5">
                                <h3 class="font-bold text-lg truncate mb-2 group-hover:text-blue-600" title="{{ $product->nama }}">
                                    {{ $product->nama }}
                                </h3>
                                <div class="flex justify-between items-center">
                                    <p class="text-blue-600 font-semibold text-xl">
                                        Rp{{ number_format($product->harga, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="mt-3">
                                    <span
                                        class="inline-block text-center w-full bg-blue-600 text-white py-2 rounded-lg text-sm hover:bg-blue-700 transition">
                                        Lihat Detail →
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>


                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    {{ $products->links('pagination::tailwind') }}
                </div>
            @else
                <div class="animate-[fadeIn_0.6s_ease-out] bg-white rounded-xl shadow-md p-8 text-center">
                    <div
                        class="mx-auto w-24 h-24 bg-red-100 rounded-full flex items-center justify-center text-red-500 mb-4">
                        <i class="fas fa-search fa-2x"></i>
                    </div>
                    <h3 class="text-xl font-medium text-gray-700 mb-2">Produk tidak ditemukan</h3>
                    <p class="text-gray-500 mb-6 max-w-md mx-auto">Maaf, kami tidak dapat menemukan produk yang sesuai
                        dengan pencarian Anda.</p>
                    <a href="{{ route('katalog') }}"
                        class="inline-block transition-all duration-300 relative overflow-hidden bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium hover:-translate-y-0.5 hover:shadow-lg">
                        <i class="fas fa-sync-alt mr-2"></i> Reset Pencarian
                    </a>
                </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <x-footer />

    <!-- Back to Top Button -->
    <button id="back-to-top"
        class="fixed bottom-8 right-8 bg-blue-600 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center opacity-0 invisible transition-all duration-300 hover:bg-blue-700 transform hover:scale-110">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- JavaScript -->
    <script>
    function toggleUserMenu() {
        document.getElementById('userMenu').classList.toggle('hidden');
    }

    // Tutup dropdown jika klik di luar
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('userMenu');
        const button = e.target.closest('button');

        if (!e.target.closest('#userMenu') && !button) {
            menu?.classList.add('hidden');
        }
    });
    </script>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            const icon = this.querySelector('i');

            menu.classList.toggle('hidden');
            if (menu.classList.contains('hidden')) {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            } else {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            }
        });

        // Back to top button
        const backToTopButton = document.getElementById('back-to-top');
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.remove('opacity-100', 'visible');
                backToTopButton.classList.add('opacity-0', 'invisible');
            }
        });

        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-md', 'bg-blue-700');
                navbar.classList.remove('bg-blue-600');
            } else {
                navbar.classList.remove('shadow-md', 'bg-blue-700');
                navbar.classList.add('bg-blue-600');
            }
        });

        // Product card hover effect
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                const quickViewBtn = this.querySelector('.quick-view-btn');
                if (quickViewBtn) {
                    quickViewBtn.classList.remove('opacity-0', 'translate-y-4');
                    quickViewBtn.classList.add('opacity-100', 'translate-y-0');
                }
            });

            card.addEventListener('mouseleave', function() {
                const quickViewBtn = this.querySelector('.quick-view-btn');
                if (quickViewBtn) {
                    quickViewBtn.classList.remove('opacity-100', 'translate-y-0');
                    quickViewBtn.classList.add('opacity-0', 'translate-y-4');
                }
            });
        });

        // Add to cart animation
        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.innerHTML = '<i class="fas fa-check mr-1"></i> Ditambahkan';
                this.classList.add('bg-green-500', 'hover:bg-green-600');
                this.classList.remove('bg-blue-600', 'hover:bg-blue-700');

                setTimeout(() => {
                    this.innerHTML = '<i class="fas fa-cart-plus mr-1"></i> Beli';
                    this.classList.remove('bg-green-500', 'hover:bg-green-600');
                    this.classList.add('bg-blue-600', 'hover:bg-blue-700');
                }, 2000);
            });
        });

        // Animate elements when they come into view
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.animate-fade-in');

            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.2;

                if (elementPosition < screenPosition) {
                    element.classList.add('show');
                }
            });
        };

        // Initialize animations
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
        animateOnScroll(); // Run once on load

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>

</html>
