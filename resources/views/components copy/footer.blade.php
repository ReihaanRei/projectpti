    <footer class="bg-gray-900 text-white pt-12 pb-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="footer-grid grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Tentang Kami -->
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-helmet-safety text-2xl text-blue-400 mr-2"></i>
                        <h3 class="font-bold text-xl">Toko Agus Jaya</h3>
                    </div>
                    <p class="text-gray-400 mb-4">Penyedia helm berkualitas dengan standar keamanan tinggi sejak 1985,
                        berkomitmen untuk keselamatan pengendara.</p>
                    {{-- <div class="flex space-x-4">
                        <a href="#" class="social-icon text-gray-400 hover:text-blue-400 text-xl">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon text-gray-400 hover:text-pink-600 text-xl">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-icon text-gray-400 hover:text-blue-400 text-xl">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon text-gray-400 hover:text-red-500 text-xl">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div> --}}
                </div>

                <!-- Jam Operasional -->
                <div>
                    <h3 class="font-bold text-lg mb-4 flex items-center gap-2">
                        <i class="far fa-clock text-blue-400"></i>
                        <span>Jam Operasional</span>
                    </h3>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex justify-between items-center">
                            <span class="flex items-center gap-2">
                                <i class="far fa-sun text-xs"></i>
                                <span>Buka Setiap Hari</span>
                            </span>
                            <span class="bg-gray-800 px-2 py-1 rounded text-xs">07:30 - 21:00</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="flex items-center gap-2">
                                <i class="far fa-sun text-xs"></i>
                                <span>Jum'at</span>
                            </span>
                            <span class="bg-gray-800 px-2 py-1 rounded text-xs">Libur</span>
                        </li>
                        <li class="pt-2 text-xs italic text-gray-500">
                            *Hari libur jam operasional mungkin berubah
                        </li>
                    </ul>
                </div>

                <!-- Layanan -->
                <div>
                    <h3 class="font-bold text-lg mb-4 flex items-center gap-2">
                        <i class="fas fa-concierge-bell text-blue-400"></i>
                        <span>Layanan Kami</span>
                    </h3>
                    <ul class="space-y-3 text-gray-400">
                        <li>
                            <a href="katalog" class="footer-link flex items-center gap-2 hover:text-blue-400">
                                <i class="fas fa-chevron-right text-xs text-blue-400"></i>
                                <span>Penjualan Helm</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link flex items-center gap-2">
                                <i class="fas fa-chevron-right text-xs text-blue-400"></i>
                                <span>Perawatan Helm</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link flex items-center gap-2">
                                <i class="fas fa-chevron-right text-xs text-blue-400"></i>
                                <span>Penggantian Sparepart</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link flex items-center gap-2">
                                <i class="fas fa-chevron-right text-xs text-blue-400"></i>
                                <span>Konsultasi Produk</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div>
                    <h3 class="font-bold text-lg mb-4 flex items-center gap-2">
                        <i class="fas fa-phone-alt text-blue-400"></i>
                        <span>Hubungi Kami</span>
                    </h3>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-start">
                            <i class="fas fa-phone-alt text-blue-400 mt-1 mr-3 text-sm"></i>
                            <div>
                                <div class="font-medium">Agus</div>
                                <div><a href="https://wa.me/6281803185594" target="_blank"
                                        class="text-blue-400 hover:underline">0818-0318-5594</a></div>
                                <div class="font-medium">Cak No</div>
                                <div><a href="https://wa.me/628155599007341" target="_blank"
                                        class="text-blue-400 hover:underline">0815-5990-07341</a></div>
                            </div>
                        </li>
                        {{-- <li class="flex items-start">
                            <i class="fas fa-envelope text-blue-400 mt-1 mr-3 text-sm"></i>
                            <div>
                                <div class="font-medium">Email</div>
                                <div>cs@umkmhelm.com</div>
                            </div>
                        </li> --}}
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-blue-400 mt-1 mr-3 text-sm"></i>
                            <div>
                                <div class="font-medium">Alamat</div>
                                <div>Jl. Raya Manyar No.68, Menur Pumpungan, Sukolilo, Surabaya, Jawa Timur 60118</div>
                                <a href="/maps" target="_blank"
                                    class="text-blue-400 hover:underline hover:text-blue-500 text-sm">
                                    <i class="fas fa-location-arrow mr-2"></i> Lihat Lokasi di Google Maps
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-6 text-center">
                <div class="mb-2 text-sm text-gray-500">
                    &copy; {{ date('Y') }} Toko Agus Jaya Helm. All rights reserved. |
                    <a href="#" class="hover:text-blue-400">Kebijakan Privasi</a> |
                    <a href="#" class="hover:text-blue-400">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>
