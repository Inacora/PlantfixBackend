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
                'price' => 25.00,
                'description' => 'A stunning plant with arrow-shaped leaves and striking veins.',
                'stock' => 10,
                'image_url' => null,
                'plant_family_id' => 1,
            ],
            [
                'name' => 'Monstera Deliciosa',
                'price' => 30.00,
                'description' => 'A popular houseplant known for its large, split leaves.',
                'stock' => 15,
                'image_url' => null,
                'plant_family_id' => 2,
            ],
            [
                'name' => 'Fiddle Leaf Fig',
                'price' => 40.00,
                'description' => 'A trendy plant with large, glossy leaves.',
                'stock' => 5,
                'image_url' => null,
                'plant_family_id' => 3,
            ],
            [
                'name' => 'Snake Plant',
                'price' => 20.00,
                'description' => 'A hardy plant that thrives on neglect.',
                'stock' => 20,
                'image_url' => null,
                'plant_family_id' => 4,
            ],
            [
                'name' => 'Spider Plant',
                'price' => 15.00,
                'description' => 'An easy-to-care-for plant with arching leaves and baby plants.',
                'stock' => 25,
                'image_url' => null,
                'plant_family_id' => 5,
            ],
            [
                'name' => 'Peace Lily',
                'price' => 18.00,
                'description' => 'A beautiful plant with white flowers and air-purifying qualities.',
                'stock' => 12,
                'image_url' => null,
                'plant_family_id' => 6,
            ],
            [
                'name' => 'Pothos',
                'price' => 12.00,
                'description' => 'A versatile trailing plant that can thrive in various conditions.',
                'stock' => 30,
                'image_url' => null,
                'plant_family_id' => 7,
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