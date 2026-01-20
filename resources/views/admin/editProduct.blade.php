<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Admin</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- HEADER -->
    <header class="bg-gradient-to-r from-blue-600 to-blue-800 shadow-lg sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.listProduct') }}" 
                       class="text-white hover:text-blue-100 transition-colors duration-200">
                        <i class="fas fa-arrow-left text-lg"></i>
                    </a>
                    <h1 class="text-white text-xl font-bold">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Product
                    </h1>
                </div>
                <div class="hidden md:block">
                    <span class="text-blue-100 text-sm">Editing: {{ substr($product->nama, 0, 30) }}{{ strlen($product->nama) > 30 ? '...' : '' }}</span>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="max-w-6xl mx-auto px-4 py-6">
        <!-- EDIT FORM CARD -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <!-- CARD HEADER -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-5">
                <h2 class="text-white text-xl font-bold flex items-center gap-2">
                    <i class="fas fa-cube"></i>
                    Product Information
                </h2>
                <p class="text-blue-100 text-sm mt-1">Update product details and variants</p>
            </div>

            <!-- FORM -->
            <form action="{{ route('admin.updateProduct', $product->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  class="p-6 space-y-8"
                  id="editForm">
                @csrf
                @method('PUT')

                <!-- PRODUCT INFO SECTION -->
                <section class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-1 h-6 bg-blue-600 rounded-full"></div>
                        <h3 class="text-lg font-semibold text-gray-800">Product Details</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- NAMA -->
                        <div class="space-y-2">
                            <label class="font-medium text-gray-700 flex items-center gap-2">
                                <i class="fas fa-tag text-blue-500 text-sm"></i>
                                Product Name
                            </label>
                            <input type="text" 
                                   name="nama" 
                                   value="{{ $product->nama }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                        </div>

                        <!-- HARGA -->
                        <div class="space-y-2">
                            <label class="font-medium text-gray-700 flex items-center gap-2">
                                Price
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-3 text-gray-500">Rp. </span>
                                <input type="number" 
                                       name="harga" 
                                       value="{{ $product->harga }}"
                                       min="0"
                                       required
                                       class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                            </div>
                        </div>

                        <!-- KATEGORI -->
                        <div class="space-y-2">
                            <label class="font-medium text-gray-700 flex items-center gap-2">
                                <i class="fas fa-folder text-purple-500 text-sm"></i>
                                Category
                            </label>
                            <select name="category_id"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 appearance-none bg-white">
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" 
                                            {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="space-y-2 md:col-span-2">
                            <label class="font-medium text-gray-700 flex items-center gap-2">
                                <i class="fas fa-align-left text-gray-500 text-sm"></i>
                                Description
                            </label>
                            <textarea name="deskripsi"
                                      rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 resize-none">{{ $product->deskripsi }}</textarea>
                        </div>
                    </div>
                </section>

                <!-- VARIANTS SECTION -->
                <section class="space-y-6 pt-6 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-2">
                            <div class="w-1 h-6 bg-green-600 rounded-full"></div>
                            <h3 class="text-lg font-semibold text-gray-800">Product Variants</h3>
                        </div>
                        <button type="button"
                                onclick="addVariant()"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2.5 rounded-lg font-medium transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg">
                            <i class="fas fa-plus"></i>
                            Add Variant
                        </button>
                    </div>

                    <!-- EXISTING VARIANTS -->
                    <div id="variant-container" class="space-y-4">
                        @foreach ($product->variants as $variant)
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 hover:border-gray-300 transition-all duration-200">
                                <div class="grid grid-cols-1 md:grid-cols-5 gap-3 items-end">
                                    <div class="space-y-1">
                                        <label class="text-sm text-gray-600">Color</label>
                                        <input type="text"
                                               name="variants_existing[{{ $variant->id }}][warna]"
                                               value="{{ $variant->warna }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-green-500">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-sm text-gray-600">Size</label>
                                        <input type="text"
                                               name="variants_existing[{{ $variant->id }}][ukuran]"
                                               value="{{ $variant->ukuran }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-green-500">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-sm text-gray-600">Stock</label>
                                        <input type="number"
                                               name="variants_existing[{{ $variant->id }}][stok]"
                                               value="{{ $variant->stok }}"
                                               min="0"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-green-500">
                                    </div>
                                    <div class="md:col-span-2 pt-2">
                                        <label class="flex items-center gap-2 text-sm cursor-pointer hover:text-red-700 transition-colors duration-200">
                                            <input type="checkbox"
                                                   name="variants_existing[{{ $variant->id }}][delete]"
                                                   class="rounded text-red-600 focus:ring-red-500">
                                            <i class="fas fa-trash-alt"></i>
                                            Remove this variant
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- NEW VARIANTS CONTAINER -->
                    <div id="variant-new-container" class="space-y-4"></div>
                </section>

                <!-- IMAGES SECTION -->
                <section class="space-y-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-1 h-6 bg-purple-600 rounded-full"></div>
                        <h3 class="text-lg font-semibold text-gray-800">Product Images</h3>
                    </div>

                    <!-- NEW IMAGES UPLOAD -->
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label class="font-medium text-gray-700 flex items-center gap-2">
                                <i class="fas fa-images text-purple-500"></i>
                                Add New Images
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-purple-400 transition-all duration-200 cursor-pointer"
                                 onclick="document.getElementById('imageUpload').click()">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3"></i>
                                <p class="text-gray-600 font-medium">Click to upload images</p>
                                <p class="text-gray-400 text-sm mt-1">PNG, JPG, GIF up to 5MB</p>
                                <input type="file"
                                       id="imageUpload"
                                       name="images[]"
                                       multiple
                                       accept="image/*"
                                       onchange="previewImages(this)"
                                       class="hidden">
                            </div>
                        </div>

                        <!-- IMAGE PREVIEW -->
                        <div id="image-preview" 
                             class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                            <!-- Preview images will appear here -->
                        </div>
                    </div>
                </section>

                <!-- SUBMIT BUTTON -->
                <div class="pt-6 border-t border-gray-200">
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white py-3.5 rounded-xl font-semibold text-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- EXISTING IMAGES -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center gap-2 mb-4">
                <i class="fas fa-photo-video text-blue-500"></i>
                <h3 class="text-lg font-semibold text-gray-800">Existing Images</h3>
                <span class="ml-auto text-sm text-gray-500">{{ $product->images->count() }} images</span>
            </div>
            
            @if($product->images->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                    @foreach ($product->images as $img)
                        <div class="relative group rounded-xl overflow-hidden">
                            <img src="{{ asset('storage/'.$img->image) }}"
                                 alt="Product Image"
                                 class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <form action="{{ route('admin.deleteImage', $img->id) }}"
                                      method="POST"
                                      class="absolute bottom-3 right-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirmDelete()"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center gap-1 shadow-lg">
                                        <i class="fas fa-trash text-xs"></i>
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-400">
                    <i class="fas fa-image text-4xl mb-3"></i>
                    <p>No additional images</p>
                </div>
            @endif
        </div>
    </main>

    <script>
        let variantIndex = 0;

        function addVariant() {
            const container = document.getElementById('variant-new-container');
            const variantId = `new-${variantIndex}`;
            
            const variantHTML = `
                <div id="${variantId}" class="bg-gradient-to-r from-green-50 to-white p-4 rounded-xl border border-green-200">
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-3 items-end">
                        <div class="space-y-1">
                            <label class="text-sm text-gray-600">Color</label>
                            <input type="text" 
                                   name="variants_new[${variantIndex}][warna]" 
                                   placeholder="e.g., Red"
                                   required
                                   class="w-full px-3 py-2 border border-green-300 rounded-lg focus:ring-1 focus:ring-green-500">
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm text-gray-600">Size</label>
                            <input type="text" 
                                   name="variants_new[${variantIndex}][ukuran]" 
                                   placeholder="e.g., XL"
                                   required
                                   class="w-full px-3 py-2 border border-green-300 rounded-lg focus:ring-1 focus:ring-green-500">
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm text-gray-600">Stock</label>
                            <input type="number" 
                                   name="variants_new[${variantIndex}][stok]" 
                                   min="0" 
                                   value="0"
                                   required
                                   class="w-full px-3 py-2 border border-green-300 rounded-lg focus:ring-1 focus:ring-green-500">
                        </div>
                        <div class="md:col-span-2 pt-2">
                            <button type="button"
                                    onclick="removeVariant('${variantId}')"
                                    class="bg-red-100 hover:bg-red-200 text-red-700 px-4 py-2 rounded-lg font-medium transition-all duration-200 flex items-center gap-2 w-full justify-center">
                                <i class="fas fa-trash"></i>
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', variantHTML);
            variantIndex++;
            
            // Scroll to new variant
            document.getElementById(variantId).scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        function removeVariant(elementId) {
            const element = document.getElementById(elementId);
            if (element) {
                element.style.opacity = '0';
                element.style.transform = 'translateX(-20px)';
                setTimeout(() => element.remove(), 300);
            }
        }

        function previewImages(input) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = '';
            
            if (input.files.length > 0) {
                Array.from(input.files).forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = e => {
                        const div = document.createElement('div');
                        div.className = 'relative group rounded-xl overflow-hidden';
                        div.innerHTML = `
                            <img src="${e.target.result}" 
                                 class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute top-2 right-2">
                                <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded-full">New</span>
                            </div>
                        `;
                        preview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });
            }
        }

        // function confirmDelete() {
        //     return Swal.fire({
        //         title: 'Are you sure?',
        //         text: "This image will be permanently removed!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#d33',
        //         cancelButtonColor: '#3085d6',
        //         confirmButtonText: 'Yes, delete it!'
        //     }).then((result) => {
        //         return result.isConfirmed;
        //     });
        // }

        // Form submission handling
        document.getElementById('editForm').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';
            submitBtn.disabled = true;
        });
    </script>
</body>
</html>