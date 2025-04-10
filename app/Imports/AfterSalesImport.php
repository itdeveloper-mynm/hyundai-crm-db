<?php

namespace App\Imports;

use App\Models\Application;
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
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithValidation;

class AfterSalesImport implements  ToModel , WithHeadingRow, WithValidation
{

    use Importable;

    public function __construct()
    {
        // Skip tracking for the entire import process
        Application::skipTracking(true);
    }


    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'  => 'required',
            'mobile'  => 'required',
            'dealer_city'  => 'required',
            'dealer_branch'  => 'required',
            'vehicle'  => 'required',
            'source'  => 'required',
            'campaign'  => 'required',
            //'request_date'  => 'required',
            //'van_code'  => 'required|unique:vans,van_code',
        ];
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

    // $dateValue = $row['request_date'];

    //     $date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dateValue));

    //     dd($row,$date->format('Y-m-d'));

        $mobile = $row['mobile'];

        $mobile =formatInputNumber($mobile);

        $customer = Customer::whereMobile($mobile)->first();

        if(is_null($customer)){
            $customer =new Customer();
            $customer->first_name = $row['first_name'];
            $customer->last_name =  $row['last_name'];
            $customer->mobile = $mobile;
            $customer->email = $row['email'];
            $customer->save();
        }

        $currentDate = Carbon::now();
        $currentYear = $currentDate->year;
        $currentMonth = $currentDate->month;

        $existingApplication = Application::where('customer_id', $customer->id)
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->first();

        if ($existingApplication) {
            return null;
        }


        if(isset($row['creation_date'])){
            $request_date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['creation_date']));
        }else{
            $request_date = null;
        }

        $city = City::where('name', $row['dealer_city'])->first();
        $branch = Branch::where('name', $row['dealer_branch'])->first();
        $vehicle = Vehicle::where('name', $row['vehicle'])->first();
        $sourcee = Source::where('name', $row['source'])->first();
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
            $sourcee = Source::create(['name' => $row['source'] ]);
        }
        if(is_null($campaign)){
            $campaign = Campaign::create(['name' => $row['campaign'] ]);
        }

        $after_sale = new Application();
        $after_sale->city_id = $city->id;
        $after_sale->branch_id = $branch->id;
        $after_sale->vehicle_id = $vehicle->id;
        $after_sale->source_id = $sourcee->id;
        $after_sale->campaign_id = $campaign->id;
        $after_sale->customer_id= $customer->id;
        $after_sale->type= 'service_offers';
        if (isset($row['creation_date'])) {
            $after_sale->created_at = formateDate($request_date) . ' ' . Carbon::now()->format('H:i:s');
        }
        $after_sale->save();

       // return $lead;

    }

}
