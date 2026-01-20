<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
class AdminTransactionController extends Controller
{
    // List semua transaksi
    public function index()
    {
        $transactions = Transaction::with('items.product', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.transactions.index', compact('transactions'));
    }

    public function confirmTransaction($id)
    {
        $transaction = Transaction::with('items.variant')->findOrFail($id);

        // Cegah double proses
        if ($transaction->status !== 'pending') {
            return back()->with('error', 'Transaksi sudah diproses.');
        }

        DB::transaction(function () use ($transaction) {

            foreach ($transaction->items as $item) {
                $variant = $item->variant;

                // Validasi stok
                if ($variant->stok < $item->qty) {
                    throw new \Exception(
                        "Stok varian {$variant->warna} {$variant->ukuran} tidak mencukupi."
                    );
                }

                // Kurangi stok
                $variant->decrement('stok', $item->qty);
            }

            // Update status transaksi
            $transaction->update([
                'status' => 'paid',
            ]);
        });

        return back()->with('success', 'Transaksi berhasil dikonfirmasi dan stok telah dikurangi.');
    }

    /**
     * BATALKAN TRANSAKSI
     * - Status -> cancelled
     * - Stok TIDAK diubah
     */
    public function cancelTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->status !== 'pending') {
            return back()->with('error', 'Transaksi sudah diproses.');
        }

        $transaction->update([
            'status' => 'cancelled',
        ]);

        return back()->with('success', 'Transaksi berhasil dibatalkan.');
    }
}
