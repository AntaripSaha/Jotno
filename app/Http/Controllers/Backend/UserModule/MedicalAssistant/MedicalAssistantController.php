<?php

namespace App\Http\Controllers\Backend\UserModule\MedicalAssistant;

use App\Http\Controllers\Controller;
use App\Models\UserModule\MedicalAssistant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class MedicalAssistantController extends Controller
{
    //index funciton start
    public function index(){
        if( can("medical_assistant") ){
            return view("backend.modules.user_module.medical_assistant.index");
        }
        else{
            return view("errors.404");
        }
    }   
    //index funciton end


    //view data
    public function data(){
        if( can('medical_assistant') ){
            $medical_assistant = MedicalAssistant::select("id","medical_assistant_id","name","phone","is_active","image")->get();

            return DataTables::of($medical_assistant)
            ->rawColumns(['action','image','is_active'])
            ->editColumn('is_active', function (MedicalAssistant $medical_assistant) {
                if ($medical_assistant->is_active == true) {
                    return '<p class="badge badge-success">Active</p>';
                } else {
                    return '<p class="badge badge-danger">Inactive</p>';
                }
            })
            ->editColumn('image', function(MedicalAssistant $medical_assistant){
                if( $medical_assistant->image == null ){
                    $src = asset("images/profile/user.png");
                }
                else{
                    $src = asset("images/profile/medical_assistant/".$medical_assistant->image);
                } 
                return "<img src='$src' width='50px' style='border-radius: 100%'>";
            })
            
            ->addColumn('action', function (MedicalAssistant $medical_assistant) {
                return '
                <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown'.$medical_assistant->id.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdown'.$medical_assistant->id.'">
                
                    '.( can("view_medical_assistant") ? '
                    <a class="dropdown-item" href="#" data-content="'.route('medical_assistant.view.modal',$medical_assistant->id).'" data-target="#myModal" data-toggle="modal">
                        <i class="fas fa-eye"></i>
                        View
                    </a>
                    ': '') .'

                    '.( can("medical_assistant_reset_password") ? '
                    <a class="dropdown-item" href="#" data-content="'.route('medical_assistant.reset.modal',$medical_assistant->id).'" data-target="#myModal" data-toggle="modal">
                        <i class="fas fa-key"></i>
                        Reset Password
                    </a>
                    ': '') .'

                    '.( can("edit_medical_assistant") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('medical_assistant.edit',$medical_assistant->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-edit"></i>
                            Edit
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
        if( can("add_medical_assistant") ){
            return view("backend.modules.user_module.medical_assistant.modals.add");
        }
        else{
            return view("errors.404");
        }
    }   
    //add_modal funciton end

    //add medical_assistant start
    public function add(Request $request){

        if( can('add_medical_assistant') ){
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|unique:medical_assistants,email,',
                'phone' => 'required|unique:medical_assistants,phone|numeric|regex:/(01)[0-9]{9}/',
                'password' => 'required|confirmed',
                'present_address' => 'required',
                'permanent_address' => 'required',
                'nid' => 'required|numeric|unique:medical_assistants,nid,',
                'bmdc_reg_no' => 'required|numeric|unique:medical_assistants,bmdc_reg_no,',
            ]);


           if( $validator->fails() ){
               return response()->json(['errors' => $validator->errors()] ,422);
           }else{
                try{
                    $medical_assistant = new MedicalAssistant();
                    $medical_assistant->medical_assistant_id = "M-".rand(000000,999999);
                    $medical_assistant->name = $request->name;
                    $medical_assistant->email  = $request->email;
                    $medical_assistant->phone = $request->phone;
                    $medical_assistant->password = Hash::make($request->password);
                    $medical_assistant->is_active   = true;

                    $medical_assistant->present_address   = $request->present_address;
                    $medical_assistant->permanent_address   = $request->permanent_address;
                    $medical_assistant->nid   = $request->nid;
                    $medical_assistant->bmdc_reg_no   = $request->bmdc_reg_no;

                    $medical_assistant->month   = Carbon::now()->month ;
                    $medical_assistant->year   = Carbon::now()->year ;

                    if( $medical_assistant->save() ){
                        return response()->json(['success' => 'New Medical Assistant Created Successfully'], 200);
                    }

                }catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
           }
        }else{
            return view("errors.404");
        }
    }

    //add medical_assistant end

    //medical_assistant edit modal start
     public function edit($id){

        if( can("edit_medical_assistant") ){
            $medical_assistant = MedicalAssistant::where("id",$id)->first();
            return view("backend.modules.user_module.medical_assistant.modals.edit", compact("medical_assistant"));
        }
        else{
            return view("errors.404");
        }
    }
    //medical_assistant edit modal end

    //medical_assistant update modal start
    public function update(Request $request, $id){
        if( can('edit_medical_assistant') ){

            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|unique:medical_assistants,email,'. $id,
                'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
                'present_address' => 'required',
                'permanent_address' => 'required',
                'nid' => 'required|numeric|unique:medical_assistants,nid,' . $id,
                'bmdc_reg_no' => 'required|numeric|unique:medical_assistants,bmdc_reg_no,' . $id,
           ]);

           if( $validator->fails() ){
               return response()->json(['errors' => $validator->errors()] ,422);
           }else{
                try{
                    $medical_assistant = MedicalAssistant::find($id);
                    $medical_assistant->name = $request->name;
                    $medical_assistant->email  = $request->email;
                    $medical_assistant->phone = $request->phone;
                    $medical_assistant->is_active   = $request->is_active;

                    $medical_assistant->present_address   = $request->present_address;
                    $medical_assistant->permanent_address   = $request->permanent_address;
                    $medical_assistant->nid   = $request->nid;
                    $medical_assistant->bmdc_reg_no   = $request->bmdc_reg_no;

                    if( $medical_assistant->save() ){
                        return response()->json(['success' => $medical_assistant->name . "'s Account Updated Successfully"], 200);
                    }
                }catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
           }
        }else{
            return view("errors.404");
        }
    }

//medical_assistant update modal end

 //medical_assistant reset modal start
    public function reset_modal($id){
        if( can("medical_assistant_reset_password") ){
            $medical_assistant = MedicalAssistant::find($id);
            return view("backend.modules.user_module.medical_assistant.modals.reset", compact("medical_assistant"));
        }
        else{
            return view("errors.404");
        }
    }

    //medical_assistant reset start
    public function reset($id, Request $request){
        if( can("medical_assistant_reset_password") ){
            $validator = Validator::make($request->all(),[
                'password' => 'required|confirmed|min:6',
           ]);

           if( $validator->fails() ){
               return response()->json(['errors' => $validator->errors()] ,422);
           }
           else{
               try{
                    $medical_assistant = MedicalAssistant::find($id);
                    $medical_assistant->password = Hash::make($request->password);
                    if( $medical_assistant->save() ){
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
        $medical_assistant = MedicalAssistant::where("id",$id)->first();
        return view("backend.modules.user_module.medical_assistant.modals.view", compact("medical_assistant"));
    }
    //view modal function end

}