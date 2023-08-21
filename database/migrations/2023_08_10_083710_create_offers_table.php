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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('offer_name');
            $table->string('user_id')->nullable();
            $table->string('offer_code')->unique();
            $table->string('offer_type');
            $table->float('min_order_value', 10, 2)->default(0);
            $table->float('max_discount_value', 10, 2)->default(0);
            $table->string('activate_date');
            $table->string('deactivate_date');
            $table->string('discount_type');
            $table->integer('discount')->default(0);
            $table->string('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
