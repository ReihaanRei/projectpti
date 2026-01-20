<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $product->nama }} | Toko Agus Jaya</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <style>
        .swiper-slide img {
            transition: transform 0.5s ease;
        }

        .swiper-slide-active img {
            transform: scale(1.05);
        }

        .product-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .variant-option {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .variant-option:hover {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .variant-option.selected {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .variant-option.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .buy-btn {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            padding: 1rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .buy-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }

        .stock-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .stock-available {
            background: #d1fae5;
            color: #065f46;
        }

        .stock-empty {
            background: #fee2e2;
            color: #991b1b;
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

        @media (max-width: 768px) {
            .product-container {
                flex-direction: column;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
    <!-- Navbar -->
    {{-- <nav class="bg-gradient-to-r from-blue-600 to-blue-700 py-4 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                <div class="bg-white/20 p-2 rounded-xl">
                    <i class="fas fa-helmet-safety text-white text-xl"></i>
                </div>
                <span class="text-white text-xl font-bold">Toko Agus Jaya</span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="text-white px-3 py-2 rounded-lg hover:bg-blue-700/50 transition-colors">
                    Beranda
                </a>
                <a href="{{ route('katalog') }}" class="text-white px-3 py-2 rounded-lg hover:bg-blue-700/50 transition-colors">
                    Katalog
                </a>
                <a href="{{ route('my.transactions') }}" class="text-white px-3 py-2 rounded-lg hover:bg-blue-700/50 transition-colors">
                    Transaksi Saya
                </a>

                @auth
                <div class="relative">
                    <button onclick="toggleUserMenu()" class="flex items-center gap-2 bg-blue-800 px-3 py-2 rounded-xl text-white hover:bg-blue-900 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span>{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down text-sm"></i>
                    </button>
                    <div id="userMenu" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-xl shadow-xl overflow-hidden z-50 border border-gray-200">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full px-4 py-3 text-left text-red-600 hover:bg-red-50 flex items-center gap-2 transition-colors">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button class="md:hidden text-white" onclick="toggleMobileMenu()">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="md:hidden hidden bg-blue-700 px-4 py-3 mt-2">
            <a href="{{ route('dashboard') }}" class="block text-white py-2.5 hover:bg-blue-800/50 rounded-lg px-2">
                <i class="fas fa-home mr-3"></i> Beranda
            </a>
            <a href="{{ route('katalog') }}" class="block text-white py-2.5 hover:bg-blue-800/50 rounded-lg px-2">
                <i class="fas fa-boxes mr-3"></i> Katalog
            </a>
            <a href="{{ route('my.transactions') }}" class="block text-white py-2.5 hover:bg-blue-800/50 rounded-lg px-2">
                <i class="fas fa-receipt mr-3"></i> Transaksi Saya
            </a>
            
            @auth
            <div class="border-t border-blue-500 pt-3 mt-3">
                <div class="text-white font-medium px-2 py-2">
                    <i class="fas fa-user-circle mr-3"></i> {{ Auth::user()->name }}
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left text-red-300 hover:text-red-100 py-2.5 px-2 rounded-lg hover:bg-red-500/20">
                        <i class="fas fa-sign-out-alt mr-3"></i> Keluar
                    </button>
                </form>
            </div>
            @endauth
        </div>
    </nav> --}}
    <x-navbar></x-navbar>
    <main class="max-w-6xl mx-auto px-4 py-8 space-y-8">
        <!-- Back Button -->
        <div class="fade-in">
            <a href="{{ route('katalog') }}"
                class="inline-flex items-center gap-2 bg-white border border-gray-300 text-gray-700 px-4 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                <i class="fas fa-arrow-left"></i> Kembali ke Katalog
            </a>
        </div>

        <!-- Alerts -->
        @if (session('success'))
            <div class="fade-in">
                <div
                    class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-4 flex items-center gap-3 shadow-sm">
                    <div class="bg-green-100 p-2.5 rounded-lg">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-green-800 font-medium">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="fade-in">
                <div
                    class="bg-gradient-to-r from-red-50 to-rose-50 border border-red-200 rounded-xl p-4 flex items-center gap-3 shadow-sm">
                    <div class="bg-red-100 p-2.5 rounded-lg">
                        <i class="fas fa-exclamation-circle text-red-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-red-800 font-medium">{{ session('error') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        <!-- Product Detail -->
        <div class="product-container flex flex-col lg:flex-row gap-8 fade-in">
            <!-- Image Gallery -->
            <div class="lg:w-1/2">
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <div class="swiper w-full">
                        <div class="swiper-wrapper">
                            @forelse($product->images as $image)
                                <div class="swiper-slide">
                                    <div
                                        class="aspect-square bg-gray-50 rounded-xl overflow-hidden flex items-center justify-center">
                                        <img src="{{ asset('storage/' . $image->image) }}"
                                            class="w-full h-full object-contain p-4" alt="{{ $product->nama }}">
                                    </div>
                                </div>
                            @empty
                                <div class="swiper-slide">
                                    <div
                                        class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex flex-col items-center justify-center text-gray-400">
                                        <i class="fas fa-image text-6xl mb-2"></i>
                                        <p>Gambar tidak tersedia</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <div class="swiper-pagination mt-4"></div>
                        <div
                            class="swiper-button-next bg-white/80 backdrop-blur-sm text-blue-600 w-10 h-10 rounded-full">
                        </div>
                        <div
                            class="swiper-button-prev bg-white/80 backdrop-blur-sm text-blue-600 w-10 h-10 rounded-full">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="lg:w-1/2 space-y-6">
                <div>
                    <span
                        class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium mb-3">
                        {{ $product->category->nama ?? '-' }}
                    </span>

                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">
                        {{ $product->nama }}
                    </h1>

                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-2xl md:text-3xl font-bold text-blue-600">
                            Rp{{ number_format($product->harga, 0, ',', '.') }}
                        </span>
                        @php
                            $totalStock = $product->variants->where('stok', '>', 0)->sum('stok');
                        @endphp
                        <span class="stock-badge {{ $totalStock > 0 ? 'stock-available' : 'stock-empty' }}">
                            <i class="fas fa-{{ $totalStock > 0 ? 'check' : 'times' }}-circle mr-1"></i>
                            {{ $totalStock > 0 ? 'Stok Tersedia' : 'Stok Habis' }}
                        </span>
                    </div>

                    <p class="text-gray-600 flex items-center gap-2">
                        <i class="fas fa-box text-gray-400"></i>
                        Total stok: <span class="font-semibold">{{ $totalStock }} pcs</span>
                    </p>
                </div>

                <!-- Purchase Form -->
                @if ($product->variants->where('stok', '>', 0)->count() > 0)
                    <form action="{{ route('checkout') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <!-- Variants -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Varian</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2" id="variantContainer">
                                @foreach ($product->variants as $variant)
                                    <div class="variant-option {{ $variant->stok <= 0 ? 'disabled' : '' }} {{ $loop->first && $variant->stok > 0 ? 'selected' : '' }}"
                                        data-variant-id="{{ $variant->id }}"
                                        onclick="selectVariant(this, {{ $variant->stok }})">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <div class="font-medium">{{ $variant->warna }} -
                                                    {{ $variant->ukuran }}</div>
                                                <div class="text-xs text-gray-500">Stok: {{ $variant->stok }}</div>
                                            </div>
                                            @if ($variant->stok <= 0)
                                                <i class="fas fa-ban text-red-500"></i>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" name="variant_id" id="selectedVariant" required>
                        </div>

                        <!-- Quantity -->
                        @auth
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah</label>
                                <div class="flex items-center gap-4">
                                    <button type="button" onclick="updateQuantity(-1)"
                                        class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" name="qty" id="quantityInput" value="1" min="1"
                                        class="w-20 text-center border border-gray-300 rounded-lg py-2 focus:ring-2 focus:ring-blue-500">
                                    <button type="button" onclick="updateQuantity(1)"
                                        class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        @endauth

                        <!-- Action Buttons -->
                        <div class="space-y-3">
                            @auth
                                <button type="submit" class="buy-btn w-full flex items-center justify-center gap-2">
                                    <i class="fas fa-shopping-cart"></i>
                                    Beli Sekarang
                                </button>
                            @endauth

                            @guest
                                <a href="{{ route('login') }}" class="buy-btn block text-center">
                                    Login untuk Membeli
                                </a>
                            @endguest

                            <div class="flex gap-3">
                                <a href="https://wa.me/6281803185594" target="_blank"
                                    class="flex-1 bg-gradient-to-r from-green-500 to-green-600 text-white py-3 rounded-lg font-semibold text-center hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                                <a href="/maps"
                                    class="flex-1 border-2 border-green-600 text-green-600 py-3 rounded-lg font-semibold text-center hover:bg-green-50 transition-all duration-300 flex items-center justify-center gap-2">
                                    <i class="fas fa-map-marker-alt"></i> Ke Toko
                                </a>
                            </div>
                        </div>
                    </form>
                @else
                    <div
                        class="bg-gradient-to-r from-red-50 to-rose-50 border border-red-200 rounded-xl p-4 text-center">
                        <div class="flex items-center justify-center gap-2 text-red-700 mb-2">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span class="font-semibold">Stok Habis</span>
                        </div>
                        <p class="text-red-600 text-sm">Semua varian produk sedang tidak tersedia.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Description -->
        <div class="bg-white rounded-2xl p-6 shadow-lg fade-in">
            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fas fa-align-left text-blue-600"></i>
                Deskripsi Produk
            </h2>
            <div class="text-gray-700 leading-relaxed">
                {{ $product->deskripsi ?? 'Deskripsi belum tersedia.' }}
            </div>
        </div>

        <!-- Related Products -->
        @if ($relatedProducts->count() > 0)
            <div class="fade-in">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($relatedProducts as $item)
                        <a href="{{ route('productDetail', $item->id) }}" class="product-card p-4">
                            <div
                                class="aspect-square bg-gray-50 rounded-xl mb-3 overflow-hidden flex items-center justify-center">
                                @if ($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail->image) }}"
                                        class="w-full h-full object-contain p-2 hover:scale-105 transition-transform duration-300"
                                        alt="{{ $item->nama }}">
                                @else
                                    <i class="fas fa-image text-4xl text-gray-300"></i>
                                @endif
                            </div>
                            <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ $item->nama }}</h3>
                            <p class="text-blue-600 font-bold mb-2">Rp{{ number_format($item->harga, 0, ',', '.') }}</p>
                            @php
                                $itemStock = $item->variants->where('stok', '>', 0)->sum('stok');
                            @endphp
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-500">
                                    <i class="fas fa-box mr-1"></i> Stok: {{ $itemStock }}
                                </span>
                                <span class="text-blue-600 text-sm font-medium">Lihat Detail →</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </main>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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
        // Swiper
        const swiper = new Swiper('.swiper', {
            loop: true,
            spaceBetween: 10,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        // Variant Selection
        function selectVariant(element, stock) {
            if (stock <= 0) return;

            document.querySelectorAll('.variant-option').forEach(opt => {
                opt.classList.remove('selected');
            });

            element.classList.add('selected');
            document.getElementById('selectedVariant').value = element.dataset.variantId;
        }

        // Initialize first available variant
        document.addEventListener('DOMContentLoaded', function() {
            const firstAvailable = document.querySelector('.variant-option:not(.disabled)');
            if (firstAvailable) {
                selectVariant(firstAvailable, parseInt(firstAvailable.querySelector('.text-xs').textContent.match(
                    /\d+/)[0]));
            }
        });

        // Quantity Control
        function updateQuantity(change) {
            const input = document.getElementById('quantityInput');
            let value = parseInt(input.value) || 1;
            value += change;
            if (value < 1) value = 1;
            input.value = value;
        }

        // Navbar Functions
        function toggleUserMenu() {
            document.getElementById('userMenu').classList.toggle('hidden');
        }

        function toggleMobileMenu() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        }

        document.addEventListener('click', function(e) {
            const userMenu = document.getElementById('userMenu');
            const userBtn = e.target.closest('button[onclick="toggleUserMenu()"]');

            if (!userMenu.contains(e.target) && !userBtn) {
                userMenu.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
