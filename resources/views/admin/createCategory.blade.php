<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori - Admin</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-gray-100 min-h-screen">

    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-indigo-800 shadow-lg">
        <div class="max-w-6xl mx-auto px-4 py-5">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.listCategory') }}" 
                       class="text-white hover:text-blue-100 transition-all duration-300 transform hover:-translate-x-1">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <h1 class="text-white text-2xl font-bold flex items-center gap-3">
                        <i class="fas fa-layer-group bg-white/20 p-2 rounded-lg"></i>
                        Tambah Kategori Baru
                    </h1>
                </div>
                <span class="text-blue-100 text-sm font-medium bg-white/10 px-3 py-1 rounded-full">
                    <i class="fas fa-plus-circle mr-1"></i> Form Tambah Data
                </span>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 py-8">
        <!-- Informasi Card -->
        {{-- <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-xl p-5 mb-8 text-white">
            <div class="flex items-start gap-3">
                <i class="fas fa-info-circle text-xl mt-1"></i>
                <div>
                    <h3 class="font-bold text-lg mb-1">Informasi Penting</h3>
                    <p class="text-blue-100 text-sm">Kategori digunakan untuk mengelompokkan produk. Pastikan nama kategori jelas dan mudah dipahami.</p>
                </div>
            </div>
        </div> --}}

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:shadow-3xl">
            <!-- Card Header -->
            <div class="relative bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-5">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-400 to-cyan-400"></div>
                <div class="flex items-center justify-between">
                    <h2 class="text-white text-xl font-bold flex items-center gap-3">
                        <i class="fas fa-edit bg-white/20 p-2 rounded-lg"></i>
                        Formulir Kategori
                    </h2>
                    {{-- <div class="hidden md:block">
                        <span class="text-sm text-blue-100 bg-white/10 px-3 py-1 rounded-full">
                            Langkah 1/1
                        </span>
                    </div> --}}
                </div>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('admin.storeCategory') }}" 
                  id="categoryForm" 
                  class="p-6 md:p-8 space-y-8">
                @csrf

                <!-- Input Nama Kategori -->
                <div class="space-y-4">
                    {{-- <div class="flex items-center gap-2">
                        <div class="w-2 h-6 bg-blue-600 rounded-full"></div>
                        <label class="text-lg font-semibold text-gray-800">
                            <i class="fas fa-font text-blue-500 mr-2"></i>
                            Detail Kategori
                        </label>
                    </div> --}}
                    
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-2xl blur opacity-0 group-hover:opacity-100 transition duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center mb-2">
                                <label class="font-medium text-gray-700 flex items-center gap-2">
                                    Nama Kategori
                                </label>
                            </div>
                            
                            <div class="relative">
                                <input type="text" 
                                       name="nama" 
                                       placeholder="Contoh: Elektronik, Fashion, Makanan, dll."
                                       value="{{ old('nama') }}"
                                       required
                                       class="w-full px-5 py-4 text-lg border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-3 focus:ring-blue-200 transition-all duration-300 placeholder-gray-400">
                                <div class="absolute right-3 top-3">
                                    <i class="fas fa-tag text-gray-400"></i>
                                </div>
                            </div>
                            
                            @error('nama')
                            <div class="mt-3 p-3 bg-red-50 border-l-4 border-red-500 rounded-r">
                                <div class="flex items-start gap-2">
                                    <i class="fas fa-exclamation-circle text-red-500 mt-1"></i>
                                    <div>
                                        <p class="text-red-700 font-medium">Perhatian!</p>
                                        <p class="text-red-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            </div>
                            @enderror
                            
                            {{-- <div class="mt-2 text-sm text-gray-500 flex items-center gap-2">
                                <i class="fas fa-lightbulb text-yellow-500"></i>
                                Gunakan nama yang singkat dan deskriptif
                            </div> --}}
                        </div>
                    </div>
                </div>

                <!-- Preview Nama -->
                {{-- <div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
                    <div class="flex items-center gap-2 mb-3">
                        <i class="fas fa-eye text-purple-600"></i>
                        <span class="font-medium text-gray-700">Pratinjau Nama</span>
                    </div>
                    <div id="namaPreview" class="text-2xl font-bold text-gray-800 min-h-10">
                        {{ old('nama') ?: 'Nama akan muncul di sini...' }}
                    </div>
                    <p class="text-sm text-gray-500 mt-2">
                        <i class="fas fa-info-circle mr-1"></i>
                        Nama akan ditampilkan seperti ini di halaman produk
                    </p>
                </div> --}}

                <!-- Tombol Aksi -->
                <div class="pt-6 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row gap-4">
                        {{-- <a href="{{ route('admin.listCategory') }}" 
                           class="flex-1 flex items-center justify-center gap-3 bg-gray-100 hover:bg-gray-200 text-gray-700 py-4 rounded-xl font-semibold transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fas fa-times"></i>
                            Batal
                        </a> --}}
                        <button type="submit" 
                                id="submitBtn"
                                class="flex-1 flex items-center justify-center gap-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 active:scale-95">
                            <i class="fas fa-save"></i>
                            Simpan Kategori
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tips -->
        {{-- <div class="mt-8 bg-white rounded-2xl shadow-lg p-6">
            <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-lightbulb text-yellow-500"></i>
                Tips Membuat Kategori yang Baik
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-start gap-3">
                    <i class="fas fa-check text-green-500 mt-1"></i>
                    <div>
                        <p class="font-medium text-gray-700">Gunakan nama umum</p>
                        <p class="text-sm text-gray-500">Misal: "Elektronik" bukan "Barang elektronik"</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <i class="fas fa-check text-green-500 mt-1"></i>
                    <div>
                        <p class="font-medium text-gray-700">Hindari simbol khusus</p>
                        <p class="text-sm text-gray-500">Gunakan huruf dan angka saja</p>
                    </div>
                </div>
            </div>
        </div> --}}
    </main>

    <script>
        // Live Preview Nama Kategori
        const namaInput = document.querySelector('input[name="nama"]');
        const namaPreview = document.getElementById('namaPreview');
        
        namaInput.addEventListener('input', function() {
            if (this.value.trim() === '') {
                namaPreview.textContent = 'Nama akan muncul di sini...';
                namaPreview.classList.add('text-gray-400');
                namaPreview.classList.remove('text-gray-800');
            } else {
                namaPreview.textContent = this.value;
                namaPreview.classList.remove('text-gray-400');
                namaPreview.classList.add('text-gray-800');
            }
        });

        // Efek Submit Button
        document.getElementById('categoryForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.innerHTML = `
                <i class="fas fa-spinner fa-spin"></i>
                Menyimpan...
            `;
            submitBtn.disabled = true;
            
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 3000);
        });

        // Efek hover pada input
        const inputField = document.querySelector('input[name="nama"]');
        inputField.addEventListener('focus', function() {
            this.parentElement.parentElement.classList.add('ring-2', 'ring-blue-200');
        });
        
        inputField.addEventListener('blur', function() {
            this.parentElement.parentElement.classList.remove('ring-2', 'ring-blue-200');
        });
    </script>
</body>
</html>