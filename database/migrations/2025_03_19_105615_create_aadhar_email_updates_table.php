<?php

use App\Enums\Status;
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
        Schema::create('aadhar_email_updates', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('parent')->nullable();
            $table->string('aadhar');
            $table->string('mobile');
            $table->string('email');

            $table->binary('fingerprint1')->nullable();
            $table->binary('fingerprint2')->nullable();
            $table->binary('fingerprint3')->nullable();
            $table->binary('fingerprint4')->nullable();
            $table->binary('fingerprint5')->nullable();

            $table->string('status')->default(Status::PENDING->value);

            $table->string('recept')->nullable();
            $table->string('remark')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aadhar_email_updates');
    }
};
