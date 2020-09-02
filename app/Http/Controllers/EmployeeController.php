<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\classes\SaveImage;
use Session;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Auth::user()->user_employees()->latest()->get();
            return DataTables::of($data)

                    ->addColumn('action', function($data){
                        $button = '&nbsp;&nbsp;&nbsp;<button type="button" name="location" id="'.$data->id.'"  lat="'.$data->location_lat.'" lng="'.$data->location_lng.'"  class="location btn btn-info btn-sm">Location</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';

                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.employee.base');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $x= new SaveImage();
        $x->get_img_path();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'f_name'    =>  'required|string|max:155',
            'l_name'     =>  'required|string|max:155',
            'job'     =>  'required|string|max:250',
            'image'=>'required|image',
            'active'=>'in:"true","false"',

        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all(),'dat'=>$request->all()]);
        }

        $form_data = array(
            'f_name'        =>  $request->f_name,
            'l_name'         =>  $request->l_name,
            'job'        =>  $request->job,
            'location_lat'=> $request->location_lat,
            'location_lng'=>$request->location_lat

        );
        if($request->active == 'true')
        {
         $form_data['status']='active';
        }else{
            $form_data['status']='Not_active';
        }
        if ($files = $request->file('image'))
        {
            $img= new SaveImage();
            $img=$img->get_img_path($files);
            $form_data['image']= $img;

        }
        Auth::user()->user_employees()->create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit( $employee)
    {
        if($employee=Auth::user()->user_employees()->find($employee))
        return response()->json(['status'=>true,'data'=>$employee]);
        return response()->json(['status'=>false,'errors'=>['employer not foun in your account please create one ']]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $rules = array(
            'f_name'    =>  'required|string|max:155',
            'l_name'     =>  'required|string|max:155',
            'job'     =>  'required|string|max:250',
            'image'=>'image',
            'active'=>'in:"true","false"',

        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all(),'dat'=>$request->active]);
        }

        $form_data = array(
            'f_name'        =>  $request->f_name,
            'l_name'         =>  $request->l_name,
            'job'        =>  $request->job,
            'location_lat'=> $request->location_lat,
            'location_lng'=>$request->location_lat

        );
        if($request->active == 'true')
        {

         $form_data['status']='active';
        }else{
            $form_data['status']='Not_active';
        }
        if ($files = $request->file('image'))
        {
            $img= new SaveImage();
            $img=$img->get_img_path($files);
            $form_data['image']= $img;

        }
        $employee->update($form_data);

        return response()->json(['success' => 'Data Updated successfully.','ss'=>$request->active=='true']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy( $employee)
    {
        $data = Employee::find($employee);
        if($data)
        {
                    $data->delete();
                     return response()->json(['status'=>true]);

        }else{
            return response()->json(['status'=>false]);

        }
    }
    public function destroysuper( $employee)
    {
        $data = Employee::find($employee);
        if($data)
        {
                    $data->delete();
                    Session::flash('status', 'Deleted!');

                    return redirect(route('allemployee'));

        }else{
            Session::flash('status', 'something went wrong!');

            return redirect(route('allemployee'));

        }
    }
    protected function save_image()
    {

    }
}
