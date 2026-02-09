<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Categories
        $categories = [
            [
                'name' => 'Anime Figurines',
                'slug' => 'anime-figurines',
                'description' => 'High-quality anime action figures and collectibles',
                'is_active' => true,
            ],
            [
                'name' => 'Manga & Comics',
                'slug' => 'manga-comics',
                'description' => 'Latest manga volumes and comic books',
                'is_active' => true,
            ],
            [
                'name' => 'Gaming Merchandise',
                'slug' => 'gaming-merchandise',
                'description' => 'Gaming accessories and merchandise',
                'is_active' => true,
            ],
            [
                'name' => 'Clothing & Apparel',
                'slug' => 'clothing-apparel',
                'description' => 'Anime-themed clothing and t-shirts',
                'is_active' => true,
            ],
            [
                'name' => 'Collectibles',
                'slug' => 'collectibles',
                'description' => 'Rare and limited edition collectibles',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
        }

        // Create Products
        $products = [
            [
                'category_id' => 1,
                'name' => 'Naruto Uzumaki Figure',
                'slug' => 'naruto-uzumaki-figure',
                'sku' => 'NARUTO-001',
                'description' => 'Premium Naruto Uzumaki action figure with detailed sculpting and paint work. Perfect for anime collectors.',
                'price' => 2999,
                'compare_price' => 3499,
                'stock' => 15,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Sasuke Uchiha Figure',
                'slug' => 'sasuke-uchiha-figure',
                'sku' => 'SASUKE-001',
                'description' => 'Detailed Sasuke Uchiha collectible figure with accurate color printing.',
                'price' => 2799,
                'compare_price' => 3299,
                'stock' => 12,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Goku Super Saiyan Figure',
                'slug' => 'goku-super-saiyan',
                'sku' => 'GOKU-001',
                'description' => 'Iconic Super Saiyan Goku figure with LED light effects.',
                'price' => 3499,
                'compare_price' => 4299,
                'stock' => 20,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Levi Ackerman Figure',
                'slug' => 'levi-ackerman-figure',
                'sku' => 'LEVI-001',
                'description' => 'Attack on Titan Levi Ackerman premium figure.',
                'price' => 2599,
                'compare_price' => 3199,
                'stock' => 18,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Demon Slayer Tanjiro Figure',
                'slug' => 'tanjiro-figure',
                'sku' => 'TANJIRO-001',
                'description' => 'Demon Slayer Tanjiro Kamado figure with interchangeable hands.',
                'price' => 2899,
                'compare_price' => 3499,
                'stock' => 25,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'One Piece Vol 100-105',
                'slug' => 'one-piece-vol-100-105',
                'sku' => 'OP-100-105',
                'description' => 'Latest One Piece manga volumes set (100-105).',
                'price' => 1499,
                'compare_price' => 1799,
                'stock' => 30,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Jujutsu Kaisen Complete Series',
                'slug' => 'jujutsu-kaisen-series',
                'sku' => 'JJK-SERIES',
                'description' => 'Complete Jujutsu Kaisen manga collection.',
                'price' => 4999,
                'compare_price' => 5999,
                'stock' => 8,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Gaming Headset Pro',
                'slug' => 'gaming-headset-pro',
                'sku' => 'GHS-001',
                'description' => 'High-quality gaming headset with noise cancellation.',
                'price' => 3999,
                'compare_price' => 5499,
                'stock' => 22,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'RGB Gaming Mouse',
                'slug' => 'rgb-gaming-mouse',
                'sku' => 'MOUSE-001',
                'description' => 'Precision gaming mouse with customizable RGB lighting.',
                'price' => 1999,
                'compare_price' => 2799,
                'stock' => 35,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Anime Logo T-Shirt',
                'slug' => 'anime-logo-tshirt',
                'sku' => 'TSHIRT-001',
                'description' => 'Premium quality anime logo printed t-shirt. Available in multiple sizes.',
                'price' => 599,
                'compare_price' => 799,
                'stock' => 50,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Hoodie with Dragon Print',
                'slug' => 'hoodie-dragon-print',
                'sku' => 'HOODIE-001',
                'description' => 'Comfortable hoodie with dragon print design.',
                'price' => 1299,
                'compare_price' => 1699,
                'stock' => 28,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Limited Edition Sword Replica',
                'slug' => 'sword-replica-limited',
                'sku' => 'SWORD-LIMITED',
                'description' => 'Limited edition anime sword replica. Only 100 units produced.',
                'price' => 8999,
                'compare_price' => 11999,
                'stock' => 5,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Collectible Coin Set',
                'slug' => 'collectible-coin-set',
                'sku' => 'COIN-SET-001',
                'description' => 'Rare collectible coin set from popular anime series.',
                'price' => 2499,
                'compare_price' => 3499,
                'stock' => 10,
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['sku' => $product['sku']],
                $product
            );
        }
    }
}
