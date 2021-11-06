<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserModule\Patient;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    //register function start
    public function register(){
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
            return view("frontend.pages.auth.register");
        }
        
    }
    //register function end


    //do register start
    public function do_register(Request $request){
        $validator  = Validator::make($request->all(),[
            "name" => "required",
            "date_of_birth" => "required",
            "blood_group" => "required",
            "gender" => "required",
            "email" => "required|unique:patients,email",
            "phone" => "required|numeric|regex:/(01)[0-9]{9}/|unique:patients,phone",
            "address" => "required",
            "city" => "required",
            "district" => "required",
            "password" => "required|min:6|confirmed",
        ]);

        if( $validator->fails() ){
            return response()->json([
                
                'errors' => $validator->errors()
            ], 422);
        }
        else{
            try{
                $patient = new Patient();

                $rand = rand(000000,999999);
                $patient->patient_id  = "P-" . $rand;
                $patient->name = $request->name;
                $patient->email  = $request->email;
                $patient->phone   = $request->phone ;
                $date = explode("-",str_replace("/","-",$request->date_of_birth));
                $patient->date_of_birth   =  $date[2] ."-".$date[1]."-".$date[0];
                $patient->blood_group   = $request->blood_group ;
                $patient->gender   = $request->gender ;
                $patient->address   = $request->address ;
                $patient->city   = $request->city ;
                $patient->district   = $request->district ;
                $patient->is_active   = true ;

                $patient->month   = Carbon::now()->month ;
                $patient->year   = Carbon::now()->year ;

                $patient->password   = Hash::make($request->password);

                if( $patient->save() ){

                    if( auth('patient')->attempt(['email' => $request->email, 'password' => $request->password],true) ){
                        $url = route('patient.dashboard');
                        return response()->json([
                            'redirect' => $url,
                            'redirect_message' => 'Registration Success. Redirecting...'
                        ], 200);
                    }
                    else{
                        return response()->json(['error' => 'Invalid Credentials'], 200);
                    }

                }

            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }

    }
    //do register end


    //api register start
    public function api_register(Request $request){

        $email = Patient::where("email",$request->email)->first();
        $phone = Patient::where("phone",$request->phone)->first();

        if( $email || $phone ){
            return response()->json([
                'status' => 'error',
                'body' => [
                    'message' => 'Email or Phone Already Exists' 
                ],
            ],200);
        }

        try{
            $patient = new Patient();

            $rand = rand(000000,999999);
            $patient->patient_id  = "P-" . $rand;
            $patient->name = $request->name;
            $patient->email  = $request->email;
            $patient->phone   = $request->phone ;
            $date = explode("-",str_replace("/","-",$request->date_of_birth));
            $patient->date_of_birth   =  $date[2] ."-".$date[1]."-".$date[0];
            $patient->blood_group   = $request->blood_group ;
            $patient->gender   = $request->gender ;
            $patient->address   = $request->address ;
            $patient->city   = $request->city ;
            $patient->district   = $request->district ;
            $patient->is_active   = true ;

            $patient->month   = Carbon::now()->month ;
            $patient->year   = Carbon::now()->year ;

            $patient->password   = Hash::make($request->password);

            if( $patient->save() ){

                return response()->json([
                    'status' => 'success',
                    'body' => $patient,
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
    //api register end

}
