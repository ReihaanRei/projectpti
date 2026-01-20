<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'harga', 'category_id', 'gambar'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function thumbnail()
    {
        return $this->hasOne(ProductImage::class)->oldestOfMany(); // atau ->latestOfMany()
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }


}
