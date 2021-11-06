<?php

namespace App\Http\Controllers\Frontend\Profile\Doctor;

use App\Http\Controllers\Controller;
use App\Models\AppoinmentModule\Appoinment;
use App\Models\UserModule\Day;
use App\Models\UserModule\doctor;
use App\Models\UserModule\DoctorDay;
use App\Models\UserModule\Patient;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DoctorProfileController extends Controller
{
    //index function start
    public function index(){
        if(auth('doctor')->check()){
            $appoinments = Appoinment::whereDate("appoinment_date",Carbon::now()->toDateString())
            ->orderBy("id","desc")
            ->where("doctor_id",auth('doctor')->user()->id)
            ->select("id","appoinment_no","appoinment_date","total","status","patient_id","created_at")
            ->paginate(10);

            $patient = Patient::where("is_active",true)->select("id")->count();
            $todays_appoinments = Appoinment::where("doctor_id",auth('doctor')->user()->id)->whereDate("appoinment_date",Carbon::now()->toDateString())
            ->select("id")->count();
            $total_appoinment = Appoinment::where("doctor_id",auth('doctor')->user()->id)->select("id")->count();

            return view("frontend.pages.profile.doctor.index",compact("appoinments","patient","todays_appoinments","total_appoinment"));
        }
        else{
            return view("errors.404");
        }
        
    }
    //index function end


    //all function start
    public function all(){
            $appoinments = Appoinment::orderBy("id","desc")
            ->where("doctor_id",auth('doctor')->user()->id)
            ->select("id","appoinment_no","appoinment_date","total","status","patient_id","created_at")
            ->paginate(10);

            $patient = Patient::where("is_active",true)->select("id")->count();
            $todays_appoinments = Appoinment::where("doctor_id",auth('doctor')->user()->id)->whereDate("appoinment_date",Carbon::now()->toDateString())
            ->orderBy("id","desc")
            ->select("id")->count();
            $total_appoinment = Appoinment::where("doctor_id",auth('doctor')->user()->id)->select("id")->count();

            return view("frontend.pages.profile.doctor.pages.all", compact("appoinments","patient","todays_appoinments","total_appoinment"));
        
    }
    //all function end


    //profile setting function start
    public function profile_setting_page(){
        $days = Day::orderBy("id","asc")->whereNotIn("id",auth('doctor')->user()->day->pluck("day_id"))->select("id","name")->get();
        $selected_days = Day::orderBy("id","asc")->whereIn("id",auth('doctor')->user()->day->pluck("day_id"))->select("id","name")->get();
        return view("frontend.pages.profile.doctor.pages.profile_setting",compact("days","selected_days"));
    }
    //profile setting function end


    //update profile setting function start
    public function update_profile_setting(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "designation" => "required",
            "chamber" => "required",
            "location" => "required",
            "email" => "required|unique:doctors,email,". auth('doctor')->user()->id,
            "phone" => "required|numeric|regex:/(01)[0-9]{9}/|unique:doctors,phone,". auth('doctor')->user()->id,
            "gender" => "required",
            "in" => "required",
            "out" => "required",
            "day_id" => "required",
            "degree" => "required",
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $doctor = doctor::find(auth('doctor')->user()->id);

                $doctor->name = $request->name;
                $doctor->email  = $request->email;
                $doctor->phone   = $request->phone ;
                $doctor->designation   =  $request->designation;
                $doctor->chamber   =  $request->chamber;
                $doctor->location   =  $request->location;
                $doctor->gender   = $request->gender;
                $doctor->degree = $request->degree;
                $doctor->speciality = $request->speciality ?? null;
                $doctor->nid = $request->nid ?? null;
                $doctor->in   = $request->in;
                $doctor->out   = $request->out;
                $doctor->is_available   = $request->is_available ?? false;

                if( $request->image ){
                    if( File::exists('images/profile/doctor/'. $doctor->image) ){
                        File::delete('images/profile/doctor/'. $doctor->image);
                    }
                    $image = $request->file('image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/profile/doctor/'.$img);
                    Image::make($image)->save($location);
                    $doctor->image = $img;
                }

                if( $doctor->save() ){

                    DB::statement("DELETE FROM doctor_days WHERE doctor_id = $doctor->id ");

                    foreach( $request['day_id'] as $day_id ){
                        $doctor_day = new DoctorDay();
                        $doctor_day->doctor_id = $doctor->id;
                        $doctor_day->day_id = $day_id;
                        $doctor_day->save();
                    }

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
        return view("frontend.pages.profile.doctor.pages.change_password");
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
                $doctor = Doctor::find(auth('doctor')->user()->id);

                if( $doctor ){
                    if (Hash::check($request->old_password, $doctor->password)){
                        $doctor->password = Hash::make($request->password);
                        if ($doctor->save()) {
                            return response()->json(['success' => 'Password Updated'], 200);
                        }
                    } 
                    else {
                        return response()->json(['error' => 'Old Password did not match'], 200);
                    }
                }
                else{
                    return response()->json(['error' => 'Invalid Doctor' ], 200); 
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
        Auth::guard('doctor')->logout();
        return redirect()->route('login');
    }
    //logout function end
}
