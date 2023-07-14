<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('full_name');  // min:5 max:30
            $table->string('email')->unique();  // max:50
            $table->string('username')->unique();  // min:5 max:20

            $table->dateTime('email_verified_at')->nullable();

            $table->string('password'); // min:6  max:30

            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

            $table->rememberToken();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
