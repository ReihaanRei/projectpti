<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi Saya | Toko Agus Jaya</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .transaction-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .transaction-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
        }
        
        .status-badge {
            padding: 0.375rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
        }
        
        .status-pending { background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: #92400e; }
        .status-paid { background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46; }
        .status-cancelled { background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); color: #991b1b; }
        
        .variant-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .total-amount {
            background: linear-gradient(135deg, #1e40af 0%, #1d4ed8 100%);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            font-weight: bold;
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .item-row:hover {
            background: #f9fafb;
        }
        
        @media (max-width: 768px) {
            .transaction-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
            
            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-700 py-4 shadow-lg sticky top-0 z-50">
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
                <a href="{{ route('dashboard') }}" class="text-white px-3 py-2 rounded-lg hover:bg-blue-700/50 transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-700/50' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('katalog') }}" class="text-white px-3 py-2 rounded-lg hover:bg-blue-700/50 transition-colors {{ request()->routeIs('katalog') ? 'bg-blue-700/50' : '' }}">
                    Katalog
                </a>
                <a href="{{ route('my.transactions') }}" class="text-white px-3 py-2 rounded-lg hover:bg-blue-700/50 transition-colors {{ request()->routeIs('my.transactions') ? 'bg-blue-700/50' : '' }}">
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
    </nav>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="mb-8 fade-in">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Riwayat Transaksi Saya</h1>
                    <p class="text-gray-600">Lihat semua riwayat pembelian Anda di Toko Agus Jaya</p>
                </div>
                <a href="{{ route('katalog') }}" class="bg-white border border-gray-300 text-gray-700 px-5 py-2.5 rounded-xl hover:bg-gray-50 transition-colors flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Kembali ke Katalog
                </a>
            </div>
        </div>

        @if ($transactions->count() > 0)
            <div class="space-y-6">
                @foreach ($transactions as $index => $trx)
                <div class="transaction-card fade-in" style="animation-delay: {{ $index * 0.1 }}s">
                    <!-- Transaction Header -->
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 transaction-header">
                            <div class="space-y-2">
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-blue-700 text-lg">#{{ $trx->id }}</span>
                                    <span class="status-badge @if($trx->status === 'pending') status-pending @elseif($trx->status === 'paid') status-paid @else status-cancelled @endif">
                                        <i class="fas @if($trx->status === 'pending') fa-clock @elseif($trx->status === 'paid') fa-check-circle @else fa-times-circle @endif"></i>
                                        {{ $trx->status === 'pending' ? 'MENUNGGU' : ($trx->status === 'paid' ? 'DIKONFIRMASI' : 'DIBATALKAN') }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 flex items-center gap-2">
                                    <i class="fas fa-calendar-alt text-gray-400"></i>
                                    {{ $trx->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                            
                            <div class="flex items-center gap-4">
                                <div class="total-amount">
                                    Rp{{ number_format($trx->total_harga, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Items List -->
                    <div class="p-6">
                        <h4 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-boxes text-blue-600"></i>
                            Detail Pesanan
                        </h4>
                        
                        <div class="table-responsive">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-4 py-3 text-left font-medium text-gray-700 rounded-l-lg">Produk</th>
                                        <th class="px-4 py-3 text-left font-medium text-gray-700">Varian</th>
                                        <th class="px-4 py-3 text-center font-medium text-gray-700">Qty</th>
                                        <th class="px-4 py-3 text-right font-medium text-gray-700">Harga</th>
                                        <th class="px-4 py-3 text-right font-medium text-gray-700 rounded-r-lg">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trx->items as $item)
                                    <tr class="item-row">
                                        <td class="px-4 py-3">
                                            <div class="font-medium text-gray-900">{{ $item->product->nama ?? '-' }}</div>
                                            <div class="text-xs text-gray-500 truncate max-w-xs">{{ $item->product->deskripsi ?? 'Deskripsi tidak tersedia' }}</div>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if ($item->variant)
                                            <div class="space-y-1">
                                                <span class="variant-badge bg-indigo-100 text-indigo-700">
                                                    {{ $item->variant->warna }}
                                                </span>
                                                <span class="variant-badge bg-purple-100 text-purple-700">
                                                    {{ $item->variant->ukuran }}
                                                </span>
                                            </div>
                                            @else
                                            <span class="text-gray-400 text-sm">-</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-center text-gray-700 font-semibold">{{ $item->qty }}</td>
                                        <td class="px-4 py-3 text-right text-gray-700">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-right text-gray-900 font-bold">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Status Info -->
                    <div class="px-6 py-4 border-t border-gray-100 bg-blue-50 rounded-b-2xl">
                        <div class="flex items-start gap-3">
                            <div class="bg-blue-100 p-2 rounded-lg">
                                <i class="fas fa-info-circle text-blue-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-blue-700 font-medium">
                                    @if ($trx->status === 'pending')
                                    Pesanan Anda telah diterima dan sedang menunggu konfirmasi pembayaran dari admin.
                                    @elseif ($trx->status === 'paid')
                                    Pembayaran telah dikonfirmasi. Pesanan Anda sedang diproses oleh toko.
                                    @else
                                    Pesanan dibatalkan. Silakan menghubungi pihak toko apabila membutuhkan bantuan lebih lanjut.
                                    @endif
                                </p>
                                <p class="text-xs text-blue-600 mt-1">
                                    <i class="far fa-clock mr-1"></i>
                                    @if ($trx->status === 'pending')
                                    Menunggu konfirmasi sejak {{ $trx->created_at->format('d M Y') }}
                                    @else
                                    Diperbarui: {{ $trx->updated_at->format('d M Y, H:i') }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 fade-in">
                <div class="mx-auto w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-receipt text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada transaksi</h3>
                <p class="text-gray-600 mb-6">Mulai belanja dan buat transaksi pertama Anda</p>
                <a href="{{ route('katalog') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-xl hover:shadow-lg transition-all duration-300">
                    <i class="fas fa-shopping-cart"></i> Mulai Belanja
                </a>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div>
                    <div class="flex items-center mb-3">
                        <i class="fas fa-helmet-safety text-2xl text-blue-400 mr-2"></i>
                        <h3 class="font-bold text-lg">Toko Agus Jaya</h3>
                    </div>
                    <p class="text-gray-400 text-sm">Penyedia helm berkualitas dengan standar keamanan tinggi.</p>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-3 flex items-center gap-2">
                        <i class="far fa-clock text-blue-400"></i> Jam Operasional
                    </h4>
                    <p class="text-gray-400 text-sm">Setiap Hari: 07:30 - 21:00</p>
                    <p class="text-gray-400 text-sm">Jum'at: Libur</p>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-3 flex items-center gap-2">
                        <i class="fas fa-phone-alt text-blue-400"></i> Kontak
                    </h4>
                    <div class="space-y-1">
                        <p class="text-gray-400 text-sm">Agus: <a href="https://wa.me/6281803185594" target="_blank" class="text-blue-400 hover:underline">0818-0318-5594</a></p>
                        <p class="text-gray-400 text-sm">Cak No: <a href="https://wa.me/628155599007341" target="_blank" class="text-blue-400 hover:underline">0815-5990-07341</a></p>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-3 flex items-center gap-2">
                        <i class="fas fa-map-marker-alt text-blue-400"></i> Alamat
                    </h4>
                    <p class="text-gray-400 text-sm">Jl. Raya Manyar No.68, Sukolilo, Surabaya</p>
                    <a href="/maps" class="text-blue-400 hover:underline text-sm">
                        <i class="fas fa-location-arrow mr-1"></i> Lihat di Maps
                    </a>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-6 text-center">
                <p class="text-gray-400 text-sm">
                    &copy; {{ date('Y') }} Toko Agus Jaya Helm. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <script>
        function toggleUserMenu() {
            document.getElementById('userMenu').classList.toggle('hidden');
        }
        
        function toggleMobileMenu() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        }
        
        // Close dropdowns when clicking outside
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