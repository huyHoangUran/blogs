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
        Schema::create(
            'blogs',
            function (Blueprint $table) {
                $table->id();
                $table->bigInteger('user_id');
                $table->string('title', 255);
                $table->text('content');
                $table->string('img', 255)->nullable();
                $table->bigInteger('category_id');
                $table->boolean('status')->default(0);  //status 0 isn't active , 1 is active 
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
