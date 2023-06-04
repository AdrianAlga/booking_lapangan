<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 5; $i++) {
            Field::create([
                'category_id' => Category::inRandomOrder()->first()->id,
                'name' => $faker->name,
                'description' => $faker->sentence,
                'image' => $faker->imageUrl(),
                'rental_price' => $faker->randomFloat(3, 0, 99),
            ]);
        }
    }
}
