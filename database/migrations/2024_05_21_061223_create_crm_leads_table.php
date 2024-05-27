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
        Schema::create('crm_leads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->unsignedBigInteger('source_id')->nullable();
            $table->unsignedBigInteger('campaign_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('source_id')->references('id')->on('sources')->onDelete('cascade');
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
            $table->string('yearr')->nullable();
            $table->string('purchase_plan')->nullable();
            $table->string('monthly_salary')->nullable();
            $table->string('category')->nullable();
            $table->string('sub_category')->nullable();
            $table->string('preferred_appointment_time')->nullable();
            $table->string('kyc')->nullable();
            $table->longText('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_leads');
    }
};
