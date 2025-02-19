<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class BookServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $userIds = DB::table('users')->pluck('id');
        $serviceTypeIds = DB::table('service_types')->pluck('id');
        $categoryIds = DB::table('categories')->pluck('id');
        $subCategoryIds = DB::table('sub_categories')->pluck('id');
        $amcFreeServiceIds = DB::table('amc_free_services')->pluck('id');
        $vendorIds = DB::table('vendors')->pluck('id');

        for ($i = 0; $i < 25; $i++) {
            DB::table('book_services')->insert([
                'user_id' => $faker->randomElement($userIds),
                'service_type_id' => $faker->randomElement($serviceTypeIds),
                'category_id' => $faker->randomElement($categoryIds),
                'sub_category_id' => $faker->randomElement($subCategoryIds),
                'amc_free_service_id' => $faker->randomElement($amcFreeServiceIds),
                'description' => $faker->paragraph,
                'special_instructions' => $faker->paragraph,
                'pet' => $faker->randomElement([1, 2]),
                'available_date' => $faker->date(),
                'service_request' => $faker->word,
                'expert_comments' => $faker->paragraph,
                'vendor_id' => $faker->randomElement($vendorIds),
                'service_completion' => $faker->paragraph,
                'status' => $faker->randomElement([0, 1, 2, 3]),
                'vendor_date' => $faker->date(),
                'vendor_time' => $faker->time(),
                'vendor_description' => $faker->paragraph,
                'vendor_price' => $faker->randomNumber(3),
                'pay_status' => $faker->randomElement([1, 2, 3]),
                'modal_status' => $faker->randomElement([0, 1]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
