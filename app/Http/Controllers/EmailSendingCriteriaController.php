<?php

namespace App\Http\Controllers;

use App\Models\EmailSendingCriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use App\Models\User;
use DB;
use Validator;

class EmailSendingCriteriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:email-sending-criteria-list', ['only' => ['index','show']]);
        $this->middleware('permission:email-sending-criteria-create', ['only' => ['create','store']]);
        $this->middleware('permission:email-sending-criteria-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:email-sending-criteria-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['alldata'] = EmailSendingCriteria::get();
        return view('admin.email_sending_criteria.index' ,$data);
    }

    public function create()
    {
        $user_emails = DB::table('users')
        ->pluck('email','name')
        ->all();
        return view('admin.email_sending_criteria.add',compact('user_emails'));
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'type' => 'required|unique:email_sending_criterias,type',
        ]
        );
        if($validator->fails()){
            return Response(['result'=>'error','message'=>$validator->errors()->first()]);
        }

         EmailSendingCriteria::create([
            'header' => $request->input('header'),
            'body' => $request->input('body'),
            'type' => $request->input('type'),
            'emails' => implode(',',$request->input('emails')),
        ]);

        return Response(['result'=>'success','message'=>__('Added Successfully')]);
    }


    public function edit($id)
    {
        $row = EmailSendingCriteria::findorFail($id);
        $user_emails = DB::table('users')
        ->pluck('email','name')
        ->all();
        return view('admin.email_sending_criteria.edit',compact('user_emails','row'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'type' => 'required|unique:email_sending_criterias,type,'.$id,
        ]
        );
        if($validator->fails()){
            return Response(['result'=>'error','message'=>$validator->errors()->first()]);
        }

        $row = EmailSendingCriteria::findorFail($id);
        $row->update([
            'header' => $request->input('header'),
            'body' => $request->input('body'),
            'type' => $request->input('type'),
            'emails' => implode(',',$request->input('emails')),
        ]);

         return Response(['result'=>'success','message'=>__('Updated Successfully')]);
    }

    public function destroy(string $id)
    {
        $role = EmailSendingCriteria::find($id);
        if ($role) {
            $role->delete();
        }

        return Response(['result'=>'success','message'=>__('Deleted Successfully')]);
    }

}
