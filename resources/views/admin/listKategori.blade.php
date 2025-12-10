<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/category.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .category-card {
            transition: all 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-primary {
            background-color: #EFF6FF;
            color: #1D4ED8;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        @media (max-width: 640px) {
            .responsive-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .header-actions {
                flex-direction: column;
                gap: 0.75rem;
            }

            .header-title {
                order: 2;
                text-align: center;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <div class="bg-blue-600 py-4 shadow-md">
            <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
                <h3 class="text-white text-xl font-semibold flex items-center gap-2">
                    <i class="fas fa-tags"></i>
                    <span>Manajemen Kategori</span>
                </h3>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 py-6">
            <!-- Header Actions -->
            <div
                class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4 header-actions">
                <div class="flex gap-2 w-full sm:w-auto">
                    <a href="{{ route('adminDashboard') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                    <a href="{{ route('admin.createCategory') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Kategori</span>
                    </a>
                </div>
                <h2 class="text-xl font-bold header-title">Daftar Kategori Produk</h2>
            </div>

            <!-- Alert Messages -->
            @if (session('success'))
                <div class="mb-6">
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded" role="alert">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6">
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded" role="alert">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <p>{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Category Table -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="bg-blue-600 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-white text-lg font-semibold flex items-center gap-2">
                        <i class="fas fa-list"></i>
                        <span>Semua Kategori</span>
                    </h3>
                    <p class="text-white text-sm">
                        Total: {{ $categories->total() }} kategori
                    </p>
                </div>

                <div class="p-6">
                    <div class="responsive-table">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Kategori</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Dibuat Pada</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($categories as $category)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $category->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="badge badge-primary mr-2">
                                                    <i class="fas fa-tag mr-1"></i>
                                                    {{ $category->nama }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $category->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex gap-2">
                                                <button onclick="confirmDelete({{ $category->id }})"
                                                    class="action-btn bg-red-600 text-white hover:bg-red-700">
                                                    <i class="fas fa-trash"></i>
                                                    <span class="hidden md:inline">Hapus</span>
                                                </button>
                                                <form id="delete-category-form-{{ $category->id }}"
                                                    action="{{ route('admin.destroyCategory', $category->id) }}"
                                                    method="POST" class="hidden">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                            <div class="flex flex-col items-center justify-center py-8">
                                                <i class="fas fa-tags text-4xl text-gray-300 mb-2"></i>
                                                <p class="text-lg">Belum ada kategori</p>
                                                <a href="{{ route('admin.createCategory') }}"
                                                    class="text-blue-600 hover:underline mt-2">
                                                    Tambah kategori pertama Anda
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
                        <div class="mt-6">
                            {{ $categories->links('vendor.pagination.tailwind') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-xl p-6 max-w-md w-full shadow-lg relative">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500 absolute top-4 right-4">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <p class="text-gray-600 mb-6">Anda yakin ingin menghapus kategori ini?</p>
            <div class="flex justify-end gap-3">
                <button onclick="closeModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                    Batal
                </button>
                <button id="confirm-delete-btn" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>


    <script>
        let categoryIdToDelete = null;

        function confirmDelete(id) {
            categoryIdToDelete = id;
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }

        document.getElementById('confirm-delete-btn').addEventListener('click', function() {
            if (categoryIdToDelete) {
                document.getElementById('delete-category-form-' + categoryIdToDelete).submit();
            }
        });
    </script>
</body>

</html>
