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
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithValidation;


class SmoLeadsImport implements ToModel , WithHeadingRow, WithValidation
{

    use Importable;


    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name'  => 'required',
            // 'email'  => 'required',
            'mobile'  => 'required',
            'dealer_city'  => 'required',
            'vehicle'  => 'required',
            'channel'  => 'required',
        ];
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $mobile = $row['mobile'];

        $mobile =formatInputNumber($mobile);

        $customer = Customer::updateOrCreate(
            ['mobile' => $mobile],
            [
                'first_name' => $row['first_name'],
                'last_name'  => $row['last_name'],
                'email'      => $row['email'] ?? null,
            ]
        );


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
