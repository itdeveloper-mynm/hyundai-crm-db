<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:users-list', ['only' => ['index','show']]);
        $this->middleware('permission:users-create', ['only' => ['create','store']]);
        $this->middleware('permission:users-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:users-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['roles'] = Role::whereNotIn('name',['SuperAdmin'])->pluck('name','name')->all();
        return view('admin.users.add' ,$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'email' => 'required|unique:users,email',
        ]);

        if($validator->fails()){
            return Response(['result'=>'error','message'=> $validator->errors()->first() ]);
        }

        $password= Hash::make(request('password'));

        $user= new User();
        $user->name=request('name');
        $user->email=request('email');
        $user->password=$password;
        $user->save();
        $user->assignRole($request->input('roles'));

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
        $user= User::findOrFail($id);
        $roles = Role::where('name','!=','SuperAdmin')->pluck('name','name')->all();
        $userRole = $user?$user->roles->pluck('name','name')->all():"";

        return view('admin.users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       // dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => [ 'required','unique:users,email,'.$id],
            ]);

            if($validator->fails()){
                return Response(['result'=>'error','message'=> $validator->errors()->first() ]);
            }


            $user= User::findOrFail($id);

            if(!is_null(request('password'))){
                $password= Hash::make(request('password'));
                $user->password=$password;
            }
            $user->name=request('name');
            $user->email=request('email');
            $user->save();
            $user->assignRole($request->input('roles'));

            if($user){
                DB::table('model_has_roles')->where('model_id',$user->id)->delete();
                $user->assignRole($request->input('roles'));
            }

            return Response(['result'=>'success','message'=>__('Updated Successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $row = User::findorFail($id);
        $row->delete();

        return Response(['result'=>'success','message'=>__('Deleted Successfully')]);
    }



    public function usersPagination()
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

        //-- WE MUST HAVE COUNT ALL RECORDS WITHOUT ANY FILTERS
        $countAll = User::whereHas('roles', function ($query) {
            $query->where('name','!=','SuperAdmin');
        })->count();

        //-- CREATE LARAVEL PAGINATION
        $paginate =  User::whereHas('roles', function ($query) {
            $query->where('name','!=','SuperAdmin');
        })->paginate($limit, ["*"], 'page', $page);

        $num = 1;
        $items = array();
        foreach ($paginate->items() as $idx => $row) {

            $items[] = array(
                "no" => $num,
                "id" => $row['id'],
                "name" => ucwords($row->name),
                "email" => $row->email ?? "",
                "role" => $row->roles->first()->name ?? "",
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
}
