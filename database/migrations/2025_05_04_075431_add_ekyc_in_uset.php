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
        Schema::table('users', function (Blueprint $table) {
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'ekyc',
                'aadhaarName',
                'ekycLLAadhaarName',
                'dob',
                'genderEng',
                'genderHindi',
                'ekycCo',
                'ekycLoc',
                'ekycLLLoc',
                'ekycVtc',
                'ekycLLVtc',
                'ekycDist',
                'ekycLLDist',
                'ekycState',
                'ekycLLState',
                'ekycPincode',
                'ekycLLPincode',
                'photoBase64'
            ]);
        });
    }
};
