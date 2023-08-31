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
        Schema::create('astrologer_costs', function (Blueprint $table) {
            $table->id();
            $table->string('astrologer_id');
            $table->double('payment_chat',10,2)->default(0.00)->comment('per-minute charge');
            $table->double('payment_call',10,2)->default(0.00)->comment('per-minute charge');
            $table->bigInteger('admin_charge')->default(0)->comment('admin charges in percentage');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('astrologer_costs');
    }
};
