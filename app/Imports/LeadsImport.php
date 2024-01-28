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

class LeadsImport implements ToModel ,  WithHeadingRow, WithValidation
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
            'dealer_branch'  => 'required',
            'vehicle'  => 'required',
            'purchase_plan'  => 'required',
            'prferred_time'  => 'required',
            'monthly_salary'  => 'required',
            'bank'  => 'required',
            'channel'  => 'required',
            'campaign'  => 'required',
            //'request_date'  => 'required',
            //'van_code'  => 'required|unique:vans,van_code',
        ];
    }

    public function model(array $row)
    {
        //dd($row,formateDate($row['request_date']));
        $bank = Bank::where('name', $row['bank'])->first();

        if(is_null($bank)){
            $bank = Bank::create(['name' =>  $row['bank'] ]);
        }


        $mobile = $row['mobile'];

        $mobile =formatInputNumber($mobile);

        $dateValue = $row['request_date'];

        $request_date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dateValue));

        //$request_date =$date->format('Y-m-d');

        $customer = Customer::whereMobile($mobile)->first();

        if(is_null($customer)){
            $customer =new Customer();
            $customer->first_name = $row['first_name'];
            $customer->last_name =  $row['last_name'];
            $customer->mobile = $mobile;
            $customer->email = $row['email'];
            $customer->bank_id = $bank->id;
            $customer->save();
        }

        $city = City::where('name', $row['dealer_city'])->first();
        $branch = Branch::where('name', $row['dealer_branch'])->first();
        $vehicle = Vehicle::where('name', $row['vehicle'])->first();
        $sourcee = Source::where('name', $row['channel'])->first();
        $campaign = Campaign::where('name', $row['campaign'])->first();
        if(is_null($city)){
            $city = City::create(['name' => $row['dealer_city']]);
        }
        if(is_null($branch)){
            $branch = Branch::create([
                'name' => $row['dealer_branch'],
                'city_id' => $city->id,
            ]);
        }
        if(is_null($vehicle)){
            $vehicle = Vehicle::create(['name' => $row['vehicle'] ]);
        }
        if(is_null($sourcee)){
            $sourcee = Source::create(['name' => $row['channel'] ]);
        }
        if(is_null($campaign)){
            $campaign = Campaign::create(['name' => $row['campaign'] ]);
        }

        $lead = new Application();
        $lead->city_id = $city->id;
        $lead->branch_id = $branch->id;
        $lead->vehicle_id = $vehicle->id;
        $lead->source_id = $sourcee->id;
        $lead->campaign_id = $campaign->id;
        $lead->purchase_plan = $row['purchase_plan'];
        $lead->monthly_salary = $row['monthly_salary'];
        $lead->preferred_appointment_time = $row['prferred_time'];
        $lead->request_date = formateDate($request_date) ?? null;
        $lead->customer_id= $customer->id;

        if (request()->has('select_date')) {
            // Assuming 'created_at' is in a format that Carbon can parse
            $date = Carbon::parse(request()->input('select_date'));
            // Concatenate the current time (H:i:s) to the date
            $dateWithCurrentTime = $date->format('Y-m-d') . ' ' . Carbon::now()->format('H:i:s');
            // Set the 'created_at' field
            $lead->created_at = $dateWithCurrentTime;
            $lead->type= 'old_leads';
        }else{

            $lead->type= 'leads';
        }

        $lead->save();

       // return $lead;

    }
}
