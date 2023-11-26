<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Campaign;
use App\Models\City;
use App\Models\Lead;
use App\Models\Customer;
use App\Models\UsedCar;
use Illuminate\Support\Facades\Validator;

class UsedCarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.used_car.used_car_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['cities']=City::whereStatus(1)->get();
        $data['vehicles']=Vehicle::whereStatus(1)->get();
        $data['campaigns']=Campaign::whereStatus(1)->get();
        return view('admin.used_car.used_car_add' , $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mobile = $request->input('mobile');

        $mobile =formatInputNumber($mobile);

        //dd($request->all(),$mobile);
        
        $customer = Customer::whereEmail($request->input('email'))
        ->whereMobile($mobile)->first();
        if(is_null($customer)){
            $customer =new Customer();
            $customer->first_name = $request->input('first_name');
            $customer->last_name = $request->input('last_name');
            $customer->mobile = $mobile;
            $customer->email = $request->input('email');
            $customer->save();
        }

        $used_car = new UsedCar();
        $used_car->city_id = $request->input('city_id');
        $used_car->vehicle_id = $request->input('vehicle_id');
        $used_car->campaign_id = $request->input('campaign_id');
        $used_car->preferred_appointment_time = $request->input('preferred_appointment_time');
        $used_car->customer_id= $customer->id;
        $used_car->save();
        
        return Response(['result'=>'success','message'=>__('Added Successfully')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $data['used_car']= UsedCar::findorFail($id);
        $data['cities']=City::whereStatus(1)->get();
        $data['vehicles']=Vehicle::whereStatus(1)->get();
        $data['campaigns']=Campaign::whereStatus(1)->get();

        return view('admin.used_car.used_car_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $used_car = UsedCar::findorFail($id);
        
        $mobile = $request->input('mobile');
        $mobile =formatInputNumber($mobile);

        //dd($request->all(),$mobile);
        
        $customer = Customer::findorFail($used_car->customer_id);
        $customer->first_name = $request->input('first_name');
        $customer->last_name = $request->input('last_name');
        $customer->mobile = $mobile;
        $customer->email = $request->input('email');
        $customer->save();

        $used_car->city_id = $request->input('city_id');
        $used_car->vehicle_id = $request->input('vehicle_id');
        $used_car->campaign_id = $request->input('campaign_id');
        $used_car->preferred_appointment_time = $request->input('preferred_appointment_time');
        $used_car->customer_id= $customer->id;
        $used_car->save();

        return Response(['result'=>'success','message'=>__('Updated Successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $row = UsedCar::findorFail($id);
        $row->delete();
        
        return Response(['result'=>'success','message'=>__('Deleted Successfully')]);
    }

    
    public function usedCarPagination()
    {
        // -- START DEFAULT DATATABLE QUERY PARAMETER
        $draw = request('draw');
        $start = request('start');
        $length = request('length');
        $page = (int)$start > 0 ? ($start / $length) + 1 : 1;
        $limit = (int)$length > 0 ? $length : 10;
        $columnIndex = request('order')[0]['column']; // Column index
        $columnName = request('columns')[$columnIndex]['data']; // Column name
        $columnSortOrder = request('order')[0]['dir']; // asc or desc value
        $searchValue = request('search')['value']; // Search value from datatable
        //-- END DEFAULT DATATABLE QUERY PARAMETER

        //-- WE MUST HAVE COUNT ALL RECORDS WITHOUT ANY FILTERS
        $countAll = UsedCar::count();

        //-- CREATE LARAVEL PAGINATION
        $paginate =  UsedCar::orderBy($columnName, $columnSortOrder)
                 ->paginate($limit, ["*"], 'page', $page);
        
        $num = 1;
        $items = array();
        foreach ($paginate->items() as $idx => $row) {

            $items[] = array(
                "no" => $num,
                "id" => $row['id'],
                "first_name" => ucwords($row->customer->first_name),
                "last_name" => ucwords($row->customer->last_name),
                "city_id" => $row->city->name ?? "",
                "vehicle_id" => $row->vehicle->name ?? "",
                "campaign_id" => $row->campaign->name ?? "",
                "created_at" =>$row['created_at'],
            );
            $num++;
        }
        //-- START CREATE JSON RESPONSE FOR DATATABLES
        $response = array(
            "draw" => (int)$draw,
            "recordsTotal" => (int)$countAll,
            "recordsFiltered" => (int)$paginate->total(),
            "data" => $items,
        );
        return response()->json($response);
        //-- END CREATE JSON RESPONSE FOR DATATABLES
     
   }
}