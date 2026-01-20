<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['nama' => 'Helm', 
            'created_at' => now(),
            'updated_at' => now(),],
            ['nama' => 'Visor', 
            'created_at' => now(),
            'updated_at' => now(),],
            ['nama' => 'Sarung Tangan',
            'created_at' => now(),
            'updated_at' => now(),],
        ]);
    }
}
