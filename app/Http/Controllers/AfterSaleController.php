<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Branch;
use App\Models\Vehicle;
use App\Models\Source;
use App\Models\Campaign;
use App\Models\Lead;
use App\Models\Customer;
use App\Models\AfterSale;
use Illuminate\Support\Facades\Validator;

class AfterSaleController extends Controller
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
        return view('admin.after_sale.after_sale_index');
    }


    public function create()
    {
        $data['cities']=City::whereStatus(1)->get();
        $data['branches']=Branch::whereStatus(1)->get();
        $data['vehicles']=Vehicle::whereStatus(1)->get();
        $data['sources']=Source::whereStatus(1)->get();
        $data['campaigns']=Campaign::whereStatus(1)->get();
        return view('admin.after_sale.after_sale_add' , $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customer = Customer::whereEmail($request->input('email'))
        ->whereMobile($request->input('mobile'))->first();
        if(is_null($customer)){
            $customer =new Customer();
            $customer->first_name = $request->input('first_name');
            $customer->last_name = $request->input('last_name');
            $customer->mobile = $request->input('mobile');
            $customer->email = $request->input('email');
            $customer->save();
        }

        $after_sale = new AfterSale();
        $after_sale->city_id = $request->input('city_id');
        $after_sale->branch_id = $request->input('branch_id');
        $after_sale->vehicle_id = $request->input('vehicle_id');
        $after_sale->source_id = $request->input('source_id');
        $after_sale->campaign_id = $request->input('campaign_id');
        $after_sale->customer_id= $customer->id;
        $after_sale->save();
        
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
        
        $data['after_sale']= AfterSale::findorFail($id);
        $data['cities']=City::whereStatus(1)->get();
        $data['branches']=Branch::whereStatus(1)->get();
        $data['vehicles']=Vehicle::whereStatus(1)->get();
        $data['sources']=Source::whereStatus(1)->get();
        $data['campaigns']=Campaign::whereStatus(1)->get();

        return view('admin.after_sale.after_sale_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $after_sale = AfterSale::findorFail($id);

        $customer = Customer::findorFail($after_sale->customer_id);
        $customer->first_name = $request->input('first_name');
        $customer->last_name = $request->input('last_name');
        $customer->mobile = $request->input('mobile');
        $customer->email = $request->input('email');
        $customer->save();

        $after_sale->city_id = $request->input('city_id');
        $after_sale->branch_id = $request->input('branch_id');
        $after_sale->vehicle_id = $request->input('vehicle_id');
        $after_sale->source_id = $request->input('source_id');
        $after_sale->campaign_id = $request->input('campaign_id');
        $after_sale->customer_id= $customer->id;
        $after_sale->save();
        
        return Response(['result'=>'success','message'=>__('Updated Successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $row = AfterSale::findorFail($id);
        $row->delete();
        
        return Response(['result'=>'success','message'=>__('Deleted Successfully')]);
    }

        
    public function afterSalePagination()
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
        $countAll = AfterSale::count();

        //-- CREATE LARAVEL PAGINATION
        $paginate =  AfterSale::orderBy($columnName, $columnSortOrder)
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
                "branch_id" => $row->branch->name ?? "",
                "vehicle_id" => $row->vehicle->name ?? "",
                "source_id" => $row->source->name ?? "",
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
