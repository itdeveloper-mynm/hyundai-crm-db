<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Vehicle;
use App\Models\Source;
use App\Models\Customer;
use App\Models\SmoLead;
use Illuminate\Support\Facades\Validator;
use App\Imports\SmoLeadsImport;
use Maatwebsite\Excel\Facades\Excel;

class SmoLeadController extends Controller
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
        return view('admin.smo_lead.smo_lead_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['cities']=City::whereStatus(1)->get();
        $data['vehicles']=Vehicle::whereStatus(1)->get();
        $data['sources']=Source::whereStatus(1)->get();
        return view('admin.smo_lead.smo_lead_add' , $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customer = addCustomer($request);

        $smo_lead = new SmoLead();
        $smo_lead->city_id = $request->input('city_id');
        $smo_lead->vehicle_id = $request->input('vehicle_id');
        $smo_lead->source_id = $request->input('source_id');
        $smo_lead->customer_id= $customer->id;
        $smo_lead->save();
        
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
        
        $data['smo_lead']= SmoLead::findorFail($id);
        $data['cities']=City::whereStatus(1)->get();
        $data['vehicles']=Vehicle::whereStatus(1)->get();
        $data['sources']=Source::whereStatus(1)->get();

        return view('admin.smo_lead.smo_lead_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $smo_lead = SmoLead::findorFail($id);
        
        $mobile = $request->input('mobile');
        $mobile =formatInputNumber($mobile);

        //dd($request->all(),$mobile);
        
        $customer = Customer::findorFail($smo_lead->customer_id);
        $customer->first_name = $request->input('first_name');
        $customer->last_name = $request->input('last_name');
        $customer->mobile = $mobile;
        $customer->email = $request->input('email');
        $customer->save();

        $smo_lead->city_id = $request->input('city_id');
        $smo_lead->vehicle_id = $request->input('vehicle_id');
        $smo_lead->source_id = $request->input('source_id');
        $smo_lead->customer_id= $customer->id;
        $smo_lead->save();

        return Response(['result'=>'success','message'=>__('Updated Successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $row = SmoLead::findorFail($id);
        $row->delete();
        
        return Response(['result'=>'success','message'=>__('Deleted Successfully')]);
    }

    
    public function smoLeadPagination()
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
        $countAll = SmoLead::count();

        //-- CREATE LARAVEL PAGINATION
        $paginate =  SmoLead::orderBy($columnName, $columnSortOrder)
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
                "source_id" => $row->source->name ?? "",
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

   public function smoLeadImport() {
        
    //dd(1);
    Excel::import(new SmoLeadsImport,request()->file('csvfile'));

    return Response(['result'=>'success','message'=>__('Smo Leads Import Successfully')]);
}

}
