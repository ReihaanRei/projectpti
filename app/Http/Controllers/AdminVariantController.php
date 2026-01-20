<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;

class AdminVariantController extends Controller
{
    public function index(Product $product)
    {
        $product->load('variants');
        return view('admin.variants.index', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'warna'  => 'required|string|max:50',
            'ukuran' => 'required|string|max:50',
            'stok'   => 'required|integer|min:0',
        ]);

        $exists = $product->variants()
            ->where('warna', $request->warna)
            ->where('ukuran', $request->ukuran)
            ->exists();

        if ($exists) {
            return back()->withErrors(
                'Varian dengan warna dan ukuran ini sudah ada.'
            );
        }

        $product->variants()->create([
            'warna'  => $request->warna,
            'ukuran' => $request->ukuran,
            'stok'   => $request->stok,
        ]);

        return back()->with('success', 'Varian berhasil ditambahkan');
    }

    public function update(Request $request, ProductVariant $variant)
    {
        $request->validate([
            'warna'  => 'required|string|max:50',
            'ukuran' => 'required|string|max:50',
            'stok'   => 'required|integer|min:0',
        ]);

        $variant->update([
            'warna'  => $request->warna,
            'ukuran' => $request->ukuran,
            'stok'   => $request->stok,
        ]);

        return back()->with('success', 'Varian berhasil diperbarui');
    }

    public function destroy(ProductVariant $variant)
    {
        if ($variant->transactionItems()->exists()) {
            return back()->withErrors(
                'Varian tidak dapat dihapus karena sudah digunakan dalam transaksi.'
            );
        }

        $variant->delete();

        return back()->with('success', 'Varian berhasil dihapus');
    }
}
