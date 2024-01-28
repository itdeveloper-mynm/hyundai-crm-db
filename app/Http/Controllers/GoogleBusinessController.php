<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\GoogleBusiness;
use App\Models\City;
use App\Models\Branch;
use App\Imports\GoogleBusinessImport;
use Maatwebsite\Excel\Facades\Excel;

class GoogleBusinessController extends Controller
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
        $data['cities']=City::whereStatus(1)->get();
        return view('admin.google_business.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $data['row'] = GoogleBusiness::findorFail($id);
        $data['cities']=City::whereStatus(1)->get();
        $data['branches']=Branch::where('city_id',$data['row']->city_id)->whereStatus(1)->get();

        return view('admin.google_business.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $row = GoogleBusiness::findorFail($id);
        $row->update([
            'city_id' => request('city_id'),
            'branch_id' => request('branch_id'),
            'gtype' => request('gtype'),
            'month' => request('month'),
            'year' => request('year'),
            'greviews' => request('greviews') ?? 0,
            'greplied' => request('greplied') ?? 0,
            'gsearchlisting' => request('gsearchlisting') ?? 0,
            'gmapslisting' => request('gmapslisting') ?? 0,
            'gwebsite' => request('gwebsite') ?? 0,
            'gdirection' => request('gdirection') ?? 0,
            'gcalls' => request('gcalls') ?? 0,
        ]);

        return Response(['result'=>'success','message'=>__('Updated Successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $row = GoogleBusiness::findorFail($id);
        $row->delete();

        return Response(['result'=>'success','message'=>__('Deleted Successfully')]);
    }

    public function googleBusinessPagination()
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
        $countAll = GoogleBusiness::count();

        //-- CREATE LARAVEL PAGINATION
        $paginate =  GoogleBusiness::when(request('city_id'), function ($q){
                                        $q->where('city_id', request('city_id'));
                                    })
                                    ->when(request('branch_id'), function ($q) {
                                        $q->where('branch_id', request('branch_id'));
                                    })
                                    ->orderBy($columnName, $columnSortOrder)
                                    ->paginate($limit, ["*"], 'page', $page);

        $num = 1;
        $items = array();
        foreach ($paginate->items() as $idx => $row) {

            $items[] = array(
                "no" => $num,
                "id" => $row['id'],
                "city_id" => $row->city->name ?? "",
                "branch_id" => $row->branch->name ?? "",
                "greviews" => $row->greviews ?? 0,
                "greplied" => $row->greplied ?? 0,
                "gsearchlisting" => $row->gsearchlisting ?? 0,
                "gsearchlisting" => $row->gsearchlisting ?? 0,
                "gmapslisting" => $row->gmapslisting ?? 0,
                "gwebsite" => $row->gwebsite ?? 0,
                "gdirection" => $row->gwebsite ?? 0,
                "gcalls" => $row->gcalls ?? 0,
                "gtype" => $row->gtype ?? "",
                "gdate" => $row->month ." ". $row->year,
                //"created_at" =>$row['created_at'],
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

   public function getCityBranches($city) {

        // Perform logic to fetch branches based on the selected city
        $branches = Branch::where('city_id', $city)->get();

        // Return the branches as JSON
        return response()->json($branches);

   }

   public function googleBusinessImport() {
        try {
            $import = new GoogleBusinessImport();
            $import->import(request()->file('csvfile'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            foreach ($failures as $failure) {
                return Response(['result' => 'error', 'message' => $failure->errors()[0] . ' of row no ' . $failure->row()]);
            }
        }

        return Response(['result'=>'success','message'=>__('Google Business data imported successfully')]);
    }


}
