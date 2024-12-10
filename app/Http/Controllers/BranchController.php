<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Support\Facades\Validator;
use App\Models\City;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:branch-list', ['only' => ['index','show']]);
        $this->middleware('permission:branch-create', ['only' => ['create','store']]);
        $this->middleware('permission:branch-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:branch-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.branch.branch_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gdata = getCommonData();
        $data['cities'] = $gdata['cities'];

        return view('admin.branch.branch_add' , $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $input = $request->all();
        $input['page_type'] = implode(',' , $request->page_type);
        $branch= Branch::create($input);

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
        $gdata = getCommonData();
        $data['cities'] = $gdata['cities'];
        $data['branch']= Branch::findorFail($id);

        return view('admin.branch.branch_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $row = Branch::findorFail($id);
        $input = $request->all();
        $input['page_type'] = implode(',' , $request->page_type);
        $row->update($input);

        return Response(['result'=>'success','message'=>__('Updated Successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $row = Branch::findorFail($id);

        if($row->applications()->count() > 0){
            return Response(['result'=>'error','message'=>__('Data for this branch already exists')]);
        }

        $row->delete();

        return Response(['result'=>'success','message'=>__('Deleted Successfully')]);
    }


    public function branchPagination()
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
        $countAll = Branch::count();

        //-- CREATE LARAVEL PAGINATION
        $paginate =  Branch::search($conditions)
                ->latest()
                ->orderBy($columnName, $columnSortOrder)
                ->paginate($limit, ["*"], 'page', $page);

        $num = 1;
        $items = array();
        foreach ($paginate->items() as $idx => $row) {

            $page_type = $row['page_type'] ?? ""; // Get the value or an empty string if not set
            $formattedPageType = implode(', ', array_map(function ($word) {
                return ucwords(str_replace('_', ' ', $word));
            }, explode(',', $page_type)));

            $items[] = array(
                "no" => $num,
                "id" => $row['id'],
                "status" => $row['status'],
                "name" => ucwords($row['name']),
                "city_id" => $row->city->name ?? "",
                "page_type" => $formattedPageType ?? "",
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
