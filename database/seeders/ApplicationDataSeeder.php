<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Models\City;
use App\Models\Branch;
use App\Models\Vehicle;
use App\Models\Source;
use App\Models\Campaign;
use App\Models\Application;
use App\Models\Customer;
use App\Models\Bank;
use Carbon\Carbon;
use JsonMachine\Items;

class ApplicationDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ini_set('memory_limit', '-1');
        // $json = File::get(storage_path('app/applications.json'));
        // $alldata = json_decode($json, true);
        $alldata = Items::fromFile(storage_path('app/451-500k.json'));


        foreach($alldata as $singleData){


                $bank = null;
                $city = null;
                $branch = null;
                $vehicle = null;
                $sourcee = null;
                $campaign = null;
                // $singleData = array($singleData);
                // $first_name_utf8 = mb_convert_encoding($singleData->fname, 'UTF-8', 'HTML-ENTITIES');

                $singleData = json_decode(json_encode($singleData), true);

                $optionalData = [
                    'bank' => $singleData['bankk'] ?? null,
                    'dealer_city' => $singleData['dealercity'] ?? null,
                    'dealer_branch' => $singleData['dealerbranch'] ?? null,
                    'vehicle' =>  $singleData['interested'] ?? null,
                    'channel' => $singleData['sourcee'] ?? null,
                    'campaign' => $singleData['pagesub'] ?? null,
                ];

                foreach ($optionalData as $key => $value) {
                    if ($value) {
                        switch ($key) {
                            case 'bank':
                                $bank = Bank::firstOrCreate(['name' => $value]);
                                break;
                            case 'dealer_city':
                                $city = City::firstOrCreate(['name' => $value]);
                                break;
                            case 'dealer_branch':
                                if ($city) {
                                    $branch = Branch::firstOrCreate(['name' => $value, 'city_id' => $city->id]);
                                }
                                break;
                            case 'vehicle':
                                $vehicle = Vehicle::firstOrCreate(['name' => $value]);
                                break;
                            case 'channel':
                                $sourcee = Source::firstOrCreate(['name' => $value]);
                                break;
                            case 'campaign':
                                $campaign = Campaign::firstOrCreate(['name' => $value]);
                                break;
                        }
                    }
                }

                $mobile = $singleData['mobile'];
                $mobile =formatInputNumber($mobile);


                // $first_name = decodeUnicode($singleData['fname']);
                $first_name = $singleData['fname'];

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


                $type= checkApplicationType($singleData['page']) ?? 'leads';

                $existingApplication = Application::where('dummy_applicationid', $singleData['dummy_applicationid'])->first();
                if ($existingApplication) {
                    echo $existingApplication->dummy_applicationid . "\n";
                    $lead = $existingApplication;
                }else{
                    $lead = new Application();
                }
                    $lead->customer_id= $customer->id;
                    $lead->city_id = $city->id ?? null;
                    $lead->branch_id = $branch->id ?? null;
                    $lead->vehicle_id = $vehicle->id ?? null;
                    $lead->source_id = $sourcee->id ?? null;
                    $lead->campaign_id = $campaign->id ?? null;
                    $lead->purchase_plan = $singleData['intention'] ?? null;
                    $lead->monthly_salary = $singleData['monthlysalary'] ?? null;
                    $lead->preferred_appointment_time = $singleData['preferredtime'] ?? null;
                    $lead->request_date = $singleData['requestdate'] ?? null;
                    $lead->type = $type;
                    $lead->created_at = $singleData['application_created'] ?? null;
                    $lead->updated_at = $singleData['application_created'] ?? null;
                    $lead->apply_for = $singleData['applyfor'] ?? null;
                    $lead->booking_reason = $singleData['bookingreason'] ?? null;
                    $lead->booking_category = $singleData['bookingcategory'] ?? null;
                    $lead->department = $singleData['department'] ?? null;
                    $lead->title = $singleData['title'] ?? null;
                    $lead->second_surname = $singleData['second_surname'] ?? null;
                    $lead->zip_code = $singleData['zip_code'] ?? null;
                    $lead->vin = $singleData['vin'] ?? null;
                    $lead->yearr = $singleData['yearr'] ?? null;
                    $lead->plateno = $singleData['plateno'] ?? null;
                    $lead->plate_alphabets = $singleData['platealphabets'] ?? null;
                    $lead->klmm = $singleData['klmm'] ?? null;
                    $lead->intention = $singleData['intention'] ?? null;
                    // $lead->preferred_time = $preferred_time ?? null;
                    $lead->comments = $singleData['comments'] ?? null;
                    $lead->sharingcv = $singleData['sharingcv'] ?? null;
                    $lead->privacy_check = $singleData['privacycheck'] ?? null;
                    $lead->marketingagreement = $singleData['marketingagreement'] ?? null;
                    $lead->language = $singleData['language'] ?? null;
                    $lead->company = $singleData['company'] ?? null;
                    $lead->customers_type = $singleData['customers_type'] ?? null;
                    $lead->number_of_vehicles = $singleData['number_of_vehicles'] ?? null;
                    $lead->fleet_range = $singleData['fleet_range'] ?? null;
                    $lead->is_sms_send = $singleData['is_sms_send'] ?? 0;
                    $lead->sync_genesys = $singleData['sync_genesys'] ?? 0;
                    $lead->category = $singleData['crm_category'] ?? null;
                    $lead->sub_category = $singleData['crm_sub_category'] ?? null;
                    $lead->kyc = $singleData['kyc'] ?? null;
                    $lead->qualified_date = $singleData['qualified_date'] ?? null;
                    $lead->dummy_applicationid = $singleData['dummy_applicationid'] ?? 0;

                    $lead->save();

                    echo $lead->dummy_applicationid . ' done' . "\n";


        }
    }
}
