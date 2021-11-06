<?php

namespace App\Http\Controllers\Frontend\Profile\Patient;

use App\Http\Controllers\Controller;
use App\Models\AppoinmentModule\Appoinment;
use App\Models\UserModule\Patient;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PatientProfileController extends Controller
{
    //index function start
    public function index(){
        $appoinments = Appoinment::whereDate("appoinment_date",Carbon::now()->toDateString())
        ->where("patient_id",auth('patient')->user()->id)
        ->orderBy("id","desc")
        ->select("id","appoinment_no","appoinment_date","total","status","patient_id","created_at")
        ->paginate(10);

        return view("frontend.pages.profile.patient.index", compact("appoinments"));
    }
    //index function end


    //all function start
    public function all(){
        $appoinments = Appoinment::where("patient_id",auth('patient')->user()->id)
        ->orderBy("id","desc")
        ->select("id","appoinment_no","appoinment_date","total","status","patient_id","created_at")
        ->paginate(10);

        return view("frontend.pages.profile.patient.pages.all", compact("appoinments"));
    }
    //all function end


    //get appoinment function start
    public function get_appoinment(Request $request){
        try{
            $patient = Patient::where("id",$request->patient_id)->select("id")->first();

            if( $patient ){

                $appoinment = new Appoinment();

                $rand = "A-" . rand(000000,999999);
                $appoinment->appoinment_no = $rand;
                $appoinment->status = "Pending";
                $appoinment->payment_status = "Unpaid";
                $appoinment->patient_id  = $patient->id;

                $appoinment->month   = Carbon::now()->month ;
                $appoinment->year   = Carbon::now()->year ;

                if( $appoinment->save() ){
                    return response()->json(['success' => 'New Appoinment Created.'], 200);
                }

            }
            else{
                return response()->json(['error' => 'No patient Found'], 200);
            }

        }
        catch( Exception $e ){
            return response()->json(['error' => $e->getMessage()],200);
        }
    }
    //get appoinment function end


    //profile setting function start
    public function profile_setting_page(){
        return view("frontend.pages.profile.patient.pages.profile_setting");
    }
    //profile setting function end


    //update profile setting function start
    public function update_profile_setting(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|unique:patients,email,". auth('patient')->user()->id,
            "phone" => "required|numeric|regex:/(01)[0-9]{9}/|unique:patients,phone,". auth('patient')->user()->id,
            "date_of_birth" => "required",
            "blood_group" => "required",
            "gender" => "required",
            "city" => "required",
            "district" => "required",
            "address" => "required",
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $patient = Patient::find(auth('patient')->user()->id);

                $patient->name = $request->name;
                $patient->email  = $request->email;
                $patient->phone   = $request->phone ;
                $patient->date_of_birth   =  $request->date_of_birth;
                $patient->blood_group   = $request->blood_group ;
                $patient->gender   = $request->gender ;
                $patient->address   = $request->address ;
                $patient->city   = $request->city ;
                $patient->district   = $request->district ;

                if( $request->image ){
                    if( File::exists('images/profile/patient/'. $patient->image) ){
                        File::delete('images/profile/patient/'. $patient->image);
                    }
                    $image = $request->file('image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/profile/patient/'.$img);
                    Image::make($image)->save($location);
                    $patient->image = $img;
                }

                if( $patient->save() ){
                    return response()->json(['success' => 'Profile Updated'],200);
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }

    }
    //update profile setting function end


    //change password page function start
    public function change_password_page(){
        return view("frontend.pages.profile.patient.pages.change_password");
    }
    //change password page function end


    //change password function start
    public function change_password(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $patient = Patient::find(auth('patient')->user()->id);

                if( $patient ){
                    if (Hash::check($request->old_password, $patient->password)){
                        $patient->password = Hash::make($request->password);
                        if ($patient->save()) {
                            return response()->json(['success' => 'Password Updated'], 200);
                        }
                    } 
                    else {
                        return response()->json(['error' => 'Old Password did not match'], 200);
                    }
                }
                else{
                    return response()->json(['error' => 'Invalid Patient' ], 200); 
                }

            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200); 
            }
        }
    }
    //change password function end


    //logout function start
    public function logout(){
        Auth::guard('patient')->logout();
        return redirect()->route('login');
    }
    //logout function end

}
