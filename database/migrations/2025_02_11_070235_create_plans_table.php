<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade'); // Ensures plans are deleted when user is deleted
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create('plan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')
                ->constrained()
                ->onDelete('cascade'); // Ensures plan details are deleted when plan is deleted
            $table->foreignId('feature_id')->constrained(); // Ensure features exist in the referenced table
            $table->double('fee');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_details');
        Schema::dropIfExists('plans');
    }
};
