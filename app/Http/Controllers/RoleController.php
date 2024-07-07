<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use App\Models\User;
use DB;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:role-list', ['only' => ['index','show']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['roles'] = Role::whereNotIn('id',[1])->get();
        return view('admin.roles.index' ,$data);
    }

    public function create()
    {
        $permission = Permission::get();
        return view('admin.roles.add',compact('permission'));
    }


    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return Response(['result'=>'success','message'=>__('Added Successfully')]);
    }


    public function edit($id)
    {
        $role = Role::findorFail($id);
        $permission = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')
        ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
        ->where('role_has_permissions.role_id', $id)
        ->pluck('permissions.name','permissions.name')
        ->all();
        return view('admin.roles.edit',compact('role','permission','rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

         $role->syncPermissions($request->input('permission'));

         return Response(['result'=>'success','message'=>__('Updated Successfully')]);
    }

    public function destroy(string $id)
    {
        $role = Role::find($id);
        if ($role) {
            $role->delete();
        }

        return Response(['result'=>'success','message'=>__('Deleted Successfully')]);
    }

}
