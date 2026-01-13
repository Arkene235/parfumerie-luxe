<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $femme = Category::firstOrCreate([
            'name' => 'Parfums Femme',
        ], [
            'description' => 'Fragrances élégantes pour femmes',
        ]);

        $homme = Category::firstOrCreate([
            'name' => 'Parfums Homme',
        ], [
            'description' => 'Fragrances raffinées pour hommes',
        ]);

        $unisex = Category::firstOrCreate([
            'name' => 'Parfums Unisex',
        ], [
            'description' => 'Fragrances adaptées à tous',
        ]);

        Product::firstOrCreate([
            'name' => 'AICHA',
        ], [
            'description' => 'Un parfum élégant et raffiné, parfait pour les occasions spéciales.',
            'price' => 200.00,
            'stock' => 15,
            'image' => '/images/products/perfume-1.png',
            'category_id' => $homme->id,
        ]);

        Product::firstOrCreate([
            'name' => 'EXOTICA',
        ], [
            'description' => 'Notes exotiques envoûtantes pour une présence masculine captivante.',
            'price' => 200.00,
            'stock' => 20,
            'image' => '/images/products/perfume-2.png',
            'category_id' => $homme->id,
        ]);

        Product::firstOrCreate([
            'name' => 'AMBRE',
        ], [
            'description' => 'Notes chaudes et sensuelles d\'ambre pour une présence captivante.',
            'price' => 200.00,
            'stock' => 12,
            'image' => '/images/products/perfume-3.png',
            'category_id' => $femme->id,
        ]);

        Product::firstOrCreate([
            'name' => 'BLUE MAGIC',
        ], [
            'description' => 'Un parfum féminin frais et mystérieux aux notes aquatiques florales.',
            'price' => 200.00,
            'stock' => 18,
            'image' => '/images/products/perfume-4.png',
            'category_id' => $femme->id,
        ]);

        Product::firstOrCreate([
            'name' => 'BARAKA',
        ], [
            'description' => 'Un parfum aromatique frais, idéal pour le quotidien moderne.',
            'price' => 200.00,
            'stock' => 25,
            'image' => '/images/products/perfume-5.png',
            'category_id' => $homme->id,
        ]);

        Product::firstOrCreate([
            'name' => 'CHERRY',
        ], [
            'description' => 'Notes boisées riches et exotiques pour une élégance sophistiquée.',
            'price' => 200.00,
            'stock' => 8,
            'image' => '/images/products/perfume-6.png',
            'category_id' => $homme->id,
        ]);

        Product::firstOrCreate([
            'name' => 'BOIS',
        ], [
            'description' => 'Un parfum frais et fruité aux notes de poire et freesia.',
            'price' => 200.00,
            'stock' => 10,
            'image' => '/images/products/perfume-7.png',
            'category_id' => $unisex->id,
        ]);

        Product::firstOrCreate([
            'name' => 'MULA',
        ], [
            'description' => 'Notes citrusées légères et herbacées, classique et intemporel.',
            'price' => 200.00,
            'stock' => 14,
            'image' => '/images/products/perfume-8.png',
            'category_id' => $unisex->id,
        ]);

        Product::firstOrCreate([
            'name' => 'MYSTIQUE',
        ], [
            'description' => 'Fleurs blanches pures et fraîches, parfaite pour toutes occasions.',
            'price' => 200.00,
            'stock' => 6,
            'image' => '/images/products/perfume-1.png',
            'category_id' => $unisex->id,
        ]);

        // Create some sample reviews
        $aicha = Product::where('name', 'AICHA')->first();
        if ($aicha && !\App\Models\Review::where('user_id', 1)->where('product_id', $aicha->id)->exists()) {
            \App\Models\Review::create([
                'user_id' => 1, // Assuming user with ID 1 exists
                'product_id' => $aicha->id,
                'rating' => 5,
                'comment' => 'Un parfum floral et élégant ! L\'odeur est divine et persiste toute la journée.',
                'approved' => true,
            ]);
        }

        $exotica = Product::where('name', 'EXOTICA')->first();
        if ($exotica && !\App\Models\Review::where('user_id', 1)->where('product_id', $exotica->id)->exists()) {
            \App\Models\Review::create([
                'user_id' => 1,
                'product_id' => $exotica->id,
                'rating' => 4,
                'comment' => 'Très bon parfum aux notes exotiques, mais un peu cher. La qualité est au rendez-vous.',
                'approved' => true,
            ]);
        }

        // Create sample coupons
        if (!\App\Models\Coupon::where('code', 'BIENVENUE10')->exists()) {
            \App\Models\Coupon::create([
                'code' => 'BIENVENUE10',
                'type' => 'percentage',
                'value' => 10,
                'min_order_amount' => 50,
                'usage_limit' => 100,
                'expires_at' => now()->addDays(30),
                'active' => true,
            ]);
        }

        if (!\App\Models\Coupon::where('code', 'SOLDE20')->exists()) {
            \App\Models\Coupon::create([
                'code' => 'SOLDE20',
                'type' => 'percentage',
                'value' => 20,
                'min_order_amount' => 100,
                'usage_limit' => 50,
                'expires_at' => now()->addDays(7),
                'active' => true,
            ]);
        }

        if (!\App\Models\Coupon::where('code', 'REDUC15')->exists()) {
            \App\Models\Coupon::create([
                'code' => 'REDUC15',
                'type' => 'fixed',
                'value' => 15,
                'min_order_amount' => 80,
                'usage_limit' => 25,
                'expires_at' => now()->addDays(14),
                'active' => true,
            ]);
        }
    }
}
