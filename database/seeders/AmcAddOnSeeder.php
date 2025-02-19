<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class AmcAddOnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $amcIds = DB::table('amc')->pluck('id');

        for ($i = 0; $i < 25; $i++) {
            DB::table('amc_add_ons')->insert([
                'amc_id' => $faker->randomElement($amcIds),
                'name' => $faker->word,
                'price' => $faker->randomNumber(3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
