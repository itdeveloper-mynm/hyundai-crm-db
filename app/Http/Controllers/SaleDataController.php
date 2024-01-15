<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\SalesDataImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SalesData;

class SaleDataController extends Controller
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
        $data = getCommonData();

        return view('admin.sales-data.index' , $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        SalesData::storeData($request);

        return Response(['result'=>'success','message'=>__('Added Successfully')]);
    }

    public function edit(string $id)
    {
        $data = getCommonData();

        $sales_data = SalesData::findorFail($id);
        $data['sales_data'] = $sales_data;


        return view('admin.sales-data.edit', $data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        SalesData::updateData($request,$id);

        return Response(['result'=>'success','message'=>__('Updated Successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $row = SalesData::findorFail($id);
        $row->delete();

        return Response(['result'=>'success','message'=>__('Deleted Successfully')]);
    }


    public function salesDataPagination()
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
        $conditions = request()->all();
        //-- END DEFAULT DATATABLE QUERY PARAMETER
        $conditions = request()->all();

        //-- WE MUST HAVE COUNT ALL RECORDS WITHOUT ANY FILTERS
        $countAll = SalesData::count();

        //-- CREATE LARAVEL PAGINATION
        $paginate =  SalesData::search($conditions)
                ->orderBy($columnName, $columnSortOrder)
                ->paginate($limit, ["*"], 'page', $page);

        $num = 1;
        $items = array();
        foreach ($paginate->items() as $idx => $row) {
            $items[] = array(
                "no" => $num,
                "id" => $row['id'],
                "first_name" => ucwords($row->customer->first_name),
                "mobile" => $row->customer->mobile ?? null,
                "gender" => $row->customer->gender ?? null,
                "inv_date" => $row->inv_date ?? "",
                "year" => $row->year ?? "",
                "s" => $row->s ?? "",
                "chass" => $row->chass ?? "",
                "vechile_id" => $row->vehicle->name ?? "",
                "department" => $row->department ?? "",
                "created_at" => formateDateTime($row['created_at']),
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



    public function saleDataImport () {

        Excel::import(new SalesDataImport,request()->file('csvfile'));
        return Response(['result'=>'success','message'=>__('Sales Data Import Successfully')]);

    }

}
