<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'users',
            function (Blueprint $table) {
                $table->id();
                $table->string('name', 255)->unique();
                $table->string('email', 255)->unique();
                $table->string('password', 255);
                $table->string('image', 255)->nullable();
                $table->tinyInteger('role')->default(0); //default 0 is user 1 is admin
                $table->rememberToken();
                $table->string('email_verified_token', 255)->nullable();
                $table->timestamp('email_verified_at')->nullable();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
