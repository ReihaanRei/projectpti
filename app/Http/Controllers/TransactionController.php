<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'qty' => 'required|integer|min:1',
        ]);

        $variant = ProductVariant::findOrFail($request->variant_id);

        if ($request->qty > $variant->stok) {
            return back()->with('error', 'Stok varian tidak mencukupi');
        }

        $subtotal = $variant->product->harga * $request->qty;

        // SIMPAN TRANSAKSI
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'total_harga' => $subtotal,
            'status' => 'pending',
        ]);

        TransactionItem::create([
            'transaction_id' => $transaction->id,
            'product_id' => $variant->product_id,
            'variant_id' => $variant->id,
            'harga' => $variant->product->harga,
            'qty' => $request->qty,
            'subtotal' => $subtotal,
        ]);

        // KURANGI STOK VARIAN

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat!');
    }

    public function myTransactions()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat transaksi Anda.');
        }

        $transactions = Transaction::with('items.product')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('my', compact('transactions'));
    }
}
