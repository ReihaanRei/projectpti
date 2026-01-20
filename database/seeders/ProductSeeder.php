<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'nama' => 'KYT TT-Revo',
                'deskripsi' => 'Helm full face yang sangat kekinian cocok untuk anak muda.',
                'harga' => 1325000.00,
                'category_id' => 1, // Pastikan kategori dengan ID 1 sudah ada
                'gambar' => 'images_seeds/1752648692_68774bf4d2c0c.jpeg', // dikosongkan sesuai permintaan
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'ALV Ultron',
                'deskripsi' => 'helm yang lagi tren dikalangan anak muda | tersedia warna abu-abu, putih dan hitam | ukuran M/L/XL.',
                'harga' => 175000.00,
                'category_id' => 1,
                'gambar' => 'images_seeds/1752648749_68774c2ddc25b.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'RSV S300',
                'deskripsi' => 'Helm ringan dan cocok untuk berkendara di kota.',
                'harga' => 610000.00,
                'category_id' => 1,
                'gambar' => 'images_seeds/1752648832_68774c804cff4.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'NJS Kairoz',
                'deskripsi' => 'helm kekinian untuk anak muda | tersedia warna Pink, Hitam, Putih dan Abu-abu | ukuran S/M/L/XL.',
                'harga' => 750000.00,
                'category_id' => 1,
                'gambar' => 'images_seeds/1752648896_68774cc00caaf.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'INK Terra',
                'deskripsi' => 'helm kekinian untuk anak muda | tersedia warna Pink, Hitam, Putih dan Abu-abu | ukuran S/M/L/XL.',
                'harga' => 590000.00,
                'category_id' => 1,
                'gambar' => 'images_seeds/1752649124_68774da4cdee6.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Cargloss',
                'deskripsi' => 'helm anak muda gaul anti ribet | tersedia warna biru, hitam, putih, hitam doff | ukuran M/L.',
                'harga' => 150000.00,
                'category_id' => 1,
                'gambar' => 'images_seeds/1752649177_68774dd9caaf1.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KYT KYOTO',
                'deskripsi' => 'helm half face segala umat kece | tersedia warna hitam, putih dan abu-abu | ukuran M/L/XL.',
                'harga' => 350000.00,
                'category_id' => 1,
                'gambar' => 'images_seeds/1752649229_68774e0d0e425.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Visor Iridium KYT KYOTO',
                'deskripsi' => 'visor iridium anti aliasing | tersedia warna sliver, kuning dan biru.',
                'harga' => 54500.00,
                'category_id' => 2,
                'gambar' => 'images_seeds/1752649245_68774e1dc7ead.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Sarung Tangan Short Finger',
                'deskripsi' => 'sarung tangan berkualitas kulit anti selip dan keringat.',
                'harga' => 75000.00,
                'category_id' => 3,
                'gambar' => 'images_seeds/1752649264_68774e30ae2a3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Visor Iridium KYT TT-Revo',
                'deskripsi' => 'visor anti aliasing | tersedia berbagai warna, kuning dan merah.',
                'harga' => 155000.00,
                'category_id' => 2,
                'gambar' => 'images_seeds/1752649284_68774e44ca7d7.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
