<?php

namespace App\Http\Controllers\Backend\UserModule\Patient;

use App\Http\Controllers\Controller;
use App\Models\UserModule\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class PatientController extends Controller
{
    //index funciton start
    public function index(){
        if( can("patient") ){
            return view("backend.modules.user_module.patient.index");
        }
        else{
            return view("errors.404");
        }
    }   
    //index funciton end

     //view data
     public function data(){
        if( can('patient') ){
            $patient = Patient::select("id","patient_id","name","image","phone","is_active")->get();
            
            
            return DataTables::of($patient)
            ->rawColumns(['action','image','is_active'])
            ->editColumn('is_active', function (Patient $patient) {
                if ($patient->is_active == true) {
                    return '<p class="badge badge-success">Active</p>';
                } else {
                    return '<p class="badge badge-danger">Inactive</p>';
                }
            })
            ->editColumn('image', function(Patient $patient){
                if( $patient->image == null ){
                    $src = asset("images/profile/user.png");
                }
                else{
                    $src = asset("images/profile/patient/".$patient->image);
                } 
                return "<img src='$src' width='50px' style='border-radius: 100%'>";
            })
            
            ->addColumn('action', function (Patient $patient) {
                return '
                <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown'.$patient->id.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdown'.$patient->id.'">
                
                    '.( can("view_patient") ? '
                    <a class="dropdown-item" href="#" data-content="'.route('patient.view.modal',$patient->id).'" data-target="#myModal" data-toggle="modal">
                        <i class="fas fa-eye"></i>
                        View Patient
                    </a>
                    ': '') .'
                    '.( can("patient_reset_password") ? '
                    <a class="dropdown-item" href="#" data-content="'.route('patient.reset.modal',$patient->id).'" data-target="#myModal" data-toggle="modal">
                        <i class="fas fa-key"></i>
                        Reset Password
                    </a>
                    ': '') .'

                    '.( can("edit_patient") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('patient.edit',$patient->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-edit"></i>
                            Edit Patient
                        </a>
                        ': '') .'

                ';
            })
            ->make(true);
        }else{
            return view("errors.404");
        }
        
    }

    
    //patient edit modal start
    public function edit($id){
        if( can("edit_patient") ){
            $patient = Patient::where("id",$id)->select("id","is_active")->first();
            return view("backend.modules.user_module.patient.modals.edit", compact("patient"));
        }
        else{
            return view("errors.404");
        }
    }
    //patient edit modal end

    //patient update modal start
    public function update(Request $request, $id){
        if( can('edit_patient') ){
            
            $validator = Validator::make($request->all(),[
                'is_active' => 'required',
           ]);

           if( $validator->fails() ){
               return response()->json(['errors' => $validator->errors()] ,422);
           }else{
                try{
                    $patient = Patient::find($id);
                    $patient->is_active      = $request->is_active;
                    if( $patient->save() ){
                        return response()->json(['success' => $patient->name . "'s Account Updated Successfully"], 200);
                    }
                }catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
           }
        }else{
            return view("errors.404");
        }
    }

    //patient update modal end

    //patient reset modal start
    public function reset_modal($id){
        if( can("patient_reset_password") ){
            $patient = Patient::find($id);
            return view("backend.modules.user_module.patient.modals.reset", compact("patient"));
        }
        else{
            return view("errors.404");
        }
    }

    //patient reset start
    public function reset($id, Request $request){
        if( can("patient_reset_password") ){
            $validator = Validator::make($request->all(),[
                'password' => 'required|confirmed|min:6',
           ]);

           if( $validator->fails() ){
               return response()->json(['errors' => $validator->errors()] ,422);
           }
           else{
               try{
                    $patient = Patient::find($id);
                    $patient->password = Hash::make($request->password);
                    if( $patient->save() ){
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
        $patient = Patient::where("id",$id)->first();
        return view("backend.modules.user_module.patient.modals.view", compact("patient"));
    }
    //view modal function end

}
