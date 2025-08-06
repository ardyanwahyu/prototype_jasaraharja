<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Image;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Gedung Serbaguna',
                'slug' => 'gedung-serbaguna',
                'description' => 'Gedung luas cocok untuk acara besar.',
                'luas' => '200 m²',
                'fasilitas' => 'AC, Kursi, Panggung, Parkir',
                'harga' => 2500000,
                'status' => 'tersedia',
                'kategori' => 'gedung',
                'images' => ['gedung1.jpg', 'gedung2.jpg']
            ],
            [
                'name' => 'Rumah Dinas A1',
                'slug' => 'rumah-dinas-a1',
                'description' => 'Rumah dinas dengan halaman luas.',
                'luas' => '150 m²',
                'fasilitas' => '2 Kamar Tidur, AC, Dapur',
                'harga' => 1750000,
                'status' => 'tersedia',
                'kategori' => 'rumah_dinas',
                'images' => ['rumah1.jpg', 'rumah2.jpg']
            ],
        ];

        foreach ($products as $item) {
            $product = Product::create([
                'name' => $item['name'],
                'slug' => $item['slug'],
                'description' => $item['description'],
                'luas' => $item['luas'],
                'fasilitas' => $item['fasilitas'],
                'harga' => $item['harga'],
                'status' => $item['status'],
                'kategori' => $item['kategori'],
            ]);

            foreach ($item['images'] as $img) {
                Image::create([
                    'product_id' => $product->id,
                    'image_path' => 'products/' . $img, // nanti kamu simpan di storage/app/public/products/
                ]);
                
            }
        }
    }
}
