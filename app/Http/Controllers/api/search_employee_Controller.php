<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Traits\GeneralTrait;
use App\Employee;
use Validator;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;

class search_employee_Controller extends Controller
{
    use GeneralTrait;
    public function search_employee (Request $request)
    {
        $rules = [

            "name" => "string",
            'active'=>'in:"active","Not_active"',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        $employee = DB::table('employees')->select('*'); // maaking reference with all data to apply on refrence search with knowing with wich parameter
        if($request->status)
        {
            $employee->where('status','=',$request->status); //it comes first to fillter the all data which has not active
        }
        if($request->name && !$request->status)
        {
            $employee->where('f_name', 'like', "%$request->name%")
            ->orWhereRaw("concat(f_name, ' ', l_name) like '%$request->name%' ")
           ->orWhere('l_name', 'like', "$request->name");
        }
        if($request->name && $request->status)
        {
            $employee->where('f_name', 'like', "%$request->name%")
            ->orWhereRaw("concat(f_name, ' ', l_name) like '%$request->name%' ")->where('status','=',$request->status)
           ->orWhere('l_name', 'like', "$request->name");
        }

        $employee = $employee->paginate(3); // geting data by refrence by DB and making paginate with 4 only
        if($employee)
        {
            return $this->returnData('search_employee',$employee,'search done ');
        }else
        {
            return $this->returnError('s1010','something wrong happed');
        }

    }

    public function get_employee_data($id=null)
    {
        $employee= Employee::find($id);
        if($employee)
        {
            return $this->returnData('employee',$employee,'employee data get successfully');
        }else
        {
            return $this->returnError('s404','employee not found');
        }

    }
}
