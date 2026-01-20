<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Varian Produk</title>

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 min-h-screen">

{{-- HEADER --}}
<div class="bg-blue-600 py-4 shadow-md">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
        <h3 class="text-white text-xl font-semibold flex items-center gap-2">
            <i class="fas fa-layer-group"></i>
            Kelola Varian Produk
        </h3>

        <a href="{{ route('admin.listProduct') }}"
           class="bg-white text-blue-600 px-4 py-2 rounded hover:bg-blue-50 transition flex items-center gap-2">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Produk
        </a>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">

{{-- INFO PRODUK --}}
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h2 class="text-lg font-semibold mb-2">
        {{ $product->nama }}
    </h2>
    <p class="text-gray-600 text-sm">
        Harga: <span class="font-semibold text-blue-600">
            Rp {{ number_format($product->harga, 0, ',', '.') }}
        </span>
    </p>
</div>

{{-- ALERT --}}
@if(session('success'))
    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">
        <ul class="list-disc ml-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- FORM TAMBAH VARIAN --}}
<div class="bg-white rounded-lg shadow p-6 mb-8">
    <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
        <i class="fas fa-plus-circle text-blue-500"></i>
        Tambah Varian Baru
    </h3>

    <form method="POST" action="{{ route('admin.variants.store', $product->id) }}"
          class="grid grid-cols-1 md:grid-cols-4 gap-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Warna</label>
            <input type="text" name="warna" required
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Ukuran</label>
            <input type="text" name="ukuran" required
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Stok</label>
            <input type="number" name="stok" min="0" required
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex items-end">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
                Simpan Varian
            </button>
        </div>
    </form>
</div>

{{-- TABEL VARIAN --}}
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 bg-blue-600 text-white font-semibold">
        Daftar Varian
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm divide-y divide-gray-200">
            <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left">Warna</th>
                <th class="px-6 py-3 text-left">Ukuran</th>
                <th class="px-6 py-3 text-center">Stok</th>
                <th class="px-6 py-3 text-center">Aksi</th>
            </tr>
            </thead>

            <tbody class="divide-y">
            @forelse($product->variants as $variant)
                <tr class="hover:bg-gray-50">

                    {{-- FORM EDIT INLINE --}}
                    <form method="POST"
                          action="{{ route('admin.variants.update', $variant->id) }}">
                        @csrf
                        @method('PUT')

                        <td class="px-6 py-3">
                            <input type="text" name="warna"
                                   value="{{ $variant->warna }}"
                                   class="border rounded px-2 py-1 w-full">
                        </td>

                        <td class="px-6 py-3">
                            <input type="text" name="ukuran"
                                   value="{{ $variant->ukuran }}"
                                   class="border rounded px-2 py-1 w-full">
                        </td>

                        <td class="px-6 py-3 text-center">
                            <input type="number" name="stok"
                                   value="{{ $variant->stok }}"
                                   class="border rounded px-2 py-1 w-20 text-center">
                        </td>

                        <td class="px-6 py-3 text-center flex justify-center gap-2">
                            <button type="submit"
                                    class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700">
                                Simpan
                            </button>
                    </form>

                    <form method="POST"
                          action="{{ route('admin.variants.destroy', $variant->id) }}"
                          onsubmit="return confirm('Hapus varian ini?')">
                        @csrf
                        @method('DELETE')
                        <button
                            class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700">
                            Hapus
                        </button>
                    </form>
                        </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                        Belum ada varian
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

</div>
</body>
</html>
