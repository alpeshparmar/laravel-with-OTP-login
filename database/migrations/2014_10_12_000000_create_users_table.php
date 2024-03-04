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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('confirm_password')->nullable();
            $table->date('dob')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('otp')->nullable();
            // $table->string('photo_1')->nullable();
            // $table->string('photo_2')->nullable();
            // $table->string('photo_3')->nullable();
            // $table->string('photo_4')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
