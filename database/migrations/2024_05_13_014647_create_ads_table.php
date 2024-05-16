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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('name')  ;
            $table->string('home');
            $table->string('fanpage');
            $table->string('image');
            $table->bigInteger('category_id');
            $table->bigInteger('reset_id');
            $table->bigInteger('version_id');
            $table->bigInteger('point_id');
            $table->string('short_description');
            $table->string('server');
            $table->dateTime('alpha_test');
            $table->dateTime('open_beta');
            $table->string('exp');
            $table->string('drop');
            $table->string('anti_hack');
            $table->text('description');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
