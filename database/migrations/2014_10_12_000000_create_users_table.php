<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->integer('vendor_type_id')->nullable();
            $table->string('employee_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('always_assign')->nullable();
            $table->string('company_name')->nullable();
            $table->string('profile')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('status')->default(0)->comment("0:Active,1:Inactive");
            $table->tinyInteger('is_admin')->default(0)->comment("0:User,1:Admin,3:Vendor");
            $table->tinyInteger('is_delete')->default(0)->comment("0:No Deleted,1:Yes Deleted");
            $table->string('forgot_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
