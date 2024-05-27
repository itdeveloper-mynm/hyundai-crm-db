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
            $table->index('customer_id');
            $table->index('city_id');
            $table->index('branch_id');
            $table->index('vehicle_id');
            $table->index('source_id');
            $table->index('campaign_id');
            $table->index('purchase_plan');
            $table->index('monthly_salary');
            $table->index('preferred_appointment_time');
            $table->index('type');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropIndex('applications_customer_id_index');
            $table->dropIndex('applications_city_id_index');
            $table->dropIndex('applications_branch_id_index');
            $table->dropIndex('applications_vehicle_id_index');
            $table->dropIndex('applications_source_id_index');
            $table->dropIndex('applications_campaign_id_index');
            $table->dropIndex('applications_purchase_plan_index');
            $table->dropIndex('applications_monthly_salary_index');
            $table->dropIndex('applications_preferred_appointment_time_index');
            $table->dropIndex('applications_type_index');
            $table->dropIndex('applications_created_at_index');
        });
    }
};
