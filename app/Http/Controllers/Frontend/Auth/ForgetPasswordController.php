<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserModule\Doctor;
use App\Models\UserModule\MedicalAssistant;
use App\Models\UserModule\Patient;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{

    //get email function start
    public function getEmail(){
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
            return view("frontend.pages.auth.password_email");
        }
        
    }
    //get email function end


    //send email function start
    public function postEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required",
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                if( Patient::where('email', $request->email)->first() ){
                    $token = Str::random(60);
                    DB::table('password_resets')->insert(
                        ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
                    );
                    $email = $request->email;
                    Mail::send('frontend.pages.auth.verify', ['token' => $token, 'email' => $email], function ($message) use ($request) {
                        $message->from('mdsehirulislamrehi@gmail.com');
                        $message->to($request->email);
                        $message->subject('Reset Password Notification');
                    });
                    return response()->json(['success' => 'We send you a password reset link in your given email address'], 200);
                }
                elseif( MedicalAssistant::where('email', $request->email)->first() ){
                    $token = Str::random(60);
                    DB::table('password_resets')->insert(
                        ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
                    );
                    $email = $request->email;
                    Mail::send('frontend.pages.auth.verify', ['token' => $token, 'email' => $email], function ($message) use ($request) {
                        $message->from('mdsehirulislamrehi@gmail.com');
                        $message->to($request->email);
                        $message->subject('Reset Password Notification');
                    });
                    return response()->json(['success' => 'We send you a password reset link in your given email address'], 200);
                }
                elseif( Doctor::where('email', $request->email)->first() ){
                    $token = Str::random(60);
                    DB::table('password_resets')->insert(
                        ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
                    );
                    $email = $request->email;
                    Mail::send('frontend.pages.auth.verify', ['token' => $token, 'email' => $email], function ($message) use ($request) {
                        $message->from('mdsehirulislamrehi@gmail.com');
                        $message->to($request->email);
                        $message->subject('Reset Password Notification');
                    });
                    return response()->json(['success' => 'We send you a password reset link in your given email address'], 200);
                }
                else{
                    return response()->json(['error' => 'Invalid Email Address'], 200);
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }

    }
    //send email function end


    //get password function start
    public function getPassword($token, $email, Request $request)
    {
        if( auth('doctor')->check() ){
            return redirect()->route('patient.dashboard');
        }
        elseif( auth('medical_assistant')->check() ){
            return redirect()->route('patient.dashboard');
        }
        elseif( auth('patient')->check() ){
            return redirect()->route('patient.dashboard');
        }
        else{
            $all_token = DB::table('password_resets')->where("token",$token)->get();

            if( $all_token->count() > 0 ){
                return view('frontend.pages.auth.reset', ['token' => $token, 'email' => $email]);
            }
            else{
                $request->session()->flash('error', 'Session Timeout. Please send reset password link again');
                return redirect()->route('frontend.get.email');
            }
        }
        
        
    }
    //get password function end


    //reset password function start
    public function reset_password(Request $request, $email,$token)
    {
        $validator = Validator::make($request->all(), [
            "password" => "required|confirmed|min:6",
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                if( Patient::where('email', $email)->first() ){
                    $user = Patient::where('email', $email)->first();
                    $user->password = Hash::make($request->password);
                    if ($user->save()) {
                        DB::table("password_resets")->where("token",$token)->delete();
                        Auth::guard('patient')->logout();
                        $url = route('login');
                        return response()->json(['redirect' => $url, 'redirect_message' => 'Password Updated'],200);
                    }
                }
                elseif( MedicalAssistant::where('email', $email)->first() ){
                    $user = MedicalAssistant::where('email', $email)->first();
                    $user->password = Hash::make($request->password);
                    if ($user->save()) {
                        DB::table("password_resets")->where("token",$token)->delete();
                        Auth::guard('medical_assistant')->logout();
                        $url = route('login');
                        return response()->json(['redirect' => $url, 'redirect_message' => 'Password Updated'],200);
                    }
                }
                elseif( Doctor::where('email', $email)->first() ){
                    $user = Doctor::where('email', $email)->first();
                    $user->password = Hash::make($request->password);
                    if ($user->save()) {
                        DB::table("password_resets")->where("token",$token)->delete();
                        Auth::guard('doctor')->logout();
                        $url = route('login');
                        return response()->json(['redirect' => $url, 'redirect_message' => 'Password Updated'],200);
                    }
                }
                
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
        

        
    }
    //reset password function end

}
