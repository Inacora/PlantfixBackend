<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 orders with random data
        for ($i = 0; $i < 10; $i++) {
            DB::table('orders')->insert([
                'user_id' => rand(1, 10), // Assuming you have 10 users
                'status' => 'completed',
                'order_date' => now()->subDays(rand(1, 30)), // Random order date within the last 30 days
                'total_price' => rand(100, 1000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Create order plants for each order
        $orders = DB::table('orders')->get();
        foreach ($orders as $order) {
            for ($j = 0; $j < rand(1, 5); $j++) { // Random number of plants per order
                DB::table('order_plants')->insert([
                    'order_id' => $order->id,
                    'plant_id' => rand(1, 10), // Assuming you have 10 plants
                    'quantity' => rand(1, 10),
                    'price_at_time' => rand(10, 100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }   
}
// This seeder creates 10 orders with random data and associates a random number of plants with each order.