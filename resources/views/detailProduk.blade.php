<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nama Produk | UMKM Agus Jaya</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        .swiper-slide img {
            max-height: 400px;
            object-fit: contain;
            border-radius: 0.75rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 font-sans min-h-screen">

    <!-- NAVBAR SEDERHANA -->
    <nav class="bg-white shadow p-4">
        <div class="container mx-auto flex justify-between">
            <h1 class="font-bold text-lg">UMKM Agus Jaya</h1>
            <button class="md:hidden">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-10 space-y-12">

        <!-- Tombol Kembali -->
        <div class="flex items-center space-x-4 mb-4">
            <a href="/katalog" class="text-white bg-gray-500 hover:bg-gray-700 rounded-lg px-4 py-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- DETAIL PRODUK -->
        <section class="bg-white rounded-3xl shadow-xl p-6 md:p-10 md:flex gap-8">

            <!-- GALERI GAMBAR -->
            <div class="md:w-1/2">
                <div class="swiper">
                    <div class="swiper-wrapper content-center">
                        <div class="swiper-slide flex justify-center items-center">
                            <img src="images/produk1.jpg" alt="Nama Produk" class="w-full max-w-md" />
                        </div>
                        <div class="swiper-slide flex justify-center items-center">
                            <img src="images/produk2.jpg" alt="Nama Produk" class="w-full max-w-md" />
                        </div>
                        <div class="swiper-slide flex justify-center items-center">
                            <img src="images/produk3.jpg" alt="Nama Produk" class="w-full max-w-md" />
                        </div>
                    </div>

                    <div class="swiper-pagination mt-4"></div>
                    <div class="swiper-button-next text-blue-500"></div>
                    <div class="swiper-button-prev text-blue-500"></div>
                </div>
            </div>

            <!-- INFORMASI PRODUK -->
            <div class="md:w-1/2 mt-8 md:mt-0 flex flex-col justify-between">
                <div>
                    <span
                        class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full uppercase font-semibold tracking-wide mb-4">
                        Kategori Produk
                    </span>

                    <h1 class="text-4xl font-extrabold mb-3">Nama Produk Contoh</h1>

                    <div class="text-2xl font-bold text-blue-600 mb-4">
                        Rp150.000
                    </div>

                    <div class="mb-6 text-lg">
                        <span class="flex items-center text-green-600 font-medium">
                            <i class="fas fa-check-circle mr-2"></i>
                            Stok tersedia: 12 unit
                        </span>
                    </div>
                </div>

                <!-- CTA -->
                <div class="mt-8 space-y-4">
                    <h2 class="text-xl font-bold">Beli Sekarang!</h2>
                    <div class="flex flex-wrap gap-4">

                        <a href="https://wa.me/6281803185594?text=Halo%20saya%20ingin%20membeli%20Nama%20Produk"
                            target="_blank"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium inline-flex items-center transition">
                            <i class="fab fa-whatsapp mr-2"></i> BELI VIA WHATSAPP
                        </a>

                        <a href="/maps" target="_blank"
                            class="border border-green-600 text-green-600 hover:bg-green-50 px-6 py-3 rounded-lg font-medium inline-flex items-center transition">
                            <i class="fas fa-map-marker-alt mr-2"></i> DATANG KE TOKO
                        </a>
                    </div>
                </div>

                <!-- FITUR -->
                <div class="mt-8 border-t border-gray-200 pt-4 space-y-2 text-sm text-gray-600">
                    <div class="flex items-center">
                        <i class="fas fa-shield-alt mr-2 text-blue-500"></i>
                        Bergaransi Pemeliharaan Dari Penjual Langsung
                    </div>
                </div>
            </div>
        </section>

        <!-- DESKRIPSI -->
        <section class="bg-white rounded-3xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi Produk</h2>
            <p class="text-gray-700 leading-relaxed">
                Ini adalah contoh deskripsi produk. Kamu bisa menuliskan informasi lengkap terkait bahan, ukuran,
                manfaat, dan detail lainnya.
            </p>
        </section>

        <!-- PRODUK TERKAIT -->
        <section>
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Produk Terkait</h2>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                <!-- Card Produk -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden group">
                    <a href="#">
                        <div class="relative w-full h-48 bg-gray-100 flex items-center justify-center overflow-hidden">
                            <img src="images/produk1.jpg"
                                class="w-full h-full object-contain p-4 group-hover:scale-105 transition" />
                        </div>
                        <div class="p-4">
                            <h3
                                class="font-semibold text-gray-800 text-lg mb-1 truncate group-hover:text-blue-700 transition">
                                Produk Contoh 1
                            </h3>
                            <p class="text-blue-600 font-semibold text-sm">Rp120.000</p>
                            <p class="text-xs text-gray-500 mt-1">Stok: 5</p>
                            <a href="#"
                                class="mt-3 inline-block w-full text-center bg-blue-600 text-white py-2 rounded-lg text-sm hover:bg-blue-700 transition">
                                Lihat Detail
                            </a>
                        </div>
                    </a>
                </div>

                <!-- Duplikasi untuk contoh -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden group">
                    <a href="#">
                        <div class="relative w-full h-48 bg-gray-100 flex items-center justify-center overflow-hidden">
                            <img src="images/produk2.jpg"
                                class="w-full h-full object-contain p-4 group-hover:scale-105 transition" />
                        </div>
                        <div class="p-4">
                            <h3
                                class="font-semibold text-gray-800 text-lg mb-1 truncate group-hover:text-blue-700 transition">
                                Produk Contoh 2
                            </h3>
                            <p class="text-blue-600 font-semibold text-sm">Rp99.000</p>
                            <p class="text-xs text-gray-500 mt-1">Stok: 8</p>
                            <a href="#"
                                class="mt-3 inline-block w-full text-center bg-blue-600 text-white py-2 rounded-lg text-sm hover:bg-blue-700 transition">
                                Lihat Detail
                            </a>
                        </div>
                    </a>
                </div>

            </div>
        </section>

    </main>

    <!-- SWIPER JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
        });
    </script>

</body>

</html>
