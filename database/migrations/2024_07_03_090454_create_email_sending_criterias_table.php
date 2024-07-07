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
        Schema::create('email_sending_criterias', function (Blueprint $table) {
            $table->id();
            $table->string('header')->nullable();
            $table->string('body')->nullable();
            $table->string('type')->nullable();
            $table->string('emails')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_sending_criterias');
    }
};
