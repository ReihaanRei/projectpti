<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Transaction;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function dashboard()
    {
        // ===============================
        // STATISTIK UMUM
        // ===============================
        $totalProduk = Product::count();
        $produkBulanIni = Product::whereMonth('created_at', now()->month)->count();

        $totalKategori = Category::count();
        $kategoriBulanIni = Category::whereMonth('created_at', now()->month)->count();

        // ===============================
        // STATUS TRANSAKSI
        // ===============================
        $statusCounts = Transaction::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // ===============================
        // GRAFIK HARIAN (7 hari terakhir)
        // ===============================
        $dailySales = Transaction::where('status', 'paid')
            ->whereDate('created_at', '>=', Carbon::now()->subDays(6))
            ->select(
                DB::raw('DATE(created_at) as label'),
                DB::raw('SUM(total_harga) as total')
            )
            ->groupBy('label')
            ->orderBy('label')
            ->get();

        // ===============================
        // GRAFIK MINGGUAN (8 minggu)
        // ===============================
        $weeklySales = Transaction::where('status', 'paid')
            ->select(
                DB::raw("YEARWEEK(created_at, 1) as label"),
                DB::raw('SUM(total_harga) as total')
            )
            ->groupBy('label')
            ->orderBy('label')
            ->limit(8)
            ->get();

        // ===============================
        // GRAFIK BULANAN (12 bulan)
        // ===============================
        $monthlySales = Transaction::where('status', 'paid')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as label"),
                DB::raw('SUM(total_harga) as total')
            )
            ->groupBy('label')
            ->orderBy('label')
            ->limit(12)
            ->get();

        // ===============================
        // GRAFIK TAHUNAN
        // ===============================
        $yearlySales = Transaction::where('status', 'paid')
            ->select(
                DB::raw("YEAR(created_at) as label"),
                DB::raw('SUM(total_harga) as total')
            )
            ->groupBy('label')
            ->orderBy('label')
            ->get();

        return view('adminDashboard', compact(
            'totalProduk',
            'produkBulanIni',
            'totalKategori',
            'kategoriBulanIni',
            'statusCounts',
            'dailySales',
            'weeklySales',
            'monthlySales',
            'yearlySales'
        ));
    }
    public function productIndex()
    {
        $products = Product::with('category', 'variants')->orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::all();
        return view('admin.listProduct', compact('products', 'categories'));
    }

    public function productSearch(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->with('category', 'variants')->paginate(10);
        $categories = Category::all();

        return view('admin.listProduct', compact('products', 'categories'));
    }

    public function productFilter(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->with('category', 'variants')->paginate(10);
        $categories = Category::all(); // ini penting!

        return view('admin.listProduct', compact('products', 'categories'));
    }

    public function confirmTransaction($id)
    {
        $transaction = Transaction::with('items.variant')->findOrFail($id);

        if ($transaction->status !== 'pending') {
            return back()->with('error', 'Transaksi sudah diproses.');
        }

        DB::transaction(function () use ($transaction) {

            // Kurangi stok SETELAH admin konfirmasi
            foreach ($transaction->items as $item) {
                $variant = $item->variant;

                if ($variant->stok < $item->qty) {
                    throw new \Exception('Stok tidak mencukupi untuk varian.');
                }

                $variant->decrement('stok', $item->qty);
            }

            // Update status transaksi
            $transaction->update([
                'status' => 'paid',
            ]);
        });

        return back()->with('success', 'Pesanan berhasil dikonfirmasi dan stok telah dikurangi.');
    }

    public function cancelTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->status !== 'pending') {
            return back()->with('error', 'Transaksi sudah diproses.');
        }

        $transaction->update([
            'status' => 'cancelled',
        ]);

        // ❗ STOK TIDAK DIUBAH

        return back()->with('success', 'Pesanan berhasil ditolak.');
    }

    public function productCreate()
    {
        $categories = Category::all();
        return view('admin.createProduct', compact('categories'));
    }

    public function productStore(Request $request)
    {
            $rules = [
            'nama' => 'required|min:5',
            'harga' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'gambar.*' => 'nullable|image|max:2048',

            // ✅ TAMBAHAN (OPSIONAL)
            'variants' => 'nullable|array',
            'variants.*.warna' => 'required_with:variants|string|max:50',
            'variants.*.ukuran' => 'required_with:variants|string|max:50',
            'variants.*.stok' => 'required_with:variants|integer|min:0',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.createProduct')
                ->withInput()
                ->withErrors($validator);
        }

        // =========================
        // SIMPAN PRODUK (TETAP)
        // =========================
        $product = new Product();
        $product->fill(
            $request->only(['nama', 'harga', 'category_id', 'deskripsi'])
        );
        $product->save();

        // =========================
        // SIMPAN VARIAN (BARU)
        // =========================
        if ($request->filled('variants')) {
            foreach ($request->variants as $variant) {
                $product->variants()->create([
                    'warna'  => $variant['warna'],
                    'ukuran' => $variant['ukuran'],
                    'stok'   => $variant['stok'],
                ]);
            }

            // 🔥 OPSIONAL: kosongkan stok produk induk
            // $product->update(['stok' => 0]);
        }

        // =========================
        // UPLOAD GAMBAR (TETAP)
        // =========================
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $gambar) {
                $imageName = time() . '-' . uniqid() . '.' . $gambar->getClientOriginalExtension();
                $path = $gambar->storeAs('products', $imageName, 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()
            ->route('admin.listProduct')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function productEdit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.editProduct', compact('product', 'categories'));
    }

    public function productUpdate(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $rules = [
            'nama' => 'required|min:5',
            'harga' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // fix nama field
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('admin.editProduct', $product->id)->withInput()->withErrors($validator);
        }

        $product->update($request->only(['nama', 'harga', 'category_id', 'deskripsi']));

        // ================= VARIAN LAMA =================
        if ($request->filled('variants_existing')) {
            foreach ($request->variants_existing as $id => $data) {

                $variant = $product->variants()->find($id);
                if (!$variant) continue;

                if (isset($data['delete'])) {
                    $variant->delete();
                } else {
                    $variant->update([
                        'warna'  => $data['warna'],
                        'ukuran' => $data['ukuran'],
                        'stok'   => $data['stok'],
                    ]);
                }
            }
        }

        // ================= VARIAN BARU =================
        if ($request->filled('variants_new')) {
            foreach ($request->variants_new as $variant) {
                $product->variants()->create([
                    'warna'  => $variant['warna'],
                    'ukuran' => $variant['ukuran'],
                    'stok'   => $variant['stok'],
                ]);
            }
        }

        // Upload gambar baru jika ada
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $imageName = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
                // $img->move(public_path('uploads/products'), $imageName);
                $path = $img->storeAs('products', $imageName, 'public');

                // Simpan ke tabel product_images
                ProductImage::create([
                    'product_id' => $product->id,
                    // 'image' => $imageName,
                    'image' => $path,
                ]);
            }
        }

        return redirect()->route('admin.listProduct', $product->id)->with('success', 'Produk berhasil diperbarui!');
    }

    public function categoryIndex()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.listCategory', compact('categories'));
    }

    public function categoryCreate()
    {
        return view('admin.createCategory');
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:categories,nama',
        ]);

        Category::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.listCategory')->with('success', 'Kategori berhasil ditambahkan!');
    }
    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);

        // $imagePath = public_path('uploads/products/' . $image->image);
        $imagePath = storage_path('app/public/' . $image->image);

        // Cek apakah file benar-benar ada sebelum dihapus
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Hapus data dari database
        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus!');
    }

    public function productDestroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus thumbnail jika ada
        if ($product->thumbnail && $product->thumbnail->image) {
            // $thumbnailPath = public_path('uploads/products/' . $product->thumbnail->image);
            $thumbnailPath = storage_path('app/public/' . $product->thumbnail->image);

            if (File::exists($thumbnailPath)) {
                File::delete($thumbnailPath);
            }

            // Hapus relasi thumbnail dari DB jika perlu
            $product->thumbnail->delete();
        }

        // Hapus semua gambar tambahan
        foreach ($product->images as $image) {
            // $imagePath = public_path('uploads/products/' . $image->image);
            $imagePath = storage_path('app/public/' . $image->image);

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            $image->delete();
        }

        // Hapus produk dari DB
        $product->delete();

        return redirect()->route('admin.listProduct')->with('success', 'Produk berhasil dihapus!');
    }

    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);

        // Cek relasi jika diperlukan, misalnya apakah ada produk yang terhubung
        if ($category->products()->exists()) {
            return redirect()->back()->with('error', 'Kategori tidak bisa dihapus karena masih memiliki produk.');
        }

        $category->delete();

        return redirect()->route('admin.listCategory')->with('success', 'Kategori berhasil dihapus!');
    }
}
