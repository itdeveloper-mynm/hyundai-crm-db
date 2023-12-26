<?php

namespace App\Imports;

use App\Models\Application;
use App\Models\Vehicle;
use App\Models\Campaign;
use App\Models\City;
use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsedCarsImport implements ToModel, WithHeadingRow
{
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
                $customer->email = $row['email'];
                $customer->save();
            }
    
            $city = City::where('name', $row['dealer_city'])->first();
            $vehicle = Vehicle::where('name', $row['vehicle'])->first();
            $campaign = Campaign::where('name', $row['campaign'])->first();
            if(is_null($city)){
                $city = City::create(['name' => $row['dealer_city']]);
            }
   
            if(is_null($vehicle)){
                $vehicle = Vehicle::create(['name' => $row['vehicle'] ]);
            }
            if(is_null($campaign)){
                $campaign = Campaign::create(['name' => $row['campaign'] ]);
            }
            
            $used_car = new Application();
            $used_car->city_id = $city->id;
            $used_car->vehicle_id = $vehicle->id;
            $used_car->campaign_id = $campaign->id;
            $used_car->customer_id= $customer->id;
            $used_car->preferred_appointment_time= $row['prferred_time'];
            $used_car->type= 'used_cars';
            $used_car->save();
    
    }
}
