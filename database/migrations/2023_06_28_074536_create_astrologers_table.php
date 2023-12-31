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
        Schema::create('astrologers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('description')->nullable();
            $table->string('experties')->nullable();
            $table->string('education')->nullable();
            $table->string('experience')->nullable();
            $table->string('language')->nullable();
            $table->string('image')->nullable();
            $table->string('is_active')->default(1);
            $table->string('gender')->nullable();
            $table->string('service_agreement')->nullable();
            $table->string('dob')->nullable();
            $table->string('dob_time')->nullable();
            $table->string('dob_place')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('father_name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('astrologers');
    }
};
