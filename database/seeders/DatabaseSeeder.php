<?php

namespace Database\Seeders;

use App\Models\Discounts;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\ReservationItems;
use Illuminate\Support\Str;
use App\Models\Reservations;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '08123456789',
            'role' => 'admin',
            'password' => bcrypt('admin'),
        ]);

        User::factory()->create([
            'name' => 'kasir',
            'email' => 'kasir@gmail.com',
            'phone' => '082384733948',
            'role' => 'kasir',
            'password' => bcrypt('kasir'),
        ]);

        User::factory()->create([
            'name' => 'koki',
            'email' => 'koki@gmail.com',
            'phone' => '085284759384',
            'role' => 'koki',
            'password' => bcrypt('koki'),
        ]);

        User::factory()->create([
            'name' => 'Muhammad Farhan',
            'email' => 'farhan@gmail.com',
            'phone' => '083173633639',
            'role' => 'user',
            'password' => bcrypt('farhan123'),
        ]);

        User::factory(20)->state(function (array $attributes) {
            $lastMonth = Carbon::now()->subMonth(); 
            return [
                'created_at' => $lastMonth->copy()->subDays(rand(0, $lastMonth->daysInMonth - 1)),
                'updated_at' => $lastMonth->copy()->subDays(rand(0, $lastMonth->daysInMonth - 1)),
            ];
        })->create();

        User::factory(20)->state(function (array $attributes) {
            $currentMonth = Carbon::now(); 
            return [
                'created_at' => $currentMonth->copy()->subDays(rand(0, $currentMonth->day - 1)),
                'updated_at' => $currentMonth->copy()->subDays(rand(0, $currentMonth->day - 1)),
            ];
        })->create();


        $categories = [
            ['name' => 'Maki', 'description' => 'A type of sushi roll.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Uramaki', 'description' => 'A type of inside-out sushi roll.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Special Rolls', 'description' => 'Sushi rolls with unique ingredients.', 'created_at' => now(), 'updated_at' => now()],
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
                'status' => 1,
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
                'status' => 1,
                'floor' => 2,
                'capacity' => $capacities[array_rand($capacities)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $tableNumber++;
        }

        $vipCapacities = [12, 14, 16, 20];
        for ($i = 1; $i <= 4; $i++) {
            Meja::create([
                'table_number' => 'VIP-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'status' => 1,
                'floor' => 2,
                'capacity' => $vipCapacities[$i - 1],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // for ($i = 0; $i < 80; $i++) {
        //     $reservationDate = Carbon::now()->subDays(rand(0, 30)); // Acak antara 0 hingga 30 hari yang lalu
        //     $reservationTime = Carbon::createFromTime(rand(9, 21), rand(0, 59)); // Acak waktu antara 09:00 hingga 21:59

        //     $statusOptions = ['pending', 'paid', 'confirmed', 'finished', 'cancelled'];
        //     $status = $statusOptions[array_rand($statusOptions)];

        //     $reservation = Reservations::create([
        //         'reservation_code' => 'RES-' . rand(100000, 999999),
        //         'table_id' => rand(1, 40),
        //         'user_id' => rand(1, 5),
        //         'guest_count' => rand(1, 10),
        //         'reservation_date' => $reservationDate,
        //         'reservation_time' => $reservationTime,
        //         'status' => $status,
        //         'total_amount' => rand(100000, 800000),
        //         'payment_option' => 100,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);

        //     $menuIds = Menu::pluck('id')->toArray();

        //     // Seeder untuk ReservationItems
        //     for ($j = 0; $j < rand(1, 5); $j++) {
        //         ReservationItems::create([
        //             'reservation_id' => $reservation->id,
        //             'menu_id' => $menuIds[array_rand($menuIds)], // Ambil menu_id dari menu yang ada
        //             'quantity' => rand(1, 3),
        //             'price' => rand(50000, 200000),
        //             'created_at' => now(),
        //         ]);
        //     }
        // }
    }
}
