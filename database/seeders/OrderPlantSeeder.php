<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderPlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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