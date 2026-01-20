<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function showKatalog()
    {
        $products = Product::with('category', 'images', 'thumbnail')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->orderByRaw("CASE WHEN categories.nama = 'Helm' THEN 0 ELSE 1 END")
            ->orderBy('products.created_at', 'desc')
            ->select('products.*') // penting untuk menghindari konflik field dari join
            ->paginate(20);

        $categories = Category::all();

        return view('katalog', compact('products', 'categories'));
    }

    public function catalogFilter(Request $request)
    {
        $query = Product::query()->with('category');

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::all();

        return view('katalog', compact('products', 'categories'));
    }

    public function dashboard()
    {
        $highlightProducts = Product::orderBy('harga', 'desc')->take(4)->get();
        return view('index', compact('highlightProducts'));
    }

    public function show($id)
    {
        $product = Product::with('variants', 'images', 'category')->findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->take(4)->get();

        return view('detailProduk', compact('product', 'relatedProducts'));
    }
}
