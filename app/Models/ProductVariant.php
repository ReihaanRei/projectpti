<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\TransactionItem;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'warna',
        'ukuran',
        'stok'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // ✅ TAMBAHKAN INI
    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class, 'variant_id');
    }
}
