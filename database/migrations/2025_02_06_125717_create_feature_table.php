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
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->decimal('fee', 10, 2)->default(0);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('plan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('feature_id')->constrained();
            $table->decimal('fee', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_details');
        Schema::dropIfExists('plans');
        Schema::dropIfExists('features');
    }
};
