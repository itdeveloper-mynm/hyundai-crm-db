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
        Schema::table('applications', function (Blueprint $table) {
            $table->string('apply_for')->nullable();
            $table->string('booking_reason')->nullable();
            $table->string('booking_category')->nullable();
            $table->string('department')->nullable();
            $table->string('title')->nullable();
            $table->string('second_surname')->nullable();
            $table->string('nationalid')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('vin')->nullable();
            $table->string('yearr')->nullable();
            $table->string('plateno')->nullable();
            $table->string('plate_alphabets')->nullable();
            $table->string('klmm')->nullable();
            $table->string('intention')->nullable();
            $table->string('preferred_time')->nullable();
            $table->text('comments')->nullable();
            $table->string('sharingcv')->nullable();
            $table->string('privacy_check')->nullable();
            $table->string('marketingagreement')->nullable();
            $table->string('language')->nullable();
            $table->string('company')->nullable();
            $table->string('customers_type')->nullable();
            $table->string('number_of_vehicles')->nullable();
            $table->string('fleet_range')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('application', function (Blueprint $table) {
            //
        });
    }
};
