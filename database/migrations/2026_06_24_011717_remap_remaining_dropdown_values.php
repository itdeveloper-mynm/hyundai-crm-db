<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $tables = ['applications', 'crm_leads'];

        // Purchase Plan
        $purchasePlanMap = [
            '2 month'         => '2-3 months',
            '3 month'         => '2-3 months',
            '2 Months'        => '2-3 months',
            '3 months'        => '2-3 months',
            'Within 3 months' => '2-3 months',
            '4 month'         => 'After 3 months',
            '4 months'        => 'After 3 months',
            '5 month'         => 'After 3 months',
            '5 months'        => 'After 3 months',
            '6 month'         => 'After 3 months',
            '6 months'        => 'After 3 months',
            '7 month'         => 'After 3 months',
            '7 months'        => 'After 3 months',
            '8 month'         => 'After 3 months',
            '0 month'         => '1 month',
        ];

        // Monthly Salary
        $monthlySalaryMap = [
            'Between 6,000 & 10,000' => 'Between 7,000 and 10,000',
            '12000'                  => 'Above 10,000',
            '15000'                  => 'Above 10,000',
            '17000'                  => 'Above 10,000',
            '20300'                  => 'Above 10,000',
            '25000'                  => 'Above 10,000',
            '10000'                  => 'Between 7,000 and 10,000',
            '5000'                   => 'Between 5,000 and 7,000',
            'Below 5,001'            => 'Below 5,000',
            'below_5000'             => 'Below 5,000',
        ];

        $pdo = DB::connection()->getPdo();

        foreach ($tables as $table) {
            foreach ($purchasePlanMap as $old => $new) {
                $stmt = $pdo->prepare("UPDATE `{$table}` SET purchase_plan = :new WHERE purchase_plan = :old");
                $stmt->bindValue(':new', $new, PDO::PARAM_STR);
                $stmt->bindValue(':old', $old, PDO::PARAM_STR);
                $stmt->execute();
            }

            foreach ($monthlySalaryMap as $old => $new) {
                $stmt = $pdo->prepare("UPDATE `{$table}` SET monthly_salary = :new WHERE monthly_salary = :old");
                $stmt->bindValue(':new', $new, PDO::PARAM_STR);
                $stmt->bindValue(':old', $old, PDO::PARAM_STR);
                $stmt->execute();
            }
        }
    }

    public function down(): void
    {
        // Not reversible — dirty data normalisation
    }
};
