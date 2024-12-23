<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Application;
use App\Models\Bank;
use App\Models\City;
use App\Models\Branch;
use App\Models\Vehicle;
use App\Models\Source;
use App\Models\Campaign;
use Carbon\Carbon;
use JsonMachine\Items;
use DB;

class NewApplicationDataSeeder extends Seeder
{
    public function run(): void
    {
        ini_set('memory_limit', '-1');

        $alldata = Items::fromFile(storage_path('app/501-550k.json'));

        // Batch size for bulk insert
        $batchSize = 500; // Reduce batch size to avoid exceeding placeholder limits
        $applicationsToInsert = [];

        // DB::beginTransaction();  // Start a transaction

        foreach ($alldata as $singleData) {
            // Processing each data entry
            $singleData = json_decode(json_encode($singleData), true);

            $bank = Bank::firstOrCreate(['name' => $singleData['bankk'] ?? null]);
            $city = City::firstOrCreate(['name' => $singleData['dealercity'] ?? null]);
            $branch = Branch::firstOrCreate(['name' => $singleData['dealerbranch'] ?? null, 'city_id' => $city->id ?? null]);
            $vehicle = Vehicle::firstOrCreate(['name' => $singleData['interested'] ?? null]);
            $sourcee = Source::firstOrCreate(['name' => $singleData['sourcee'] ?? null]);
            $campaign = Campaign::firstOrCreate(['name' => $singleData['pagesub'] ?? null]);

            $mobile = formatInputNumber($singleData['mobile']);
            $first_name = $singleData['fname'];

            // Prepare customer data for batch insert
            $customer = Customer::firstOrCreate(
                ['mobile' => $mobile],
                [
                    'first_name' => $first_name,
                    'last_name' => $singleData['lname'] ?? null,
                    'email' => $singleData['email'] ?? null,
                    'city_id' => $city->id ?? null,
                    'bank_id' => $bank->id ?? null,
                    'national_id' => $singleData['nationalId'] ?? null,
                ]
            );

            // Prepare application data for batch insert
            $type = checkApplicationType($singleData['page']) ?? 'leads';
            $lead = [
                'customer_id' => $customer->id,
                'city_id' => $city->id ?? null,
                'branch_id' => $branch->id ?? null,
                'vehicle_id' => $vehicle->id ?? null,
                'source_id' => $sourcee->id ?? null,
                'campaign_id' => $campaign->id ?? null,
                'purchase_plan' => $singleData['intention'] ?? null,
                'monthly_salary' => $singleData['monthlysalary'] ?? null,
                'preferred_appointment_time' => $singleData['preferredtime'] ?? null,
                'request_date' => $singleData['requestdate'] ?? null,
                'type' => $type,
                'created_at' => $singleData['application_created'] ?? null,
                'updated_at' => $singleData['application_created'] ?? null,
                'apply_for' => $singleData['applyfor'] ?? null,
                'booking_reason' => $singleData['bookingreason'] ?? null,
                'booking_category' => $singleData['bookingcategory'] ?? null,
                'department' => $singleData['department'] ?? null,
                'title' => $singleData['title'] ?? null,
                'second_surname' => $singleData['second_surname'] ?? null,
                'zip_code' => $singleData['zip_code'] ?? null,
                'vin' => $singleData['vin'] ?? null,
                'yearr' => $singleData['yearr'] ?? null,
                'plateno' => $singleData['plateno'] ?? null,
                'plate_alphabets' => $singleData['platealphabets'] ?? null,
                'klmm' => $singleData['klmm'] ?? null,
                'intention' => $singleData['intention'] ?? null,
                'comments' => $singleData['comments'] ?? null,
                'sharingcv' => $singleData['sharingcv'] ?? null,
                'privacy_check' => $singleData['privacycheck'] ?? null,
                'marketingagreement' => $singleData['marketingagreement'] ?? null,
                'language' => $singleData['language'] ?? null,
                'company' => $singleData['company'] ?? null,
                'customers_type' => $singleData['customers_type'] ?? null,
                'number_of_vehicles' => $singleData['number_of_vehicles'] ?? null,
                'fleet_range' => $singleData['fleet_range'] ?? null,
                'is_sms_send' => 1, // Assuming you want to set this to 1 as per your original code
                'sync_genesys' => 1, // Same here, assuming you want it set to 1
                'category' => $singleData['crm_category'] ?? null,
                'sub_category' => $singleData['crm_sub_category'] ?? null,
                'kyc' => $singleData['kyc'] ?? null,
                'qualified_date' => $singleData['qualified_date'] ?? null,
                'dummy_applicationid' => $singleData['dummy_applicationid'] ?? 0,
            ];

            $applicationsToInsert[] = $lead;

            // Once batch size is reached, insert the data into the database
            if (count($applicationsToInsert) >= $batchSize) {
                Application::insert($applicationsToInsert);

                // Reset arrays after inserting
                $applicationsToInsert = [];
            }
        }

        // Insert remaining data if exists
        if (count($applicationsToInsert) > 0) {
            Application::insert($applicationsToInsert);
        }

        // DB::commit();  // Commit the transaction

        echo "Data import completed successfully!";
    }
}
