<?php

namespace App\Http\Controllers\Backend\UserModule\Doctor;

use App\Http\Controllers\Controller;
use App\Models\AppoinmentModule\Charge;
use App\Models\UserModule\Day;
use App\Models\UserModule\Doctor;
use App\Models\UserModule\DoctorDay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    //index funciton start
    public function index(){
        if( can("doctor") ){
            return view("backend.modules.user_module.doctor.index");
        }
        else{
            return view("errors.404");
        }
    }   
    //index funciton end


    //view data
    public function data(){
        if( can('doctor') ){
            $doctor = Doctor::select("id","doctor_id","name","phone","is_active","image")->get();

            return DataTables::of($doctor)
            ->rawColumns(['action','image','is_active'])
            ->editColumn('is_active', function (Doctor $doctor) {
                if ($doctor->is_active == true) {
                    return '<p class="badge badge-success">Active</p>';
                } else {
                    return '<p class="badge badge-danger">Inactive</p>';
                }
            })
            ->editColumn('image', function(Doctor $doctor){
                if( $doctor->image == null ){
                    $src = asset("images/profile/user.png");
                }
                else{
                    $src = asset("images/profile/doctor/".$doctor->image);
                } 
                return "<img src='$src' width='50px' style='border-radius: 100%'>";
            })
            
            ->addColumn('action', function (Doctor $doctor) {
                return '
                <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown'.$doctor->id.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdown'.$doctor->id.'">
                
                    '.( can("view_doctor") ? '
                    <a class="dropdown-item" href="#" data-content="'.route('doctor.view.modal',$doctor->id).'" data-target="#largeModal" data-toggle="modal">
                        <i class="fas fa-eye"></i>
                        View Doctor
                    </a>
                    ': '') .'

                    '.( can("doctor_reset_password") ? '
                    <a class="dropdown-item" href="#" data-content="'.route('doctor.reset.modal',$doctor->id).'" data-target="#myModal" data-toggle="modal">
                        <i class="fas fa-key"></i>
                        Reset Password
                    </a>
                    ': '') .'

                    '.( can("edit_doctor") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('doctor.edit',$doctor->id).'" data-target="#largeModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-edit"></i>
                            Edit Doctor
                        </a>
                        ': '') .'

                ';
            })
            ->make(true);
        }else{
            return view("errors.404");
        }
        
    }

    //add_modal funciton start
    public function add_modal(){
        if( can("add_doctor") ){
            $days = Day::orderBy("id","asc")->select("id","name")->get();
            $charges = Charge::where("is_active",true)->select("id","type")->get();
            return view("backend.modules.user_module.doctor.modals.add", compact("days","charges"));
        }
        else{
            return view("errors.404");
        }
    }   
    //add_modal funciton end

    //add doctor start
    public function add(Request $request){

        if( can('add_doctor') ){
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'charge_id' => 'required',
                'designation' => 'required',
                'chamber' => 'required',
                'location' => 'required',
                'email' => 'required|unique:doctors,email,',
                'phone' => 'required|numeric|regex:/(01)[0-9]{9}/|unique:doctors,phone,',
                'password' => 'required|confirmed',
                'gender' => 'required',
                'in' => 'required',
                'out' => 'required',
                'day_id' => 'required',
                'degree' => 'required',
            ]);
            

           if( $validator->fails() ){
               return response()->json(['errors' => $validator->errors()] ,422);
           }else{
                try{
                    $doctor = new Doctor();
                    $doctor->doctor_id = "D-" . rand(000000,999999);
                    $doctor->name = $request->name;
                    $doctor->charge_id = $request->charge_id;
                    $doctor->designation = $request->designation;
                    $doctor->chamber = $request->chamber;
                    $doctor->location = $request->location;
                    $doctor->email  = $request->email;
                    $doctor->phone = $request->phone;
                    $doctor->gender = $request->gender;
                    $doctor->degree = $request->degree;
                    $doctor->speciality = $request->speciality ?? null;
                    $doctor->nid = $request->nid ?? null;
                    $doctor->in = $request->in;
                    $doctor->out = $request->out;
                    $doctor->is_available = true;
                    $doctor->is_active      = true;
                    $doctor->password = Hash::make($request->password);

                    $doctor->month   = Carbon::now()->month ;
                    $doctor->year   = Carbon::now()->year ;
                
                    if( $doctor->save() ){

                        foreach( $request['day_id'] as $day_id ){
                            $doctor_day = new DoctorDay();
                            $doctor_day->doctor_id = $doctor->id;
                            $doctor_day->day_id = $day_id;
                            $doctor_day->save();
                        }

                        return response()->json(['success' => 'New Doctor Created Successfully'], 200);
                    }

                }catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
           }
        }else{
            return view("errors.404");
        }
    }

    //add doctor end

    //doctor edit modal start
     public function edit($id){
        if( can("edit_doctor") ){
            $doctor = Doctor::where("id",$id)->first();
            $days = Day::orderBy("id","asc")->whereNotIn("id",$doctor->day->pluck("day_id"))->select("id","name")->get();
            $selected_days = Day::orderBy("id","asc")->whereIn("id",$doctor->day->pluck("day_id"))->select("id","name")->get();
            $charges = Charge::where("is_active",true)->select("id","type")->get();

            return view("backend.modules.user_module.doctor.modals.edit", compact("doctor","days","selected_days","charges"));
        }
        else{
            return view("errors.404");
        }
    }
    //doctor edit modal end

    //doctor update modal start
    public function update(Request $request, $id){
        if( can('edit_doctor') ){
            
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'charge_id' => 'required',
                'designation' => 'required',
                'chamber' => 'required',
                'location' => 'required',
                'email' => 'required|unique:doctors,email,'. $id,
                'phone' => 'required|numeric|regex:/(01)[0-9]{9}/|unique:doctors,phone,'.$id,
                'in' => 'required',
                'out' => 'required',
                'day_id' => 'required',
                'degree' => 'required',
           ]);

           if( $validator->fails() ){
               return response()->json(['errors' => $validator->errors()] ,422);
           }else{
                try{
                    $doctor = Doctor::find($id);
                    $doctor->name = $request->name;
                    $doctor->charge_id = $request->charge_id;
                    $doctor->designation = $request->designation;
                    $doctor->chamber = $request->chamber;
                    $doctor->location = $request->location;
                    $doctor->degree = $request->degree;
                    $doctor->speciality = $request->speciality ?? null;
                    $doctor->nid = $request->nid ?? null;
                    $doctor->email  = $request->email;
                    $doctor->phone = $request->phone;
                    $doctor->is_active      = $request->is_active;
                    $doctor->in = $request->in;
                    $doctor->out = $request->out;
                    $doctor->gender      = $request->gender;
                    if( $doctor->save() ){

                        DB::statement("DELETE FROM doctor_days WHERE doctor_id = $doctor->id ");

                        foreach( $request['day_id'] as $day_id ){
                            $doctor_day = new DoctorDay();
                            $doctor_day->doctor_id = $doctor->id;
                            $doctor_day->day_id = $day_id;
                            $doctor_day->save();
                        }

                        return response()->json(['success' => $doctor->name . "'s Account Updated Successfully"], 200);
                    }
                }catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
           }
        }else{
            return view("errors.404");
        }
    }

    //doctor update modal end

    //doctor reset modal start
    public function reset_modal($id){
        if( can("doctor_reset_password") ){
            $doctor = Doctor::find($id);
            return view("backend.modules.user_module.doctor.modals.reset", compact("doctor"));
        }
        else{
            return view("errors.404");
        }
    }

    //doctor reset start
    public function reset($id, Request $request){
        if( can("doctor_reset_password") ){
            $validator = Validator::make($request->all(),[
                'password' => 'required|confirmed|min:6',
           ]);

           if( $validator->fails() ){
               return response()->json(['errors' => $validator->errors()] ,422);
           }
           else{
               try{
                    $doctor = Doctor::find($id);
                    $doctor->password = Hash::make($request->password);
                    if( $doctor->save() ){
                        return response()->json(['success' => 'Password Reset Successfully'], 200);
                    }
               }
               catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()],200);
                }
            }
            
        }
        else{
            return view("errors.404");
        }
    }


    //view modal function start
    public function view_modal($id){
        $doctor = Doctor::where("id",$id)->first();
        return view("backend.modules.user_module.doctor.modals.view", compact("doctor"));
    }
    //view modal function end

}
