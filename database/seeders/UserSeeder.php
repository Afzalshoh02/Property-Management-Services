<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 25; $i++) {
            DB::table('users')->insert([
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'mobile' => $faker->phoneNumber,
                'address' => $faker->address,
                'vendor_type_id' => $faker->randomDigitNotNull,
                'employee_id' => $faker->word,
                'amc_id' => $faker->word,
                'amc_business_category_name' => $faker->word,
                'category_id' => $faker->randomDigitNotNull,
                'account_number' => $faker->bankAccountNumber,
                'always_assign' => $faker->word,
                'company_name' => $faker->company,
                'profile' => $faker->imageUrl(),
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'status' => $faker->randomElement([0, 1]), // Active or Inactive
                'is_admin' => $faker->randomElement([0, 1, 3]), // User, Admin, Vendor
                'is_delete' => $faker->randomElement([0, 1]), // No or Yes Deleted
                'forgot_token' => Str::random(60),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->name = $faker->firstName;
            $user->last_name = $faker->lastName;
            $user->email = $faker->unique()->safeEmail;
            $user->vendor_type_id = $faker->numberBetween(1, 3);
            $user->employee_id = $faker->randomNumber(5);
            $user->mobile = $faker->phoneNumber;
            $user->category_id = $faker->numberBetween(1, 5);
            $user->always_assign = $faker->boolean ? 'Yes' : 'No';
            $user->company_name = $faker->company;
            $user->status = $faker->randomElement([0, 1]);
            $user->is_admin = 2;
            $user->remember_token = Str::random(50);
            $user->forgot_token = Str::random(50);

            if ($faker->boolean(30)) {
                $imagePath = $faker->image(public_path('uploads/profile'), 200, 200, null, false);
                if ($imagePath) {
                    $filename = basename($imagePath);
                    $randomStr = Str::random(30);
                    $newFilename = $randomStr . '.' . pathinfo($filename, PATHINFO_EXTENSION);
                    rename(public_path('uploads/profile/' . $filename), public_path('uploads/profile/' . $newFilename));
                    $user->profile = 'uploads/profile/' . $newFilename;
                }
            }
            $user->save();
        }
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'last_name' => 'User',
                'email' => 'admin@example.com',
                'mobile' => $faker->phoneNumber,
                'address' => $faker->address,
                'vendor_type_id' => null,
                'employee_id' => null,
                'amc_id' => null,
                'amc_business_category_name' => null,
                'category_id' => null,
                'account_number' => null,
                'always_assign' => null,
                'company_name' => null,
                'profile' => null,
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'status' => 0, // Active
                'is_admin' => 1, // Admin
                'is_delete' => 0, // Not Deleted
                'forgot_token' => Str::random(60),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User',
                'last_name' => 'User',
                'email' => 'user@example.com',
                'mobile' => $faker->phoneNumber,
                'address' => $faker->address,
                'vendor_type_id' => null,
                'employee_id' => null,
                'amc_id' => null,
                'amc_business_category_name' => null,
                'category_id' => null,
                'account_number' => null,
                'always_assign' => null,
                'company_name' => null,
                'profile' => null,
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'status' => 0, // Active
                'is_admin' => 0, // User
                'is_delete' => 0, // Not Deleted
                'forgot_token' => Str::random(60),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vendor',
                'last_name' => 'User',
                'email' => 'vendor@example.com',
                'mobile' => $faker->phoneNumber,
                'address' => $faker->address,
                'vendor_type_id' => $faker->randomDigitNotNull,
                'employee_id' => null,
                'amc_id' => null,
                'amc_business_category_name' => null,
                'category_id' => null,
                'account_number' => null,
                'always_assign' => null,
                'company_name' => $faker->company,
                'profile' => null,
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'status' => 0,
                'is_admin' => 3,
                'is_delete' => 0,
                'forgot_token' => Str::random(60),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
