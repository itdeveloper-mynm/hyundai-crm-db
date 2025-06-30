<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialData;
use Illuminate\Support\Facades\Validator;

class SocialDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:social-data-list', ['only' => ['index','show']]);
        $this->middleware('permission:social-data-create', ['only' => ['create','store']]);
        $this->middleware('permission:social-data-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:social-data-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        return view('admin.social-data.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.social-data.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        SocialData::storeData($request);

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

        $data['social_data'] = SocialData::findorFail($id);

        return view('admin.social-data.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        SocialData::updateData($request,$id);

        return Response(['result'=>'success','message'=>__('Updated Successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $row = SocialData::findorFail($id);
        $row->delete();

        return Response(['result'=>'success','message'=>__('Deleted Successfully')]);
    }


    public function socialDataPagination()
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
        //dd($conditions,$conditions['search']['value']);

        //-- WE MUST HAVE COUNT ALL RECORDS WITHOUT ANY FILTERS
        $countAll = SocialData::when(request('to'), function ($query) use ($conditions) {
            return  $query->where(function ($query) use ($conditions) {
                $startDate = $conditions['from'].' 00:00:00';
                $endDate = $conditions['to'].' 23:59:59';
                $query->whereBetween('created_at', [$startDate, $endDate]);
            });
        })->count();

        //-- CREATE LARAVEL PAGINATION
        $paginate =  SocialData::when(request('to'), function ($query) use ($conditions) {
                return  $query->where(function ($query) use ($conditions) {
                    $startDate = $conditions['from'].' 00:00:00';
                    $endDate = $conditions['to'].' 23:59:59';
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                });
            })
            ->orderBy($columnName, $columnSortOrder)
                ->paginate($limit, ["*"], 'page', $page);

        $num = 1;
        $items = array();
        foreach ($paginate->items() as $idx => $row) {

            $items[] = array(
                "no" => $num,
                "id" => $row['id'],
                "social_platform" => $row->social_platform,
                "total_visits" => $row->total_visits ?? 0,
                "page_views" => $row->page_views ?? 0,
                "unique_visitors" => $row->unique_visitors ?? 0,
                "followers" => $row->followers ?? 0,
                "likes" => $row->likes ?? 0,
                "tweets" => $row->tweets ?? 0,
                "priority" => $row->priority ?? 0,
                "created_at" => formateDate($row['created_at']),
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

