<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori - Admin</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .form-card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .form-card:hover {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        .input-field {
            transition: all 0.3s ease;
        }
        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
        .submit-btn {
            transition: all 0.3s ease;
        }
        @media (max-width: 640px) {
            .form-container {
                padding: 1.5rem;
            }
            .header-title {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 py-4 shadow-md">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <h3 class="text-white text-xl font-semibold flex items-center gap-2">
                <i class="fas fa-tags"></i>
                <span>Manajemen Kategori</span>
            </h3>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-2xl mx-auto px-4 py-8 form-container">
        <!-- Navigation -->
        <div class="flex justify-between items-center mb-6">
            {{-- <a href="{{ route('admin.listCategory') }}" class="flex items-center gap-2 text-blue-600 hover:text-blue-800"> --}}
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Daftar Kategori</span>
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden form-card">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <h3 class="text-white text-xl font-semibold flex items-center gap-3">
                    <i class="fas fa-plus-circle"></i>
                    <span>Tambah Kategori Baru</span>
                </h3>
            </div>

            <!-- Form -->
            {{-- <form method="POST" action="{{ route('admin.storeCategory') }}" class="p-6 space-y-6"> --}}
                @csrf

                <!-- Category Name -->
                <div class="space-y-2">
                    <label class="block text-lg font-medium text-gray-700 flex items-center gap-2">
                        <i class="fas fa-tag text-blue-500"></i>
                        <span>Nama Kategori</span>
                    </label>
                    <input type="text" name="nama" placeholder="Masukkan nama kategori"
                        value="{{ old('nama') }}"
                        class="w-full px-4 py-3 rounded-lg border input-field @error('nama') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('nama')
                    <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="w-full flex items-center justify-center gap-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white py-4 rounded-lg hover:from-blue-700 hover:to-blue-800 transition text-lg font-medium shadow-md submit-btn">
                        <i class="fas fa-save"></i>
                        <span>Simpan Kategori</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>