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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('date_format')->nullable();
            $table->unsignedBigInteger('default_currency')->nullable();
            $table->string('timezone')->nullable();
            $table->string('language')->default('en');
            $table->integer('session_timeout')->default(30);
            $table->string('copyright')->nullable();
            $table->string('developed_by')->nullable();
            $table->timestamps();
            $table->foreign('default_currency')->references('id')->on('currencies')->onDelete('set null');
        });
        Schema::create('brand_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_light')->nullable();
            $table->string('logo_dark')->nullable();
            $table->string('favicon')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->timestamps();
        });
        Schema::create('email_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('smtp_host')->nullable();
            $table->integer('smtp_port')->nullable();
            $table->string('smtp_username')->nullable();
            $table->string('smtp_password')->nullable();
            $table->enum('smtp_encryption', ['ssl', 'tls', 'none'])->nullable();
            $table->string('from_address')->nullable();
            $table->string('from_name')->nullable();
            $table->string('reply_to_address')->nullable();
            $table->string('reply_to_name')->nullable();
            $table->boolean('enable')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
        Schema::dropIfExists('brand_settings');
        Schema::dropIfExists('email_configurations');
    }
};
