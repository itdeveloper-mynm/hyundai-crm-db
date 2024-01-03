<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Branch;
use App\Models\Vehicle;
use App\Models\Source;
use App\Models\Campaign;
use App\Models\Customer;
use App\Models\Application;
use Illuminate\Support\Facades\Validator;
use App\Imports\AfterSalesImport;
use Maatwebsite\Excel\Facades\Excel;

class AfterSaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function getCommonData($cityId = null)
    {
        $commonData = [
            'cities' => City::whereStatus(1)->get(),
            'vehicles' => Vehicle::whereStatus(1)->get(),
            'sources' => Source::whereStatus(1)->get(),
            'campaigns' => Campaign::whereStatus(1)->get(),
        ];

        if ($cityId !== null) {
            $commonData['branches'] = Branch::where('city_id', $cityId)->whereStatus(1)->get();
        } else {
            $commonData['branches'] = Branch::whereStatus(1)->get();
        }

        return $commonData;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->getCommonData();
        return view('admin.after_sale.after_sale_index', $data);
    }


    public function create()
    {
        $data = $this->getCommonData();
        return view('admin.after_sale.after_sale_add' , $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Application::storeData($request,'after_sales');

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
        $after_sale= Application::findorFail($id);
        $data =$this->getCommonData($after_sale->city_id);
        $data['after_sale'] = $after_sale;

        return view('admin.after_sale.after_sale_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        Application::updateData($request,$id);

        return Response(['result'=>'success','message'=>__('Updated Successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $row = Application::findorFail($id);
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
        $conditions = request()->all();

        //-- WE MUST HAVE COUNT ALL RECORDS WITHOUT ANY FILTERS
        $countAll = Application::where('type','after_sales')->count();

        //-- CREATE LARAVEL PAGINATION
        $paginate =  Application::search($conditions)
                ->where('type','after_sales')
                ->orderBy($columnName, $columnSortOrder)
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


    public function afterSaleImport() {
        //dd(1);
        Excel::import(new AfterSalesImport,request()->file('csvfile'));

        return Response(['result'=>'success','message'=>__('After Sales Import Successfully')]);
    }

}
