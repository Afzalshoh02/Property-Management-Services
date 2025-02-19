<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $categoryIds = DB::table('categories')->pluck('id');

        for ($i = 0; $i < 25; $i++) {
            DB::table('sub_categories')->insert([
                'category_id' => $faker->randomElement($categoryIds),
                'name' => $faker->word,
                'is_delete' => $faker->randomElement([0, 1]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
