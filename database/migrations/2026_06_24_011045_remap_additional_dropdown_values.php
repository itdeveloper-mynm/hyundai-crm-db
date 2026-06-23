<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $tables = ['applications', 'crm_leads'];

        // Purchase Plan — trim leading/trailing spaces
        foreach ($tables as $table) {
            DB::table($table)->where('purchase_plan', ' 2-3 months')->update(['purchase_plan' => '2-3 months']);
        }

        // Monthly Salary — confirmed mappings
        $monthlySalaryMap = [
            'Between 5,000 & 7,000'    => 'Between 5,000 and 7,000',
            'Between 7,000 & 10,000'   => 'Between 7,000 and 10,000',
            '5000-10000'               => 'Between 5,000 and 7,000',
            'More than 10,000'         => 'Above 10,000',
            // Numeric variants of "Above 10,000"
            'Above 10,001'             => 'Above 10,000',
            'Above 10,002'             => 'Above 10,000',
            'Above 10,003'             => 'Above 10,000',
            'Above 10,004'             => 'Above 10,000',
            'Above 10,005'             => 'Above 10,000',
            // Numeric variants of "Between 5,000 and 10,000" range → 5k-7k
            'Between 5,000 and 10,001' => 'Between 5,000 and 7,000',
            'Between 5,000 and 10,002' => 'Between 5,000 and 7,000',
            'Between 5,000 and 10,003' => 'Between 5,000 and 7,000',
            // Numeric variant of "Between 7,000 and 10,000"
            'Between 7,000 and 10,001' => 'Between 7,000 and 10,000',
        ];

        foreach ($monthlySalaryMap as $old => $new) {
            foreach ($tables as $table) {
                DB::table($table)->where('monthly_salary', $old)->update(['monthly_salary' => $new]);
            }
        }
    }

    public function down(): void
    {
        // Not reversible in a meaningful way — these were dirty data normalisations
    }
};
