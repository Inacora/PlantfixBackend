<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantFamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 plant families with random data
        for ($i = 0; $i < 10; $i++) {
            DB::table('plant_families')->insert([
                'name' => 'Family ' . ($i + 1),
                'description' => 'Description for Family ' . ($i + 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}