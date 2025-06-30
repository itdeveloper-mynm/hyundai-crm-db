<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\City;
use App\Models\Branch;
use App\Models\Vehicle;
use App\Models\Source;
use App\Models\Customer;
use App\Models\Bank;
use App\Models\CrmLead;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithValidation;

class CrmLeadsImport implements ToModel ,  WithHeadingRow, WithValidation
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
            'source'  => 'required',
            //'request_date'  => 'required',
            //'van_code'  => 'required|unique:vans,van_code',
        ];
    }

    public function model(array $row)
    {
        $bank = Bank::where('name', $row['bank'])->first();

        if(is_null($bank)){
            $bank = Bank::create(['name' =>  $row['bank'] ]);
        }


        $mobile = $row['mobile'];

        $mobile =formatInputNumber($mobile);

        $customer = Customer::whereMobile($mobile)->first();

        if(is_null($customer)){
            $customer =new Customer();
            $customer->first_name = $row['first_name'];
            $customer->last_name =  $row['last_name'];
            $customer->mobile = $mobile;
            $customer->email = $row['email'];
            $customer->bank_id = $bank->id;
            $customer->gender = row['gender'] ?? null;
            $customer->national_id = $row['national_id'] ?? null;
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

        $city = City::where('name', $row['dealer_city'])->first();
        $branch = Branch::where('name', $row['dealer_branch'])->first();
        $vehicle = Vehicle::where('name', $row['vehicle'])->first();
        $sourcee = Source::where('name', $row['source'])->first();
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

        $lead = new CrmLead();
        $lead->city_id = $city->id;
        $lead->branch_id = $branch->id;
        $lead->vehicle_id = $vehicle->id;
        $lead->source_id = $sourcee->id;
        $lead->purchase_plan = $row['purchase_plan'];
        $lead->monthly_salary = $row['monthly_salary'];
        $lead->preferred_appointment_time = $row['prferred_time'];
        $lead->kyc = $row['kyc'];
        $lead->category = $row['category'];
        $lead->sub_category = $row['sub_category'];
        $lead->yearr = $row['year'];
        $lead->customer_id= $customer->id;

        $lead->save();

       // return $lead;

    }
}
