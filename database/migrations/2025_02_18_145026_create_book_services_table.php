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
        Schema::create('book_services', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('service_type_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('sub_category_id')->nullable();
            $table->string('amc_free_service_id')->nullable();
            $table->text('description')->nullable();
            $table->text('special_instructions')->nullable();
            $table->string('pet')->nullable()->comment('1: Yes, 2: No');
            $table->date('available_date')->nullable();
            $table->string('service_request')->nullable();
            $table->text('expert_comments')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->text('service_completion')->nullable();
            $table->tinyInteger('status')->default(0)
                ->comment('0:Pending,1:Waiting,2:Confirm,3:Reject');
            $table->date('vendor_date')->nullable();
            $table->string('vendor_time')->nullable();
            $table->text('vendor_description')->nullable();
            $table->string('vendor_price')->nullable();
            $table->tinyInteger('pay_status')->default(0)
                ->comment('1:Admin Send Pay Ment,2:User Payment Done,3:User Reject Payment');
            $table->tinyInteger('modal_status')->default(0)->comment('0:Show, 1:Hide');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_services');
    }
};
