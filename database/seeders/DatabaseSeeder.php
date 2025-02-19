<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AmcSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(AmcAddOnSeeder::class);
        $this->call(AmcFreeServiceSeeder::class);
        $this->call(ServiceTypeSeeder::class);
        $this->call(SubCategorySeeder::class);
        $this->call(VendorSeeder::class);
        $this->call(VendorTypeSeeder::class);
        $this->call(BookServiceSeeder::class);
        $this->call(BookServiceImageSeeder::class);
        $this->call(UserSeeder::class);

    }
}
