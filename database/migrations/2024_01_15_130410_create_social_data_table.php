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
        Schema::create('social_data', function (Blueprint $table) {
            $table->id();
            $table->string('social_platform', 255);
            $table->string('total_visits', 55);
            $table->string('page_views', 55);
            $table->string('unique_visitors', 55);
            $table->string('followers', 55);
            $table->string('likes', 55);
            $table->string('tweets', 55);
            $table->integer('priority')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_data');
    }
};
