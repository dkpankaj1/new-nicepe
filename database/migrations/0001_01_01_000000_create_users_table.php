<?php

use App\Enums\UserType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('avatar')->nullable();
            $table->decimal('wallet', 10, 2)->default(0);
            $table->string('api_key')->nullable()->unique();
            $table->string('api_secret')->nullable();
            $table->string('type')->default(UserType::RETAILER); // Assuming UserRole::RETAILER is a valid constant
            $table->boolean('active')->default(true);
            $table->foreignId('parent')->nullable()->constrained('users')->nullOnDelete();
            // $table->foreignId('plan_id')->nullable()->constrained('plans')->nullOnDelete();
            $table->unsignedBigInteger('plan_id')->nullable();

            $table->boolean('ekyc')->default(0);
            $table->string('aadhaarName')->default('N/A');
            $table->string('ekycLLAadhaarName')->default('N/A');
            $table->string('dob')->default('N/A');
            $table->string('genderEng')->default('N/A');
            $table->string('genderHindi')->default('N/A');
            $table->string('ekycCo')->default('N/A');
            $table->string('ekycLoc')->default('N/A');
            $table->string('ekycLLLoc')->default('N/A');
            $table->string('ekycVtc')->default('N/A');
            $table->string('ekycLLVtc')->default('N/A');
            $table->string('ekycDist')->default('N/A');
            $table->string('ekycLLDist')->default('N/A');
            $table->string('ekycState')->default('N/A');
            $table->string('ekycLLState')->default('N/A');
            $table->string('ekycPincode')->default('N/A');
            $table->string('ekycLLPincode')->default('N/A');
            $table->text('photoBase64')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
