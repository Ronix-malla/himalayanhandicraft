<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Inquiry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin & Collector Users
        $admin = User::firstOrCreate(
            ['email' => 'admin@himalayan.com'],
            [
                'name' => 'Himalayan Admin',
                'phone' => '+91 98765 00000',
                'role' => 'Admin',
                'status' => 'Active',
                'password' => Hash::make('Bespoke123!'),
            ]
        );

        $customer = User::firstOrCreate(
            ['email' => 'priya.sharma@himalayan.demo'],
            [
                'name' => 'Priya Sharma',
                'phone' => '9876543210',
                'role' => 'Collector',
                'status' => 'Active',
                'password' => Hash::make('Bespoke123!'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'aarav.m@example.com'],
            [
                'name' => 'Aarav Mehta',
                'phone' => '9811122334',
                'role' => 'Collector',
                'status' => 'Active',
                'password' => Hash::make('Bespoke123!'),
            ]
        );

        // 2. Seed Initial Products
        $products = [
            [
                'code' => 'ring-01',
                'name' => 'Aethel Solitaire Hammered Gold Ring',
                'category' => 'rings',
                'category_label' => 'Artisanal Rings',
                'metal' => '18K Gold Vermeil',
                'metal_key' => 'gold',
                'available_metals' => ['18K Gold Vermeil', '925 Sterling Silver', 'Rose Gold'],
                'price' => 2499,
                'original_price' => 3200,
                'rating' => 4.9,
                'reviews_count' => 48,
                'badge' => 'Bestseller',
                'image' => 'assets/images/prod-solitaire-ring.jpg',
                'secondary_image' => 'assets/images/cat-rings.jpg',
                'sizes' => ['US 5', 'US 6', 'US 7', 'US 8', 'US 9'],
                'description' => 'Individually hand-hammered to catch the light from every angle. Features a bezel-set ethical lab-grown diamond on a solid recycled 18K gold vermeil band.',
                'artisan_notes' => 'Hand-forged over 4 hours at our home jeweler bench. Finished with natural organic texture so no two rings are identical.',
                'in_stock' => 5,
                'is_featured' => true,
            ],
            [
                'code' => 'bangle-01',
                'name' => 'Sunburst Sculpted Fluted Gold Cuff',
                'category' => 'bangles',
                'category_label' => 'Hand Bangles',
                'metal' => '18K Gold Vermeil',
                'metal_key' => 'gold',
                'available_metals' => ['18K Gold Vermeil', 'Raw Brass', '925 Sterling Silver'],
                'price' => 4199,
                'original_price' => 5500,
                'rating' => 5.0,
                'reviews_count' => 32,
                'badge' => 'Signature Piece',
                'image' => 'assets/images/cat-bangles.jpg',
                'secondary_image' => 'assets/images/prod-gold-cuff.jpg',
                'sizes' => ['2.4 (Small)', '2.6 (Medium)', '2.8 (Large)'],
                'description' => 'A commanding yet lightweight open cuff bangle sculpted with fluted channels and organic hammered ends. Stacks effortlessly or makes a standalone statement.',
                'artisan_notes' => 'Formed using antique dapping blocks and wooden mallets. Coated with micro-crystalline wax for enduring luster.',
                'in_stock' => 3,
                'is_featured' => true,
            ],
            [
                'code' => 'ring-02',
                'name' => 'Twisted Helix 925 Silver Band',
                'category' => 'rings',
                'category_label' => 'Artisanal Rings',
                'metal' => '925 Sterling Silver',
                'metal_key' => 'silver',
                'available_metals' => ['925 Sterling Silver', 'Oxidized Silver', '18K Gold Vermeil'],
                'price' => 1699,
                'original_price' => 2199,
                'rating' => 4.8,
                'reviews_count' => 56,
                'badge' => 'Hand-Hammered',
                'image' => 'assets/images/prod-silver-ring.jpg',
                'secondary_image' => 'assets/images/cat-rings.jpg',
                'sizes' => ['US 5', 'US 6', 'US 7', 'US 8', 'US 9', 'US 10'],
                'description' => 'Two strands of solid 925 sterling silver wire hand-braided and forged into an unending Möbius loop. Stamped inside with hallmark 925 purity mark.',
                'artisan_notes' => 'Annealed and hand-twisted under torch flame. Polished to a subtle satin sheen that patinas beautifully with time.',
                'in_stock' => 8,
                'is_featured' => true,
            ],
            [
                'code' => 'bangle-02',
                'name' => 'Bohemian Brass Stacking Bangles (Set of 3)',
                'category' => 'bangles',
                'category_label' => 'Hand Bangles',
                'metal' => 'Raw Brass',
                'metal_key' => 'brass',
                'available_metals' => ['Raw Brass', '18K Gold Vermeil', '925 Sterling Silver'],
                'price' => 1899,
                'original_price' => 2499,
                'rating' => 4.7,
                'reviews_count' => 29,
                'badge' => 'Set of 3',
                'image' => 'assets/images/prod-brass-bangle.jpg',
                'secondary_image' => 'assets/images/cat-bangles.jpg',
                'sizes' => ['2.4 (Small)', '2.6 (Medium)', '2.8 (Large)'],
                'description' => 'A trio of handcrafted brass bangles—one textured with tree bark striations, one high-polish smooth, and one beaded cord wire.',
                'artisan_notes' => 'Crafted from nickel-free, solid jewelers brass that acquires an antique vintage patina. Cleans easily with lemon juice and salt.',
                'in_stock' => 12,
                'is_featured' => true,
            ],
            [
                'code' => 'ring-03',
                'name' => 'Celestial Aurora Rose Gold Band',
                'category' => 'rings',
                'category_label' => 'Artisanal Rings',
                'metal' => 'Rose Gold',
                'metal_key' => 'rosegold',
                'available_metals' => ['Rose Gold', '18K Gold Vermeil', '925 Sterling Silver'],
                'price' => 2299,
                'original_price' => 2899,
                'rating' => 4.9,
                'reviews_count' => 37,
                'badge' => 'New Arrival',
                'image' => 'assets/images/prod-rose-ring.jpg',
                'secondary_image' => 'assets/images/cat-rings.jpg',
                'sizes' => ['US 5', 'US 6', 'US 7', 'US 8'],
                'description' => 'Warm blush tones of 14K rose gold over sterling silver. Designed with a soft contoured edge for maximum everyday comfort.',
                'artisan_notes' => 'Hand-beveled on fine jeweler\'s files and diamond-buffed for an ultra-smooth glide on the finger.',
                'in_stock' => 4,
                'is_featured' => false,
            ],
            [
                'code' => 'bangle-03',
                'name' => 'Vedic Hammered Kada Bangle',
                'category' => 'bangles',
                'category_label' => 'Hand Bangles',
                'metal' => '18K Gold Vermeil',
                'metal_key' => 'gold',
                'available_metals' => ['18K Gold Vermeil', 'Raw Brass'],
                'price' => 3899,
                'original_price' => 4799,
                'rating' => 4.9,
                'reviews_count' => 21,
                'badge' => 'Heritage Craft',
                'image' => 'assets/images/prod-gold-cuff.jpg',
                'secondary_image' => 'assets/images/cat-bangles.jpg',
                'sizes' => ['2.4 (Small)', '2.6 (Medium)', '2.8 (Large)'],
                'description' => 'Inspired by royal heirloom kada traditions. Solid weight with heavy hand-textured diamond chiseling across the circumference.',
                'artisan_notes' => 'Heavy gauge wire forged cold on a steel mandrel to impart remarkable strength and longevity.',
                'in_stock' => 6,
                'is_featured' => false,
            ],
            [
                'code' => 'ring-04',
                'name' => 'Vintage Filigree Lotus Ring',
                'category' => 'rings',
                'category_label' => 'Artisanal Rings',
                'metal' => 'Oxidized Silver',
                'metal_key' => 'oxidized',
                'available_metals' => ['Oxidized Silver', '925 Sterling Silver', '18K Gold Vermeil'],
                'price' => 1999,
                'original_price' => 2599,
                'rating' => 4.8,
                'reviews_count' => 42,
                'badge' => 'Vintage',
                'image' => 'assets/images/prod-lotus-ring.jpg',
                'secondary_image' => 'assets/images/prod-silver-ring.jpg',
                'sizes' => ['US 6', 'US 7', 'US 8', 'US 9'],
                'description' => 'Intricate openwork filigree petaled band with antiqued oxidized crevices that accentuate every curved floral detail.',
                'artisan_notes' => 'Treated with a specialized liver-of-sulfur patina wash and selectively hand-polished on the raised highlights.',
                'in_stock' => 7,
                'is_featured' => false,
            ],
            [
                'code' => 'bangle-04',
                'name' => 'Antiqued Tribal Silver Open Cuff',
                'category' => 'bangles',
                'category_label' => 'Hand Bangles',
                'metal' => 'Oxidized Silver',
                'metal_key' => 'oxidized',
                'available_metals' => ['Oxidized Silver', '925 Sterling Silver'],
                'price' => 3299,
                'original_price' => 4200,
                'rating' => 4.9,
                'reviews_count' => 19,
                'badge' => 'Artisan Choice',
                'image' => 'assets/images/prod-oxidized-bangle.jpg',
                'secondary_image' => 'assets/images/cat-bangles.jpg',
                'sizes' => ['Adjustable One-Size (Fits 2.4 - 2.8)'],
                'description' => 'An adjustable split cuff with stamped tribal chevron motifs along both borders and an oxidized vintage finish.',
                'artisan_notes' => 'Individually die-stamped with hand-carved steel punches, then annealed for flexible sizing without metal fatigue.',
                'in_stock' => 5,
                'is_featured' => false,
            ],
            [
                'code' => 'ring-05',
                'name' => 'Elysian Emerald-Cut Signet Ring',
                'category' => 'rings',
                'category_label' => 'Artisanal Rings',
                'metal' => '18K Gold Vermeil',
                'metal_key' => 'gold',
                'available_metals' => ['18K Gold Vermeil', '925 Sterling Silver'],
                'price' => 2799,
                'original_price' => 3500,
                'rating' => 5.0,
                'reviews_count' => 14,
                'badge' => 'Limited Edition',
                'image' => 'assets/images/prod-signet-ring.jpg',
                'secondary_image' => 'assets/images/prod-solitaire-ring.jpg',
                'sizes' => ['US 6', 'US 7', 'US 8', 'US 9', 'US 10'],
                'description' => 'A modern heirloom signet ring featuring a crisp emerald silhouette top plate, brushed satin finish, and tapered comfort shank.',
                'artisan_notes' => 'Hand-cast in small batches of five. Can be worn plain or taken to a local engraver for custom initials.',
                'in_stock' => 2,
                'is_featured' => false,
            ],
            [
                'code' => 'bangle-05',
                'name' => 'Celeste Gemstone Beaded Bangle',
                'category' => 'bangles',
                'category_label' => 'Hand Bangles',
                'metal' => 'Raw Brass',
                'metal_key' => 'brass',
                'available_metals' => ['Raw Brass', '18K Gold Vermeil', 'Rose Gold'],
                'price' => 2499,
                'original_price' => 3199,
                'rating' => 4.6,
                'reviews_count' => 18,
                'badge' => 'New Arrival',
                'image' => 'assets/images/prod-gem-bangle.jpg',
                'secondary_image' => 'assets/images/cat-bangles.jpg',
                'sizes' => ['2.4 (Small)', '2.6 (Medium)', '2.8 (Large)'],
                'description' => 'Delicate raw brass framework adorned with natural iridescent opal and moonstone beads wire-wrapped securely by hand.',
                'artisan_notes' => 'Each gemstone bead is hand-selected for milky luminescence and wire-wrapped with 26-gauge craft wire.',
                'in_stock' => 4,
                'is_featured' => false,
            ],
        ];

        foreach ($products as $pData) {
            Product::updateOrCreate(['code' => $pData['code']], $pData);
        }

        // 3. Seed Sample Inquiries
        Inquiry::firstOrCreate(
            ['email' => 'ananya.p@example.com'],
            [
                'name' => 'Ananya Patel',
                'phone' => '9845067890',
                'subject' => 'Custom Sizing',
                'message' => 'I would like to inquire if the Sunburst Cuff can be made in a custom 2.2 wrist size. Looking forward to your response.',
                'status' => 'new',
            ]
        );

        // 4. Seed Sample Demo Order
        $p1 = Product::where('code', 'ring-01')->first();
        if ($p1 && Order::count() === 0) {
            $order = Order::create([
                'order_number' => 'HIM-749201',
                'user_id' => $customer->id,
                'customer_name' => 'Priya Sharma',
                'customer_email' => 'priya.sharma@himalayan.demo',
                'customer_phone' => '9876543210',
                'street_address' => 'Flat 402, Lotus Orchid, MG Road',
                'landmark' => 'Near HDFC Bank',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'pincode' => '302001',
                'delivery_notes' => 'Please package carefully with certificate.',
                'payment_method' => 'cod',
                'payment_status' => 'pending',
                'order_status' => 'confirmed',
                'subtotal' => 2499.00,
                'discount_amount' => 249.90,
                'coupon_code' => 'HANDMADE10',
                'shipping_amount' => 0.00,
                'gift_wrap_amount' => 100.00,
                'total_amount' => 2349.10,
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $p1->id,
                'product_name' => $p1->name,
                'metal' => '18K Gold Vermeil',
                'size' => 'US 7',
                'price' => 2499.00,
                'quantity' => 1,
                'total' => 2499.00,
                'image' => $p1->image,
            ]);
        }
    }
}
