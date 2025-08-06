<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\ProductSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Jasa Raharja',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Tamu
        User::create([
            'name' => 'Tamu Testing',
            'email' => 'tamu@mail.com',
            'password' => Hash::make('tamu123'),
            'role' => 'tamu',
        ]);

        // Panggil seeder produk
        $this->call([
            ProductSeeder::class,
        ]);
    }
}
