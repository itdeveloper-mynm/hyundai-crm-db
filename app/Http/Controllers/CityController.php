<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Branch;
use App\Models\Vehicle;
use App\Models\Source;
use App\Models\Campaign;
use App\Models\Bank;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:city-list', ['only' => ['index','show']]);
        $this->middleware('permission:city-create', ['only' => ['create','store']]);
        $this->middleware('permission:city-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:city-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.city.city_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.city.city_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $city= City::create($request->all());

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
        $data['city']= City::findorFail($id);
        return view('admin.city.city_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $row = City::findorFail($id);
        $row->update($request->all());

        return Response(['result'=>'success','message'=>__('Updated Successfully')]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $row = City::findorFail($id);

        if($row->applications()->count() > 0){
            return Response(['result'=>'error','message'=>__('Data for this city already exists')]);
        }

        $row->delete();

        return Response(['result'=>'success','message'=>__('Deleted Successfully')]);
    }

    public function cityPagination()
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
        $countAll = City::count();

        //-- CREATE LARAVEL PAGINATION
        $paginate =  City::search($conditions)
                ->latest()
                ->orderBy($columnName, $columnSortOrder)
                ->paginate($limit, ["*"], 'page', $page);

        $num = 1;
        $items = array();
        foreach ($paginate->items() as $idx => $row) {

            $items[] = array(
                "no" => $num,
                "id" => $row['id'],
                "status" => $row['status'],
                "name" => ucwords($row['name']),
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

   function changeStatus(Request $request) {

        $id= $request->id;
        $className= $request->className;
        if($className=='City'){
            $row = City::findorFail($id);
        }
        if($className=='Branch'){
            $row = Branch::findorFail($id);
        }
        if($className=='Vehicle'){
            $row = Vehicle::findorFail($id);
        }
        if($className=='Source'){
            $row = Source::findorFail($id);
        }
        if($className=='Campaign'){
            $row = Campaign::findorFail($id);
        }
        if($className=='Bank'){
            $row = Bank::findorFail($id);
        }
        $row->status= $request->status_id;
        $row->save();

        return Response(['result'=>'success','message'=>__('Status Updated Successfully')]);
   }

   public function checkNameExist(Request $request)
   {
        //dd($request->all());

        //$field_name= 'name';
        $field_name= $request->fieldName ?? 'name';
        $table_name=$request->tableName;
        $input = request()->all();
        if($field_name == 'mobile'){
            $input['mobile'] = formatInputNumber($input['mobile']);
        }
        //dd($input);
        if(request('check')==0){
            $validator = Validator::make($input,
            [
                //'name' => 'unique:cities,name',
                 $field_name => 'unique:'.$table_name.','.$field_name.'',
            ]);
        }
        if(request('check')!=0){
            $id=request('check');
            $validator = Validator::make($input,
            [
                //'name' => 'unique:cities,name,'.$id,
                $field_name => 'unique:'.$table_name.','.$field_name.','.$id,
            ]);
        }

        if($validator->fails() == false)
        { echo 'true';}
        else
        {echo 'false';}
   }

}
