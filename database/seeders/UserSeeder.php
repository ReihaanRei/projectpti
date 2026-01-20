<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => '12345678', // akan otomatis di-hash karena field 'password' di-cast sebagai 'hashed'
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Agus',
            'username' => 'agus',
            'password' => '12345678',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Galino',
            'username' => 'galino',
            'password' => '12345678', 
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'User',
            'username' => 'user1',
            'password' => 'password123', // juga akan di-hash
            'role' => 'user',
        ]);
    }
}
