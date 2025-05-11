<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plants = [
            [
                'name' => 'Alocasia Amazonica',
                'description' => 'A stunning plant with arrow-shaped leaves and striking veins.',
                'price' => 25.00,
                'image' => null,
                'plant_family_id' => 1,
            ],
            [
                'name' => 'Philodendron Brasil',
                'description' => 'A beautiful trailing plant with heart-shaped leaves and variegated patterns.',
                'price' => 20.00,
                'image' => null,
                'plant_family_id' => 2,
            ],
            [
                'name' => 'Monstera Deliciosa',
                'description' => 'A popular houseplant known for its large, split leaves.',
                'price' => 30.00,
                'image' => null,
                'plant_family_id' => 3,
            ],
            [
                'name' => 'Anthurium Andraeanum',
                'description' => 'A tropical plant with glossy, heart-shaped flowers.',
                'price' => 15.00,
                'image' => null,
                'plant_family_id' => 4,
            ],
            [
                'name' => 'Hoya Carnosa',
                'description' => 'A waxy-leaved plant that produces clusters of star-shaped flowers.',
                'price' => 18.00,
                'image' => null,
                'plant_family_id' => 5,
            ],
            [
                'name' => 'Syngonium Podophyllum',
                'description' => 'A fast-growing plant with arrow-shaped leaves that can adapt to various light conditions.',
                'price' => 12.00,
                'image' => null,
                'plant_family_id' => 6,
            ],
        ];

        foreach ($plants as $plant) {
            DB::table('plants')->insert(array_merge(
                $plant,
                [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ));
        }
    }
}   