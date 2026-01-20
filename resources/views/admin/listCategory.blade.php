<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/category.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .category-badge {
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
            color: #1D4ED8;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            border: 2px solid #BFDBFE;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .category-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(29, 78, 216, 0.15);
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            border: 1px solid #E5E7EB;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
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
        
        .table-row-hover:hover {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.03) 0%, rgba(59, 130, 246, 0.01) 100%);
        }
        
        .product-count {
            background: #1D4ED8;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            margin-left: 0.5rem;
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
        
        @media (max-width: 640px) {
            .responsive-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 py-5 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="{{ route('adminDashboard') }}" 
                       class="text-white hover:text-blue-100 transition-colors">
                        <i class="fas fa-arrow-left text-lg"></i>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Manajemen Kategori</h1>
                        <p class="text-blue-100 text-sm mt-1">Kelola kategori produk Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-6">
        <!-- Stats and Actions -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <div class="flex gap-3">
                <a href="{{ route('admin.createCategory') }}"
                   class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-5 py-3 rounded-xl 
                          hover:shadow-lg transition-all duration-300 flex items-center gap-2 pulse">
                    <i class="fas fa-plus-circle"></i>
                    <span>Tambah Kategori</span>
                </a>
            </div>
            
            <div class="flex gap-3">
                <div class="stat-card">
                    <div class="flex items-center gap-3">
                        <div class="bg-blue-100 p-2.5 rounded-lg">
                            <i class="fas fa-tags text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Kategori</p>
                            <p class="text-xl font-bold text-gray-900">{{ $categories->total() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        @if (session('success'))
        <div class="mb-6 fade-in">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-4 
                       flex items-center gap-3 shadow-sm">
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
        <div class="mb-6 fade-in">
            <div class="bg-gradient-to-r from-red-50 to-rose-50 border border-red-200 rounded-xl p-4 
                       flex items-center gap-3 shadow-sm">
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

        <!-- Categories Table -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden fade-in">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <div class="flex justify-between items-center">
                    <h3 class="text-white text-lg font-semibold flex items-center gap-2">
                        <i class="fas fa-list"></i>
                        <span>Daftar Kategori</span>
                    </h3>
                    <p class="text-white text-sm font-medium">
                        Total: {{ $categories->total() }} kategori
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-hashtag"></i>
                                    ID
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-tag"></i>
                                    Nama Kategori
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-boxes"></i>
                                    Jumlah Produk
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-calendar"></i>
                                    Dibuat
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($categories as $index => $category)
                        <tr class="table-row-hover fade-in" style="animation-delay: {{ $index * 0.05 }}s">
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 
                                             text-blue-700 font-bold rounded-lg">
                                    {{ $category->id }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="category-badge">
                                    <i class="fas fa-tag"></i>
                                    {{ $category->nama }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $productCount = $category->products_count ?? $category->products->count();
                                @endphp
                                <div class="flex items-center">
                                    <span class="text-gray-700 font-medium">
                                        {{ $productCount }}
                                        <span class="text-sm text-gray-500">produk</span>
                                    </span>
                                    @if($productCount > 0)
                                    {{-- <span class="product-count" title="Tidak dapat dihapus karena ada produk">
                                        <i class="fas fa-exclamation text-xs"></i>
                                    </span> --}}
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm">
                                    <div class="text-gray-900 font-medium">
                                        {{ $category->created_at->format('d M Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $category->created_at->format('H:i') }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($productCount == 0)
                                <button onclick="confirmDelete({{ $category->id }})"
                                        class="action-btn bg-gradient-to-r from-red-500 to-red-600 text-white 
                                               hover:from-red-600 hover:to-red-700">
                                    <i class="fas fa-trash-alt"></i>
                                    <span>Hapus</span>
                                </button>
                                @else
                                <button onclick="showCannotDeleteMessage({{ $productCount }})"
                                        class="action-btn bg-gray-300 text-gray-600 cursor-not-allowed 
                                               hover:bg-gray-400 hover:text-gray-700">
                                    <i class="fas fa-ban"></i>
                                    <span>Tidak Dapat Dihapus</span>
                                </button>
                                @endif
                                <form id="delete-category-form-{{ $category->id }}"
                                      action="{{ route('admin.destroyCategory', $category->id) }}"
                                      method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12">
                                <div class="text-center">
                                    <div class="mx-auto w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 
                                                rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-tags text-gray-400 text-3xl"></i>
                                    </div>
                                    <h4 class="text-xl font-bold text-gray-900 mb-2">Belum ada kategori</h4>
                                    <p class="text-gray-600 mb-6">Mulai dengan menambahkan kategori pertama Anda</p>
                                    <a href="{{ route('admin.createCategory') }}"
                                       class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 
                                              text-white px-6 py-3 rounded-xl hover:shadow-lg transition-all duration-300">
                                        <i class="fas fa-plus-circle"></i>
                                        Tambah Kategori Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($categories->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $categories->links('vendor.pagination.tailwind') }}
            </div>
            @endif
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl">
            <div class="text-center mb-6">
                <div class="mx-auto w-16 h-16 bg-gradient-to-br from-red-100 to-red-200 rounded-full 
                           flex items-center justify-center mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Kategori?</h3>
                <p class="text-gray-600">Kategori ini tidak memiliki produk dan dapat dihapus secara permanen.</p>
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
                               transition-all duration-300 flex items-center justify-center gap-2">
                    <i class="fas fa-trash-alt"></i>
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
    
    <!-- Cannot Delete Modal -->
    <div id="cannot-delete-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl">
            <div class="text-center mb-6">
                <div class="mx-auto w-16 h-16 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-full 
                           flex items-center justify-center mb-4">
                    <i class="fas fa-exclamation-circle text-yellow-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Tidak Dapat Dihapus</h3>
                <p class="text-gray-600" id="cannot-delete-message">
                    Kategori ini masih memiliki produk dan tidak dapat dihapus.
                </p>
            </div>
            
            <div class="flex justify-center">
                <button onclick="closeCannotDeleteModal()"
                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white 
                               font-medium rounded-xl hover:from-blue-700 hover:to-blue-800 
                               transition-all duration-300">
                    Mengerti
                </button>
            </div>
        </div>
    </div>

    <script>
        let categoryIdToDelete = null;

        function confirmDelete(id) {
            categoryIdToDelete = id;
            document.getElementById('delete-modal').classList.remove('hidden');
            document.getElementById('delete-modal').classList.add('flex');
        }

        function showCannotDeleteMessage(productCount) {
            const message = document.getElementById('cannot-delete-message');
            message.textContent = `Kategori ini memiliki ${productCount} produk. Hapus semua produk terlebih dahulu sebelum menghapus kategori.`;
            document.getElementById('cannot-delete-modal').classList.remove('hidden');
            document.getElementById('cannot-delete-modal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('delete-modal').classList.add('hidden');
            document.getElementById('delete-modal').classList.remove('flex');
            categoryIdToDelete = null;
        }

        function closeCannotDeleteModal() {
            document.getElementById('cannot-delete-modal').classList.add('hidden');
            document.getElementById('cannot-delete-modal').classList.remove('flex');
        }

        document.getElementById('confirm-delete-btn').addEventListener('click', function() {
            if (categoryIdToDelete) {
                document.getElementById('delete-category-form-' + categoryIdToDelete).submit();
            }
        });

        // Close modals on outside click
        document.getElementById('delete-modal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        document.getElementById('cannot-delete-modal').addEventListener('click', function(e) {
            if (e.target === this) closeCannotDeleteModal();
        });

        // Close modals on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
                closeCannotDeleteModal();
            }
        });
    </script>
</body>
</html>