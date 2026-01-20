<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Katalog Produk - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/product.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }
        
        .product-image:hover {
            transform: scale(1.1);
        }
        
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            gap: 0.25rem;
        }
        
        .badge-in-stock {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            border: 1px solid #6ee7b7;
        }
        
        .badge-out-of-stock {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            border: 1px solid #fca5a5;
        }
        
        .badge-no-variant {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
            border: 1px solid #fcd34d;
        }
        
        .action-btn {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }
        
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .search-box {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .search-box:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .category-badge {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #1e40af;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
            border: 1px solid #93c5fd;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }
        
        .table-row-hover:hover {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.03) 0%, rgba(59, 130, 246, 0.01) 100%);
        }
        
        .stock-bar {
            height: 4px;
            border-radius: 2px;
            background: #e5e7eb;
            overflow: hidden;
            margin-top: 0.25rem;
        }
        
        .stock-fill {
            height: 100%;
            border-radius: 2px;
            transition: width 0.5s ease;
        }
        
        .price-tag {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            color: #0369a1;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-weight: 600;
            border: 1px solid #7dd3fc;
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(37, 99, 235, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0); }
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .ripple {
            position: relative;
            overflow: hidden;
        }
        
        .ripple::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }
        
        .ripple:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }
        
        @keyframes ripple {
            0% { transform: scale(0, 0); opacity: 0.5; }
            100% { transform: scale(20, 20); opacity: 0; }
        }
        
        @media (max-width: 768px) {
            .responsive-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            
            .search-container {
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .search-box {
                width: 100%;
            }
            
            .action-buttons {
                width: 100%;
                justify-content: stretch;
            }
            
            .action-buttons a {
                flex: 1;
                justify-content: center;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 py-5 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-white/20 p-3 rounded-xl">
                    <i class="fas fa-boxes text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-white text-xl font-bold">Katalog Produk</h3>
                    <p class="text-blue-100 text-sm">Kelola semua produk dengan mudah</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-6">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6 fade-in">
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Produk</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $products->total() }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-box text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            @php
                $inStock = $products->filter(function($product) {
                    return $product->variants->sum('stok') > 0;
                })->count();
                $outOfStock = $products->total() - $inStock;
            @endphp
            
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Produk Tersedia</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $inStock }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-2 text-xs text-gray-500">
                    {{ number_format(($inStock / max($products->total(), 1)) * 100, 0) }}% dari total
                </div>
            </div>
            
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Habis Stok</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $outOfStock }}</p>
                    </div>
                    <div class="bg-red-100 p-3 rounded-full">
                        <i class="fas fa-times-circle text-red-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Varian</p>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ $products->sum(function($product) { return $product->variants->count(); }) }}
                        </p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-layer-group text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Action Buttons -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6 fade-in" style="animation-delay: 0.1s">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <form method="GET" action="{{ route('admin.searchProduct') }}"
                    class="w-full md:w-auto search-container flex flex-col md:flex-row gap-3 items-start md:items-center">
                    <div class="relative w-full md:w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" placeholder="Cari produk..."
                            class="pl-10 pr-4 py-2.5 w-full rounded-xl border border-gray-300 focus:outline-none 
                                   focus:ring-2 focus:ring-blue-500 search-box bg-gray-50"
                            value="{{ request()->input('search') }}" />
                    </div>

                    <select name="category"
                        class="w-full md:w-auto px-4 py-2.5 rounded-xl border border-gray-300 focus:outline-none 
                               focus:ring-2 focus:ring-blue-500 search-box bg-gray-50">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nama }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                        class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-5 py-2.5 
                               rounded-xl hover:shadow-lg transition-all duration-300 flex items-center 
                               gap-2 ripple">
                        <i class="fas fa-filter"></i>
                        <span>Terapkan Filter</span>
                    </button>
                </form>

                <div class="flex gap-3 w-full md:w-auto action-buttons">
                    <a href="{{ route('adminDashboard') }}"
                        class="bg-gray-100 text-gray-700 px-4 py-2.5 rounded-xl hover:bg-gray-200 
                               transition-all duration-300 flex items-center gap-2 hover:shadow">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                    <a href="{{ route('admin.createProduct') }}"
                        class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-5 py-2.5 
                               rounded-xl hover:shadow-lg transition-all duration-300 flex items-center 
                               gap-2 ripple pulse">
                        <i class="fas fa-plus-circle"></i>
                        <span>Tambah Produk</span>
                    </a>
                </div>
            </div>
            
            @if(request()->has('search') || request()->has('category'))
            <div class="mt-4 flex items-center gap-2 flex-wrap">
                <span class="text-sm text-gray-600">Filter aktif:</span>
                @if(request()->has('search'))
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                    <i class="fas fa-search mr-1"></i> "{{ request('search') }}"
                    <button onclick="removeFilter('search')" class="ml-2 text-blue-600 hover:text-blue-800">
                        <i class="fas fa-times"></i>
                    </button>
                </span>
                @endif
                @if(request()->has('category'))
                @php
                    $selectedCategory = $categories->firstWhere('id', request('category'));
                @endphp
                @if($selectedCategory)
                <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm">
                    <i class="fas fa-tag mr-1"></i> {{ $selectedCategory->nama }}
                    <button onclick="removeFilter('category')" class="ml-2 text-purple-600 hover:text-purple-800">
                        <i class="fas fa-times"></i>
                    </button>
                </span>
                @endif
                @endif
                @if(request()->has('search') || request()->has('category'))
                <a href="{{ route('admin.searchProduct') }}" 
                   class="text-red-600 hover:text-red-800 text-sm flex items-center gap-1 ml-2">
                    <i class="fas fa-times"></i> Hapus semua filter
                </a>
                @endif
            </div>
            @endif
        </div>

        <!-- Success Message -->
        @if (Session::has('success'))
            <div class="mb-6 fade-in">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-4 
                           flex items-center gap-3 shadow-sm">
                    <div class="bg-green-100 p-2.5 rounded-lg">
                        <i class="fas fa-check-circle text-green-600 text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-green-800 font-medium">{{ Session::get('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" 
                            class="text-green-600 hover:text-green-800 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        <!-- Product Table -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden fade-in" style="animation-delay: 0.2s">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <div class="flex justify-between items-center">
                    <h3 class="text-white text-lg font-semibold flex items-center gap-2">
                        <i class="fas fa-list"></i>
                        <span>Daftar Produk</span>
                    </h3>
                    <div class="flex items-center gap-3">
                        <div class="text-white text-sm bg-blue-800/30 px-3 py-1 rounded-lg">
                            <i class="fas fa-sort-amount-down mr-1"></i>
                            Terbaru
                        </div>
                        <p class="text-white text-sm font-medium">
                            Total: {{ $products->total() }} produk
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="responsive-table">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-hashtag"></i>
                                        ID
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-image"></i>
                                        Gambar
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-box"></i>
                                        Produk
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-tag"></i>
                                        Harga & Stok
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-tags"></i>
                                        Kategori
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-calendar"></i>
                                        Dibuat
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($products as $index => $product)
                                <tr class="table-row-hover fade-in" 
                                    style="animation-delay: {{ 0.3 + ($index * 0.05) }}s">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 
                                                    text-blue-700 font-bold rounded-lg">
                                            {{ $product->id }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($product->thumbnail)
                                            <img src="{{ asset('storage/' . $product->thumbnail->image) }}"
                                                alt="{{ $product->nama }}" 
                                                class="product-image cursor-pointer"
                                                onclick="openImageModal('{{ asset('storage/' . $product->thumbnail->image) }}', '{{ $product->nama }}')"
                                                onerror="this.onerror=null;this.src='{{ asset('images/placeholder.png') }}';">
                                        @else
                                            <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 
                                                        rounded-lg flex items-center justify-center">
                                                <i class="fas fa-helmet-safety text-gray-400 text-xl"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="max-w-xs">
                                            <div class="text-sm font-semibold text-gray-900 mb-1">
                                                {{ $product->nama }}
                                            </div>
                                            <div class="text-xs text-gray-500 truncate">
                                                {{ Str::limit($product->deskripsi ?? 'Tidak ada deskripsi', 50) }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="space-y-2">
                                            <div class="price-tag inline-block">
                                                Rp{{ number_format($product->harga, 0, ',', '.') }}
                                            </div>
                                            @php
                                                $totalStok = $product->variants->sum('stok');
                                                $variantCount = $product->variants->count();
                                                $maxStock = $product->variants->max('stok') ?? 0;
                                                $stockPercentage = $maxStock > 0 ? min(($totalStok / ($maxStock * $variantCount)) * 100, 100) : 0;
                                            @endphp
                                            
                                            <div class="flex items-center gap-2">
                                                @if ($variantCount > 0)
                                                    @if ($totalStok > 0)
                                                        <span class="badge badge-in-stock">
                                                            <i class="fas fa-layer-group"></i>
                                                            {{ $totalStok }} pcs
                                                        </span>
                                                        <div class="text-xs text-gray-500">
                                                            {{ $variantCount }} varian
                                                        </div>
                                                    @else
                                                        <span class="badge badge-out-of-stock">
                                                            <i class="fas fa-times-circle"></i>
                                                            Habis
                                                        </span>
                                                    @endif
                                                @else
                                                    <span class="badge badge-no-variant">
                                                        <i class="fas fa-exclamation-circle"></i>
                                                        Belum ada varian
                                                    </span>
                                                @endif
                                            </div>
                                            @if($variantCount > 0 && $totalStok > 0)
                                            {{-- <div class="stock-bar w-24">
                                                <div class="stock-fill bg-green-500" 
                                                     style="width: {{ $stockPercentage }}%"
                                                     data-percentage="{{ $stockPercentage }}">
                                                </div>
                                            </div> --}}
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="category-badge">
                                            <i class="fas fa-tag mr-1"></i>
                                            {{ $product->category->nama ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm">
                                            <div class="text-gray-900 font-medium">
                                                {{ \Carbon\Carbon::parse($product->created_at)->format('d M Y') }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ \Carbon\Carbon::parse($product->created_at)->format('H:i') }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex gap-2 flex-wrap">
                                            <a href="{{ route('admin.editProduct', $product->id) }}"
                                                class="action-btn bg-gradient-to-r from-yellow-400 to-yellow-500 text-white 
                                                       hover:from-yellow-500 hover:to-yellow-600 ripple">
                                                <i class="fas fa-edit"></i>
                                                <span>Edit</span>
                                            </a>

                                            <button onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->nama) }}')"
                                                class="action-btn bg-gradient-to-r from-red-500 to-red-600 text-white 
                                                       hover:from-red-600 hover:to-red-700 ripple">
                                                <i class="fas fa-trash-alt"></i>
                                                <span>Hapus</span>
                                            </button>

                                            <form id="delete-product-form-{{ $product->id }}"
                                                action="{{ route('admin.destroyProduct', $product->id) }}"
                                                method="post" class="hidden">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="fade-in">
                                    <td colspan="7" class="px-6 py-12">
                                        <div class="text-center">
                                            <div class="mx-auto w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 
                                                        rounded-full flex items-center justify-center mb-4">
                                                <i class="fas fa-box-open text-gray-400 text-3xl"></i>
                                            </div>
                                            <h4 class="text-xl font-bold text-gray-900 mb-2">
                                                @if(request()->has('search') || request()->has('category'))
                                                    Produk tidak ditemukan
                                                @else
                                                    Belum ada produk
                                                @endif
                                            </h4>
                                            <p class="text-gray-600 mb-6 max-w-md mx-auto">
                                                @if(request()->has('search') || request()->has('category'))
                                                    Coba ubah filter pencarian atau hapus filter untuk melihat semua produk
                                                @else
                                                    Mulai dengan menambahkan produk pertama Anda
                                                @endif
                                            </p>
                                            <a href="{{ route('admin.createProduct') }}"
                                                class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 
                                                       text-white px-6 py-3 rounded-xl hover:shadow-lg transition-all duration-300">
                                                <i class="fas fa-plus-circle"></i>
                                                Tambah Produk Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($products->hasPages())
                    <div class="mt-6 border-t border-gray-200 pt-6">
                        {{ $products->withQueryString()->links('vendor.pagination.tailwind') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl transform transition-all duration-300 scale-95" 
             id="modal-content">
            <div class="text-center mb-6">
                <div class="mx-auto w-16 h-16 bg-gradient-to-br from-red-100 to-red-200 rounded-full 
                           flex items-center justify-center mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2" id="delete-title">Hapus Produk?</h3>
                <p class="text-gray-600" id="delete-message">
                    Anda akan menghapus produk ini secara permanen.
                </p>
            </div>
            
            <div class="flex gap-3">
                <button onclick="closeModal()"
                        class="flex-1 px-4 py-3 text-gray-700 hover:text-gray-900 font-medium rounded-xl
                               border border-gray-300 hover:border-gray-400 transition-colors duration-300">
                    Batalkan
                </button>
                <button id="confirm-delete-btn"
                        class="flex-1 px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white 
                               font-medium rounded-xl hover:from-red-600 hover:to-red-700 
                               transition-all duration-300 flex items-center justify-center gap-2 ripple">
                    <i class="fas fa-trash-alt"></i>
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
    
    <!-- Image Preview Modal -->
    <div id="image-modal" class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
        <div class="relative max-w-4xl w-full">
            <button onclick="closeImageModal()" 
                    class="absolute -top-12 right-0 text-white hover:text-gray-300 text-2xl">
                <i class="fas fa-times"></i>
            </button>
            <div class="bg-white rounded-2xl overflow-hidden">
                <img id="modal-image" src="" alt="" class="w-full h-auto max-h-[70vh] object-contain">
                <div class="p-4 bg-white">
                    <h3 id="modal-title" class="text-lg font-semibold text-gray-900 text-center"></h3>
                </div>
            </div>
        </div>
    </div>

    <script>
        let productIdToDelete = null;
        let productNameToDelete = '';
        
        function removeFilter(filterName) {
            const url = new URL(window.location.href);
            url.searchParams.delete(filterName);
            window.location.href = url.toString();
        }
        
        function confirmDelete(id, name = '') {
            productIdToDelete = id;
            productNameToDelete = name;
            
            const title = document.getElementById('delete-title');
            const message = document.getElementById('delete-message');
            
            if (name) {
                title.innerHTML = `Hapus <span class="text-red-600">"${name}"</span>?`;
                message.textContent = 'Produk akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.';
            } else {
                title.textContent = 'Hapus Produk?';
                message.textContent = 'Anda akan menghapus produk ini secara permanen.';
            }
            
            const modal = document.getElementById('delete-modal');
            const modalContent = document.getElementById('modal-content');
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            setTimeout(() => {
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);
        }
        
        function closeModal() {
            const modal = document.getElementById('delete-modal');
            const modalContent = document.getElementById('modal-content');
            
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                productIdToDelete = null;
                productNameToDelete = '';
            }, 300);
        }
        
        function openImageModal(src, title) {
            document.getElementById('modal-image').src = src;
            document.getElementById('modal-title').textContent = title;
            document.getElementById('image-modal').classList.remove('hidden');
            document.getElementById('image-modal').classList.add('flex');
        }
        
        function closeImageModal() {
            document.getElementById('image-modal').classList.add('hidden');
            document.getElementById('image-modal').classList.remove('flex');
        }
        
        document.getElementById('confirm-delete-btn').addEventListener('click', function() {
            if (productIdToDelete) {
                document.getElementById('delete-product-form-' + productIdToDelete).submit();
            }
        });
        
        // Close modal on outside click
        document.getElementById('delete-modal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
        
        document.getElementById('image-modal').addEventListener('click', function(e) {
            if (e.target === this) closeImageModal();
        });
        
        // Close modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
                closeImageModal();
            }
        });
        
        // Animate stock bars on page load
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.stock-fill').forEach(bar => {
                const percentage = bar.getAttribute('data-percentage');
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = percentage + '%';
                }, 100);
            });
        });
        
        // Add hover effect to table rows
        document.querySelectorAll('.table-row-hover').forEach(row => {
            row.addEventListener('mouseenter', function() {
                const stockBar = this.querySelector('.stock-fill');
                if (stockBar) {
                    const percentage = stockBar.getAttribute('data-percentage');
                    stockBar.style.width = Math.min(parseFloat(percentage) + 10, 100) + '%';
                }
            });
            
            row.addEventListener('mouseleave', function() {
                const stockBar = this.querySelector('.stock-fill');
                if (stockBar) {
                    const percentage = stockBar.getAttribute('data-percentage');
                    stockBar.style.width = percentage + '%';
                }
            });
        });
    </script>
</body>
</html>