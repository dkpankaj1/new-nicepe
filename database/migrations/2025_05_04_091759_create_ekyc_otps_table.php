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
        Schema::create('ekyc_otps', function (Blueprint $table) {
            $table->id();
            $table->string('aadhaar_number', 12)->unique();
            $table->string('transaction_id')->unique();
            $table->string('otp')->nullable();
            $table->boolean('is_expite')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekyc_otps');
    }
};
