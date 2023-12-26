<?php

namespace App\Imports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\City;
use App\Models\Vehicle;
use App\Models\Source;
use App\Models\Customer;
use Carbon\Carbon;


class SmoLeadsImport implements ToModel , WithHeadingRow
{
    
    use Importable;
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $mobile = $row['mobile'];

        $mobile =formatInputNumber($mobile);

        $customer = Customer::whereMobile($mobile)->first();
      
        if(is_null($customer)){
            $customer =new Customer();
            $customer->first_name = $row['first_name'];
            $customer->last_name =  $row['last_name'];
            $customer->mobile = $mobile;
            $customer->save();
        }

        $city = City::where('name', $row['dealer_city'])->first();
        $vehicle = Vehicle::where('name', $row['vehicle'])->first();
        $sourcee = Source::where('name', $row['channel'])->first();
        if(is_null($city)){
            $city = City::create(['name' => $row['dealer_city']]);
        }
        if(is_null($vehicle)){
            $vehicle = Vehicle::create(['name' => $row['vehicle'] ]);
        }
        if(is_null($sourcee)){
            $sourcee = Source::create(['name' => $row['channel'] ]);
        }
        
        $smo_lead = new Application();
        $smo_lead->city_id = $city->id;
        $smo_lead->vehicle_id = $vehicle->id;
        $smo_lead->source_id = $sourcee->id;
        $smo_lead->customer_id= $customer->id;
        $smo_lead->type= 'smo_leads';
        $smo_lead->save();

       // return $lead;

    }
}
