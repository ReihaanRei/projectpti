<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductVariant;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductVariant::insert([
            // ===== KYT TT-REVO (ID 1) =====
            ['product_id' => 1, 'warna' => 'Hitam', 'ukuran' => 'M', 'stok' => 1],
            ['product_id' => 1, 'warna' => 'Hitam', 'ukuran' => 'L', 'stok' => 1],

            // ===== ALV ULTRON (ID 2) =====
            ['product_id' => 2, 'warna' => 'Putih', 'ukuran' => 'M', 'stok' => 2],
            ['product_id' => 2, 'warna' => 'Abu-abu', 'ukuran' => 'L', 'stok' => 2],
            ['product_id' => 2, 'warna' => 'Hitam', 'ukuran' => 'XL', 'stok' => 2],

            // ===== RSV S300 (ID 3) =====
            ['product_id' => 3, 'warna' => 'Hitam', 'ukuran' => 'M', 'stok' => 4],
            ['product_id' => 3, 'warna' => 'Hitam', 'ukuran' => 'L', 'stok' => 4],

            // ===== NJS KAIROZ (ID 4) =====
            ['product_id' => 4, 'warna' => 'Pink', 'ukuran' => 'S', 'stok' => 1],
            ['product_id' => 4, 'warna' => 'Hitam', 'ukuran' => 'M', 'stok' => 2],
            ['product_id' => 4, 'warna' => 'Putih', 'ukuran' => 'L', 'stok' => 1],
            ['product_id' => 4, 'warna' => 'Abu-abu', 'ukuran' => 'XL', 'stok' => 1],

            // ===== INK TERRA (ID 5) =====
            ['product_id' => 5, 'warna' => 'Hitam', 'ukuran' => 'M', 'stok' => 2],
            ['product_id' => 5, 'warna' => 'Putih', 'ukuran' => 'L', 'stok' => 3],

            // ===== CARGLOSS (ID 6) =====
            ['product_id' => 6, 'warna' => 'Biru', 'ukuran' => 'M', 'stok' => 6],
            ['product_id' => 6, 'warna' => 'Hitam Doff', 'ukuran' => 'L', 'stok' => 6],

            // ===== KYT KYOTO (ID 7) =====
            ['product_id' => 7, 'warna' => 'Hitam', 'ukuran' => 'M', 'stok' => 3],
            ['product_id' => 7, 'warna' => 'Putih', 'ukuran' => 'L', 'stok' => 3],
            ['product_id' => 7, 'warna' => 'Abu-abu', 'ukuran' => 'XL', 'stok' => 2],

            // ===== VISOR & AKSESORIS (TANPA UKURAN) =====
            ['product_id' => 8, 'warna' => 'Silver', 'ukuran' => '-', 'stok' => 2],
            ['product_id' => 8, 'warna' => 'Biru', 'ukuran' => '-', 'stok' => 1],

            ['product_id' => 9, 'warna' => 'Hitam', 'ukuran' => '-', 'stok' => 10],

            ['product_id' => 10, 'warna' => 'Merah', 'ukuran' => '-', 'stok' => 1],
            ['product_id' => 10, 'warna' => 'Kuning', 'ukuran' => '-', 'stok' => 1],
        ]);
    }
}
