<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Vehicle;
use App\Models\Source;
use App\Models\Customer;
use App\Models\Application;
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
        $data = getCommonData();
        return view('admin.smo_lead.smo_lead_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = getCommonData();
        return view('admin.smo_lead.smo_lead_add' , $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Application::storeData($request,'smo_leads');

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
        $data = getCommonData();
        $data['smo_lead']= Application::findorFail($id);

        return view('admin.smo_lead.smo_lead_edit', $data);
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
        $conditions = request()->all();

        //-- WE MUST HAVE COUNT ALL RECORDS WITHOUT ANY FILTERS
        $countAll = Application::search($conditions)->where('type','smo_leads')->count();

        //-- CREATE LARAVEL PAGINATION
        $paginate =  Application::search($conditions)
                ->where('type','smo_leads')
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

   public function smoLeadImport(){
        try {
            $import = new SmoLeadsImport();
            $import->import(request()->file('csvfile'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            foreach ($failures as $failure) {
                return Response(['result' => 'error', 'message' => $failure->errors()[0] . ' of row no ' . $failure->row()]);
            }
        }

        return Response(['result'=>'success','message'=>__('Smo Leads Import Successfully')]);
    }

}
