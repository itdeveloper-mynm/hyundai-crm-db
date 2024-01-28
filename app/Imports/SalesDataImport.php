<?php

namespace App\Imports;

use App\Models\SalesData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithValidation;

class SalesDataImport implements ToModel , WithHeadingRow, WithValidation
{
    use Importable;

    public function rules(): array
    {
        return [
            'inv_date' => 'required',
            'year'  => 'required',
            's'  => 'required',
            'chass'  => 'required',
            'model'  => 'required',
            'mobile'  => 'required',
            'customer_name'  => 'required',
            'gender'  => 'required',
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

        $dateValue = $row['inv_date'];

        $inv_date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dateValue));

        $model = ucfirst(strtolower($row['model']));
        $vehicle = Vehicle::where('name', $model)->first();
        if(is_null($vehicle)){
            $vehicle = Vehicle::create(['name' => $model ]);
        }

        $mobile = $row['mobile'];
        $mobile =formatInputNumber($mobile);
        $customer = Customer::whereMobile($mobile)->first();
        if(is_null($customer)){
            $customer =new Customer();
        }
            $customer->first_name = $row['customer_name'];
            $customer->mobile = $mobile;
            $customer->gender = $row['gender'];
            $customer->save();

            return new SalesData([
                'customer_id' => $customer->id,
                'inv_date' => $inv_date,
                'year' => $row['year'],
                's' => $row['s'],
                'chass' => $row['chass'],
                'vehicle_id' => $vehicle->id,
                'department' => request('department'),
                // Add other columns as needed
            ]);
    }
}
