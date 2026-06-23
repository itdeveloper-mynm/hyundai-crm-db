<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Purchase Plan — normalise all old variants to new canonical values
        $purchasePlanMap = [
            '1_month'        => '1 month',
            '2-3 month'      => '2-3 months',
            '2-3_months'     => '2-3 months',
            'After 3 month'  => 'After 3 months',
            'after_3_months' => 'After 3 months',
        ];

        foreach ($purchasePlanMap as $old => $new) {
            DB::table('applications')->where('purchase_plan', $old)->update(['purchase_plan' => $new]);
            DB::table('crm_leads')->where('purchase_plan', $old)->update(['purchase_plan' => $new]);
        }

        // Monthly Salary — normalise all old variants to new canonical values
        $monthlySalaryMap = [
            'below_5000'               => 'Below 5,000',
            '5000-7000'                => 'Between 5,000 and 7,000',
            'Between 5,000 and 10,000' => 'Between 5,000 and 7,000',
            '7000-10000'               => 'Between 7,000 and 10,000',
            'above_10000'              => 'Above 10,000',
            'cash_deal'                => 'Cash Deal',
        ];

        foreach ($monthlySalaryMap as $old => $new) {
            DB::table('applications')->where('monthly_salary', $old)->update(['monthly_salary' => $new]);
            DB::table('crm_leads')->where('monthly_salary', $old)->update(['monthly_salary' => $new]);
        }
    }

    public function down(): void
    {
        // Reverse purchase plan changes
        $purchasePlanReverse = [
            '2-3 months'     => '2-3 month',
            'After 3 months' => 'After 3 month',
        ];

        foreach ($purchasePlanReverse as $new => $old) {
            DB::table('applications')->where('purchase_plan', $new)->update(['purchase_plan' => $old]);
            DB::table('crm_leads')->where('purchase_plan', $new)->update(['purchase_plan' => $old]);
        }

        // Reverse monthly salary changes
        $monthlySalaryReverse = [
            'Between 5,000 and 7,000'  => 'Between 5,000 and 10,000',
            'Between 7,000 and 10,000' => '7000-10000',
        ];

        foreach ($monthlySalaryReverse as $new => $old) {
            DB::table('applications')->where('monthly_salary', $new)->update(['monthly_salary' => $old]);
            DB::table('crm_leads')->where('monthly_salary', $new)->update(['monthly_salary' => $old]);
        }
    }
};
