<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use App\Employee;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all()->skip(1);
        Session::flash('status', 'All Admin Users ');

        return view('admin.users.indexusers',['users'=>$users]);
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->admin_role = $request->status;
        $user->save();

        return response()->json(['success'=>'Status change successfully.']);
    }

    public function allemployee(Request $request)
    {
        if($request->search)
        {

            $employee= Employee::where('f_name', 'like', "%$request->search%")
                ->orWhereRaw("concat(f_name, ' ', l_name) like '%$request->search%' ")
               ->orWhere('l_name', 'like', "$request->name");
               $employee= $employee->paginate(5);

            return view('admin.users.employee',['employee'=>$employee]);
        }
        $employee= Employee::paginate(5);

        return view('admin.users.employee',['employee'=>$employee]);
    }
}
