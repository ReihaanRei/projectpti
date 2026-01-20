<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Toko Agus Jaya</title>
    @vite('resources/css/app.css')
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <style>
        .slick-prev:before,
        .slick-next:before {
            color: #3b82f6;
            /* Warna biru sesuai tema */
            font-size: 24px;
        }

        .slick-dots li button:before {
            font-size: 12px;
            color: #3b82f6;
        }

        .slick-dots li.slick-active button:before {
            color: #3b82f6;
        }

        .promo-slide {
            padding: 0 10px;
        }

        .promo-slide img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <x-navbar />

    <!-- Content -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        <div class="mb-16">
            <div class="promo-slider">
                <!-- Slide 1 -->
                <div class="promo-slide relative">
                    <img src="images/toko1.jpg" alt="Promo Helm 1">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6 rounded-b-lg">
                        <div class="max-w-md">
                            <h3 class="text-white text-2xl font-bold mb-2">DISKON SETIAP BERLANGGANAN!</h3>
                            <p class="text-gray-200 mb-4">Khusus pembeli berlangganan, dapatkan diskon khusus</p>
                            <a href="katalog"
                                class="bg-yellow-400 hover:bg-yellow-300 text-blue-800 font-bold py-2 px-6 rounded-lg inline-block">BELI
                                SEKARANG</a>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="promo-slide relative">
                    <img src="images/toko2.jpg" alt="Promo Helm 2">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6 rounded-b-lg">
                        <div class="max-w-md">
                            <h3 class="text-white text-2xl font-bold mb-2">GRATIS AKSESORI!</h3>
                            <p class="text-gray-200 mb-4">Dapatkan gratis aksesoris dengan pembelian helm</p>
                            <a href="katalog"
                                class="bg-yellow-400 hover:bg-yellow-300 text-blue-800 font-bold py-2 px-6 rounded-lg inline-block">LIHAT
                                PRODUK</a>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="promo-slide relative">
                    <img src="images/toko3.jpg" alt="Promo Helm 3">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6 rounded-b-lg">
                        <div class="max-w-md">
                            <h3 class="text-white text-2xl font-bold mb-2">HELM LIMITED EDITION</h3>
                            <p class="text-gray-200 mb-4">Koleksi helm edisi terbatas dengan desain eksklusif</p>
                            <a href="katalog"
                                class="bg-yellow-400 hover:bg-yellow-300 text-blue-800 font-bold py-2 px-6 rounded-lg inline-block">PESAN
                                SEKARANG</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Promo Section -->
        <!-- HIGHLIGHT SECTION -->
        <section class="max-w-7xl mx-auto py-8 px-4">
            <h2 class="text-3xl font-extrabold mb-10 flex items-center gap-2 text-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                Produk Unggulan
            </h2>

            @if ($highlightProducts->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($highlightProducts as $product)
                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl hover:scale-[1.03] transition-all duration-300">
                            <div class="relative">
                                @if ($product->thumbnail)
                                    <img src="{{ asset('storage/' . $product->thumbnail->image) }}"
                                        alt="{{ $product->nama }}" class="w-full h-full object-contain p-4"
                                        onerror="this.onerror=null;this.src='{{ asset('images/placeholder.png') }}';">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <i class="fas fa-helmet-safety text-5xl opacity-30"></i>
                                    </div>
                                @endif

                                @if ($product->stok == 0)
                                @elseif ($product->is_new)
                                    <span
                                        class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                        Baru
                                    </span>
                                @endif
                            </div>
                            <div class="p-4 space-y-2">
                                <h3 class="font-bold text-lg text-gray-800 truncate">{{ $product->nama }}</h3>

                                <span
                                    class="inline-block bg-blue-100 text-blue-700 text-xs font-medium px-2 py-1 rounded-md">
                                    {{ $product->category->nama ?? 'Uncategorized' }}
                                </span>

                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-blue-600 font-bold text-sm">
                                        Rp {{ number_format($product->harga, 0, ',', '.') }}
                                    </span>
                                    <span class="text-xs text-gray-500">Stok: {{ $product->stok }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500">Belum ada produk highlight tersedia.</p>
            @endif
        </section>

        <section class="my-2 text-center">
            <a href="{{ route('katalog') }}"
                class="inline-block bg-gradient-to-r from-red-500 to-orange-500 text-white text-lg font-semibold px-6 py-3 rounded-full shadow-lg transform transition hover:scale-105 hover:shadow-xl hover:from-red-600 hover:to-orange-600 active:scale-95">
                <i class="fas fa-shopping-cart mr-2"></i>
                Buruan Pesan Sekarang!
            </a>
        </section>

        <!-- ABOUT -->
        <section class="bg-gray-50 py-8 px-6 md:px-10 rounded-2xl mt-8">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl font-extrabold text-center text-blue-700 mb-12">Tentang Toko Agus Jaya Helm</h2>
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <img src="{{ asset('images/toko3.jpg') }}" alt="Foto Toko" class="rounded-xl shadow-lg">

                    <div class="relative text-gray-700 bg-white p-6 rounded-xl shadow-md border-l-4 border-blue-600">
                        <p><strong class="text-blue-600">Toko Agus Jaya Helm</strong> berdiri sejak 1985 dan telah
                            melayani jutaan
                            pelanggan di Indonesia. Kami percaya bahwa keselamatan berkendara dimulai dari helm
                            yang
                            berkualitas.</p>
                        <p class="mt-4">Semua produk kami telah lulus standar keamanan seperti <strong>SNI</strong>,
                            <strong>DOT</strong>, dan <strong>ECE</strong>.
                        </p>

                        <div class="mt-6 text-sm space-y-2">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 2a8 8 0 00-5.293 13.707l-1.414 1.414a1 1 0 001.414 1.414l1.414-1.414A8 8 0 1010 2z" />
                                </svg>
                                <span>Jl. Raya Manyar No.68, Menur Pumpungan, Kec. Sukolilo, Surabaya, Jawa Timur
                                    60118</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 12.118l7.997-6.234A1 1 0 0017 4H3a1 1 0 00-.997 1.884z" />
                                </svg>
                                <span> 0818-0318-5594 | 0815-5990-07341</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-16 grid md:grid-cols-3 gap-6 text-center">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h4 class="text-lg font-semibold text-blue-600 mb-2">Bergaransi</h4>
                        <p class="text-gray-600 text-sm">Semua helm kami memiliki garansi dan layanan tukar jika cacat
                            produk.
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h4 class="text-lg font-semibold text-blue-600 mb-2">Konsultasi Gratis</h4>
                        <p class="text-gray-600 text-sm">Kami menyediakan konsultasi gratis untuk membantu Anda.
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h4 class="text-lg font-semibold text-blue-600 mb-2">Harga Terbaik</h4>
                        <p class="text-gray-600 text-sm">Harga langsung dari distributor tanpa perantara — lebih hemat!
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer (tetap sama) -->
    <x-footer />


    <!-- jQuery dan Slick Carousel JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
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

        $(document).ready(function() {
            $('.promo-slider').slick({
                dots: true,
                infinite: true,
                speed: 800,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: true,
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        arrows: false
                    }
                }]
            });
        });
    </script>
</body>

</html>
