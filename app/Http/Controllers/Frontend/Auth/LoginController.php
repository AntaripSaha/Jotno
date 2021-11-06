<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserModule\PatientResource;
use App\Models\UserModule\Doctor;
use App\Models\UserModule\MedicalAssistant;
use App\Models\UserModule\Patient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    //login function start
    public function login(){
        if( auth('doctor')->check() ){
            return redirect()->route('doctor.dashboard');
        }
        elseif( auth('medical_assistant')->check() ){
            return redirect()->route('medical.assistant.dashboard');
        }
        elseif( auth('patient')->check() ){
            return redirect()->route('patient.dashboard');
        }
        else{
            return view("frontend.pages.auth.login");
        }
    }
    //login function end


    //do login function start
    public function do_login(Request $request){
        $validator  = Validator::make($request->all(),[
            "email" => "required",
            "password" => "required|min:6",
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                
                if( Patient::where("email",$request->email)->where("is_active",true)->first() ){
                    $patient = Patient::where("email",$request->email)->first();
                    if( auth('patient')->attempt(['email' => $request->email, 'password' => $request->password],true) ){
                        $url = route('patient.dashboard');
                        return response()->json([
                            'redirect' => $url,
                            'redirect_message' => 'Login Success. Redirecting...'
                        ], 200);
                    }
                    else{
                        return response()->json(['error' => 'Invalid Credentials'], 200);
                    }
                }
                elseif( Doctor::where("email",$request->email)->where("is_active",true)->first() ){
                    $doctor = Doctor::where("email",$request->email)->first();
                    if( auth('doctor')->attempt(['email' => $request->email, 'password' => $request->password],true) ){
                        $url = route('doctor.dashboard');
                        return response()->json([
                            'redirect' => $url,
                            'redirect_message' => 'Login Success. Redirecting...'
                        ], 200);
                    }
                    else{
                        return response()->json(['error' => 'Invalid Credentials'], 200);
                    }
                }
                elseif( MedicalAssistant::where("email",$request->email)->where("is_active",true)->first() ){
                    $medical_assistant = MedicalAssistant::where("email",$request->email)->first();
                    if( auth('medical_assistant')->attempt(['email' => $request->email, 'password' => $request->password],true) ){
                        $url = route('medical.assistant.dashboard');
                        return response()->json([
                            'redirect' => $url,
                            'redirect_message' => 'Login Success. Redirecting...'
                        ], 200);
                    }
                    else{
                        return response()->json(['error' => 'Invalid Credentials'], 200);
                    }
                }
                else{
                    return response()->json(['error' => 'Invalid Credentials'], 200);
                }
                

            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }
    //do login function end


    //api login function start
    public function api_login(Request $request){
       $patient = Patient::where("email",$request->email)->where("is_active",true)->first();

        if( $patient ){
            try{
                
                if( Hash::check($request->password, $patient->password) ){
                    return response()->json([
                        'status' => 'success',
                        'body' => new PatientResource($patient) ,
                    ], 200);
                }
                else{
                    return response()->json([
                        'status' => 'error',
                        'body' => [
                            'message' => "Wrong Password"
                        ],
                    ], 200);
                }

            }
            catch( Exception $e ){
                return response()->json([
                    'status' => 'error',
                    'body' => [
                        'message' => $e->getMessage()
                    ],
                ], 200);
            }
        }
        else{
            return response()->json([
                'status' => 'error',
                'body' => [
                    'message' => 'Wrong Email Address'
                ], 
            ],200);
        }
 
    }
    //api login function end
    
}
