<?php

namespace Database\Seeders;

use App\Models\Discounts;
use App\Models\Meja;
use App\Models\MenuCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '08123456789',
            'role' => 'admin',
            'password' => bcrypt('admin'),
        ]);

        User::factory()->create([
            'name' => 'Muhammad Farhan',
            'email' => 'farhan@gmailcom',
            'phone' => '083173633639',
            'role' => 'user',
            'password' => bcrypt('farhan123'),
        ]);

        $categories = [
            ['name' => 'Nigiri Sushi', 'description' => 'Sushi klasik dengan nasi dan topping segar.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sashimi', 'description' => 'Irisan ikan segar yang meleleh di mulut.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Maki Sushi', 'description' => 'Sushi gulung dengan isian yang beragam.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Temaki', 'description' => 'Sushi kerucut dengan porsi yang sempurna.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bento', 'description' => 'Paket makan lengkap dengan cita rasa Jepang.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Minuman', 'description' => 'Aneka minuman untuk melengkapi santap Anda.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dessert', 'description' => 'Manisnya penutup sempurna setelah makan.', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($categories as $category) {
            MenuCategory::create($category);
        }

        Discounts::create([
            'code' => 'DISCOUNT10',
            'description' => 'Diskon 10%',
            'discount_amount' => 10,
            'valid_until' => now()->addDays(30),
            'created_at' => now(),
        ]);

        $capacities = [2, 4, 6, 8, 10];
        $tableNumber = 1;

        for ($i = 1; $i <= 40; $i++) {
            Meja::create([
                'table_number' => 'T-' . str_pad($tableNumber, 2, '0', STR_PAD_LEFT),
                'status' => 0,
                'floor' => 1,
                'capacity' => $capacities[array_rand($capacities)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $tableNumber++;
        }

        for ($i = 1; $i <= 35; $i++) {
            Meja::create([
                'table_number' => 'T-' . str_pad($tableNumber, 2, '0', STR_PAD_LEFT),
                'status' => 0,
                'floor' => 2,
                'capacity' => $capacities[array_rand($capacities)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $tableNumber++;
        }

        // meja VIP
        $vipCapacities = [12, 14, 16, 20];
        for ($i = 1; $i <= 4; $i++) {
            Meja::create([
                'table_number' => 'VIP-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'status' => 0,
                'floor' => 1,
                'capacity' => $vipCapacities[$i - 1],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
