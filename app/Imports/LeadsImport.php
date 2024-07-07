<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\City;
use App\Models\Branch;
use App\Models\Vehicle;
use App\Models\Source;
use App\Models\Campaign;
use App\Models\Customer;
use App\Models\Bank;
use App\Models\Application;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class LeadsImport implements ToModel ,  WithHeadingRow, WithBatchInserts, WithChunkReading
{

    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function rules(): array
    {
        return [
            'dealer_city' => 'required',
            //'dealer_branch'  => 'required',
            //'vehicle'  => 'required',
            //'purchase_plan'  => 'required',
            'prferred_time'  => 'required',
            'monthly_salary'  => 'required',
            //'bank'  => 'required',
            //'channel'  => 'required',
            //'campaign'  => 'required',
            //'request_date'  => 'required',
            //'van_code'  => 'required|unique:vans,van_code',
        ];
    }

    public function model(array $row)
    {
        ini_set('memory_limit',-1);
        ini_set('max_execution_time',-1);

        $bank = null;
        $city = null;
        $branch = null;
        $vehicle = null;
        $source = null;
        $campaign = null;

        // Collect data that can be null safely
        $optionalData = [
            'bank' => $row['bank'] ?? null,
            'dealer_city' => $row['dealer_city'] ?? null,
            'dealer_branch' => $row['dealer_branch'] ?? null,
            'vehicle' => $row['vehicle'] ?? null,
            'channel' => $row['channel'] ?? null,
            'campaign' => $row['campaign'] ?? null,
        ];

        // Fetch or create related models in one go
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
                        $source = Source::firstOrCreate(['name' => $value]);
                        break;
                    case 'campaign':
                        $campaign = Campaign::firstOrCreate(['name' => $value]);
                        break;
                }
            }
        }

        $mobile = formatInputNumber($row['mobile']);
        if(isset($row['request_date'])){
            $request_date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['request_date']));
        }else{
            $request_date = null;
        }

        $customer = Customer::firstOrCreate(
            ['mobile' => $mobile],
            [
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'email' => $row['email'] ?? null,
                'national_id' => $row['national_id'] ?? null,
                'bank_id' => $bank->id ?? null,
            ]
        );

        $lead = new Application();
        $lead->city_id = $city->id ?? null;
        $lead->branch_id = $branch->id ?? null;
        $lead->vehicle_id = $vehicle->id ?? null;
        $lead->source_id = $source->id ?? null;
        $lead->campaign_id = $campaign->id ?? null;
        $lead->purchase_plan = $row['purchase_plan'] ?? null;
        $lead->monthly_salary = $row['monthly_salary'] ?? null;
        $lead->preferred_appointment_time = $row['prferred_time'] ?? null;
        $lead->request_date = formateDate($request_date) ?? null;
        $lead->customer_id = $customer->id;
        $lead->type = isset($row['data_type']) ? checkApplicationType($row['data_type']) : 'leads';

        if (request()->has('select_date')) {
            $date = Carbon::parse(request()->input('select_date'));
            $lead->created_at = $date->format('Y-m-d') . ' ' . Carbon::now()->format('H:i:s');
            $lead->type = 'old_leads';
        } elseif (isset($row['request_date'])) {
            //dd(formateDate($request_date) . ' ' . Carbon::now()->format('H:i:s'));
            $lead->created_at = formateDate($request_date) . ' ' . Carbon::now()->format('H:i:s');
        }

        $lead->save();
    }



    public function batchSize(): int
    {
        return 3000;
    }

    public function chunkSize(): int
    {
        return 3000;
    }
}
