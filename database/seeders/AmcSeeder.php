<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class AmcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 25; $i++) {
            DB::table('amc')->insert([
                'name' => $faker->company,
                'amount' => $faker->randomNumber(3),
                'business_category' => $faker->randomElement([0, 1]),
                'series' => $faker->word,
                'is_delete' => $faker->randomElement([0, 1]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
