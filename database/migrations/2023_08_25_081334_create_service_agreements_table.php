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
        Schema::create('service_agreements', function (Blueprint $table) {
            $table->id();
            $table->string('astrologer_id');
            $table->string('uploaded_by');
            $table->string('agreement_by_admin')->nullable();
            $table->string('agreement_by_astrologer')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_agreements');
    }
};
