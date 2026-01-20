<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Produk - Admin</title>

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .form-card{background:#fff;border-radius:16px;border:1px solid #e5e7eb;overflow:hidden}
        .input-field{border:2px solid #e5e7eb;border-radius:12px;padding:.75rem 1rem;width:100%}
        .input-field:focus{border-color:#3b82f6;box-shadow:0 0 0 3px rgba(59,130,246,.1)}
        .variant-row{background:#f8fafc;border-radius:12px;padding:1rem;border:1px solid #e5e7eb}
        .image-preview-container{display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:1rem;margin-top:1rem}
        .image-preview{border-radius:12px;overflow:hidden;border:2px solid #e5e7eb;position:relative}
        .image-preview img{width:100%;height:100px;object-fit:cover}
        .remove-image{position:absolute;top:5px;right:5px;background:#ef4444;color:#fff;width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer}
        .fade-in{animation:fadeIn .3s ease}
        @keyframes fadeIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        .btn-primary{background:linear-gradient(135deg,#3b82f6,#1d4ed8);color:#fff;padding:1rem;border-radius:12px;font-weight:600}
        .btn-danger{background:linear-gradient(135deg,#ef4444,#dc2626);color:#fff;padding:.6rem 1rem;border-radius:10px}
        .btn-success{background:linear-gradient(135deg,#10b981,#059669);color:#fff;padding:.6rem 1rem;border-radius:10px}
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">

<!-- HEADER -->
<div class="bg-gradient-to-r from-blue-600 to-blue-700 py-5 shadow-lg">
    <div class="max-w-6xl mx-auto px-4 flex items-center gap-3">
        <a href="{{ route('admin.listProduct') }}" class="text-white">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white">Tambah Produk Baru</h1>
            <p class="text-blue-100 text-sm">Lengkapi informasi produk</p>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 py-8">
<div class="form-card fade-in">

<div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 text-white">
    <h2 class="text-lg font-semibold">Form Produk</h2>
</div>

<form action="{{ route('admin.storeProduct') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
@csrf

<!-- NAMA -->
<div>
    <label class="font-medium text-gray-700 mb-2 block">Nama Produk</label>
    <input type="text" name="nama" required class="input-field">
</div>

<!-- HARGA -->
<div>
    <label class="font-medium text-gray-700 mb-2 block">Harga</label>
    <input type="number" name="harga" min="0" required class="input-field">
</div>

<!-- KATEGORI -->
<div>
    <label class="font-medium text-gray-700 mb-2 block">Kategori</label>
    <select name="category_id" required class="input-field">
        <option value="">-- Pilih --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->nama }}</option>
        @endforeach
    </select>
</div>

<!-- DESKRIPSI -->
<div>
    <label class="font-medium text-gray-700 mb-2 block">Deskripsi</label>
    <textarea name="deskripsi" rows="4" class="input-field"></textarea>
</div>

<!-- GAMBAR -->
<div>
    <label class="font-medium text-gray-700 mb-2 block">Gambar Produk</label>

    <div id="dropZone" class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer">
        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
        <p>Klik atau drag gambar ke sini</p>
        <p class="text-sm text-gray-500">Max 5 gambar, JPG/PNG, 5MB</p>
    </div>

    <input type="file" id="imageInput" name="gambar[]" multiple hidden accept="image/*">
    <div id="image-preview" class="image-preview-container"></div>
</div>

<!-- VARIAN -->
<div class="border-t pt-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="font-semibold text-lg">Varian Produk</h3>
        <button type="button" onclick="addVariant()" class="btn-success">
            <i class="fas fa-plus"></i> Tambah Varian
        </button>
    </div>

    <div id="variant-container" class="space-y-3"></div>
</div>

<!-- SUBMIT -->
<button type="submit" class="btn-primary w-full flex justify-center gap-2">
    <i class="fas fa-save"></i> Simpan Produk
</button>

</form>
</div>
</div>

<script>
const MAX_FILES = 5;
const MAX_SIZE = 5 * 1024 * 1024;
const imageInput = document.getElementById('imageInput');
const dropZone = document.getElementById('dropZone');
const preview = document.getElementById('image-preview');
let variantIndex = 0;

dropZone.onclick = () => imageInput.click();

dropZone.ondragover = e => { e.preventDefault(); dropZone.classList.add('bg-blue-50'); };
dropZone.ondragleave = () => dropZone.classList.remove('bg-blue-50');
dropZone.ondrop = e => {
    e.preventDefault();
    dropZone.classList.remove('bg-blue-50');
    handleFiles(e.dataTransfer.files);
};

imageInput.onchange = () => handleFiles(imageInput.files);

function handleFiles(files) {
    const dt = new DataTransfer();
    Array.from(files).slice(0, MAX_FILES).forEach(f => {
        if (!f.type.startsWith('image/')) return alert('File harus gambar');
        if (f.size > MAX_SIZE) return alert('Ukuran max 5MB');
        dt.items.add(f);
    });
    imageInput.files = dt.files;
    renderPreview();
}

function renderPreview() {
    preview.innerHTML = '';
    Array.from(imageInput.files).forEach((file, i) => {
        const reader = new FileReader();
        reader.onload = e => {
            preview.innerHTML += `
                <div class="image-preview fade-in">
                    <img src="${e.target.result}">
                    <div class="remove-image" onclick="removeImage(${i})">
                        <i class="fas fa-times"></i>
                    </div>
                </div>`;
        };
        reader.readAsDataURL(file);
    });
}

function removeImage(i) {
    const dt = new DataTransfer();
    Array.from(imageInput.files).forEach((f, idx) => {
        if (idx !== i) dt.items.add(f);
    });
    imageInput.files = dt.files;
    renderPreview();
}

function addVariant() {
    const c = document.getElementById('variant-container');
    const div = document.createElement('div');
    div.className = 'variant-row fade-in';
    div.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-4 gap-3 items-end">
            <input name="variants[${variantIndex}][warna]" placeholder="Warna" class="input-field">
            <input name="variants[${variantIndex}][ukuran]" placeholder="Ukuran" class="input-field">
            <input type="number" min="0" name="variants[${variantIndex}][stok]" placeholder="Stok" class="input-field">
            <button type="button" class="btn-danger" onclick="this.parentElement.parentElement.remove()">
                <i class="fas fa-trash"></i>
            </button>
        </div>`;
    c.appendChild(div);
    variantIndex++;
}
</script>

</body>
</html>
