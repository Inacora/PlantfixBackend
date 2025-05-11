<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantFamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plantFamilies = [
            'Alocasia',
            'Philodendron',
            'Monstera',
            'Anthurium',
            'Hoya',
            'Syngonium',
        ];

        foreach ($plantFamilies as $family) {
            DB::table('plant_families')->insert([
                'name' => $family,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}