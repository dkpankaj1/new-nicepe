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
        Schema::create('birth_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('name');
            $table->string('name_hi');

            $table->string('gender');
            $table->string('dob');
            $table->string('mobile');

            $table->string('fathername');
            $table->string('fathername_hi');
            $table->string('fathername_adhar');

            $table->string('mothername');
            $table->string('mothername_hi');
            $table->string('mothername_adhar');

            $table->string('village');
            $table->string('village_hi');

            $table->string('post');
            $table->string('post_hi');

            $table->string('police_station');
            $table->string('police_station_hi');

            $table->string('distric');
            $table->string('distric_hi');

            $table->string('state');
            $table->string('pincode');

            $table->string('status')->default('pending');            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('birth_certificates');
    }
};
