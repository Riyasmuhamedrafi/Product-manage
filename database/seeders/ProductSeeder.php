<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Auth;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $faker = Faker::create();

        // Assume a user is logged in for this example
        $userId = Auth::id() ?? 1;
        for ($i = 0; $i < 10; $i++) {
            Product::create([
                'name' => $faker->word(),
                'user_id' => $userId,
                'p_code' => generate_product_code(),
                'description' => $faker->sentence(),
                'price' => $faker->numberBetween(10, 1000),
                'status' => $faker->randomElement([0, 1]),
            ]);
        }
    }
}
