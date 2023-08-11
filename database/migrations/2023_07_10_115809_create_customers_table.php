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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->unique();
            $table->string('otp')->nullable();
            $table->string('expires_at')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('image')->nullable();
            $table->string('astrologer_id')->nullable();
            $table->string('dob')->nullable();
            $table->string('dob_time')->nullable();
            $table->string('role')->default('customer');
            $table->string('gender')->nullable();

            $table->string('dob_place')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('father_name')->nullable();

            $table->string('referral_code')->nullable();
            $table->string('referral_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
