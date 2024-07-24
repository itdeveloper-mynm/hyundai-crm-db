<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Source;
use Illuminate\Support\Facades\Validator;

class SourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:source-list', ['only' => ['index','show']]);
        $this->middleware('permission:source-create', ['only' => ['create','store']]);
        $this->middleware('permission:source-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:source-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.source.source_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.source.source_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $branch= Source::create($request->all());

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
        $data['source']= Source::findorFail($id);
        return view('admin.source.source_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $row = Source::findorFail($id);
        $row->update($request->all());

        return Response(['result'=>'success','message'=>__('Updated Successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $row = Source::findorFail($id);

        if($row->applications()->count() > 0){
            return Response(['result'=>'error','message'=>__('Data for this source already exists')]);
        }

        $row->delete();

        return Response(['result'=>'success','message'=>__('Deleted Successfully')]);
    }


    public function sourcePagination()
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
        $countAll = Source::count();

        //-- CREATE LARAVEL PAGINATION
        $paginate =  Source::search($conditions)
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
                "created_at" => dateTimeformat($row['created_at']),
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
