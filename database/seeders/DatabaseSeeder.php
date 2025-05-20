<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;

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
        // Crear 10 usuarios aleatorios con factory
        User::factory(10)->create();

        // Crear dos usuarios con datos personalizados
        User::create([
            'name' => 'Usuario',
            'email' => 'usuario@gmail.com',
            'role' => 'user',
            'password' => Hash::make('12341234'), 
            'email_verified_at' => now(),
            'remember_token' => 'KDJASDKFRO',
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('12341234'),
            'email_verified_at' => now(),
            'remember_token' => 'GKDLSADIDJ',
        ]);

        $this->call([
            PlantFamilySeeder::class,
            PlantSeeder::class,
            // OrderPlantSeeder::class,
            // OrderSeeder::class,
        ]);
    }
}
