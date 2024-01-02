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
        Schema::create('google_businesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->bigInteger('greviews');
            $table->bigInteger('greplied');
            $table->bigInteger('gsearchlisting');
            $table->bigInteger('gmapslisting');
            $table->bigInteger('gwebsite');
            $table->bigInteger('gdirection');
            $table->bigInteger('gcalls');
            $table->string('gtype');
            $table->string('month');
            $table->bigInteger('year');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('google_businesses');
    }
};
