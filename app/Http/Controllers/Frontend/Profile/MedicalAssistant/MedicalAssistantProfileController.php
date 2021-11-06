<?php

namespace App\Http\Controllers\Frontend\Profile\MedicalAssistant;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppoinmentModule\AppoinmentResourceCollection;
use App\Models\AppoinmentModule\Appoinment;
use App\Models\UserModule\MedicalAssistant;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MedicalAssistantProfileController extends Controller
{
    //index page start
    public function index(){

       $appoinments = Appoinment::whereDate("appoinment_date",Carbon::now()->toDateString())
        ->orderBy("id","desc")
        ->select("id","appoinment_no","appoinment_date","total","status","patient_id","created_at")
        ->paginate(10);

        return view("frontend.pages.profile.medical_assistant.index", compact("appoinments"));
    }
    //index page end


    //all function start
    public function all(){
        $appoinments = Appoinment::orderBy("id","desc")
        ->select("id","appoinment_no","appoinment_date","total","status","patient_id","created_at")
        ->paginate(10);

        return view("frontend.pages.profile.medical_assistant.pages.all", compact("appoinments"));
    }
    //all function end

  
    //ajax search_all method
    public function search_all(Request $request){
 
    $searchInput = $request->get('searchAll');
          if($searchInput){ 
              
              $searchResult = Appoinment::select("id","appoinment_no","appoinment_date","total","status","payment_status","patient_id")
                              ->where('appoinment_no', 'like', '%'.$searchInput.'%')
                              ->orWhere('appoinment_date', 'like', '%'.$searchInput.'%')
                              ->orWhere('total', 'like', '%'.$searchInput.'%')
                              ->orWhere('status', 'like', '%'.$searchInput.'%')
                              ->orWhere('payment_status', 'like', '%'.$searchInput.'%')
                              ->orderBy("id","desc")
                              ->take(20)
                              ->get();
  
              if( $searchResult){
                  return response()->json(['searchResult'=>new AppoinmentResourceCollection($searchResult)], 200);
              }
                              
          }
          else{
              $searchResult = Appoinment::orderBy("id","desc")->select("id","appoinment_no","appoinment_date","total","status","payment_status","patient_id")->take(20)->get();
              return response()->json(['searchResult'=>new AppoinmentResourceCollection($searchResult)], 200);
          }
      }

    //ajax search_today method
    public function search_today(Request $request){
    
   $searchInput = $request->get('searchToDay');
     
          if($searchInput){            
          
            $query = Appoinment::select("id","appoinment_no","appoinment_date","status","payment_status","patient_id")
                            ->where('appoinment_no', 'like', '%'.$searchInput.'%')
                            ->orWhere('appoinment_date', 'like', '%'.$searchInput.'%')
                            ->orWhere('total', 'like', '%'.$searchInput.'%')
                            ->orWhere('status', 'like', '%'.$searchInput.'%')
                            ->orWhere('payment_status', 'like', '%'.$searchInput.'%')
                            ->orderBy("id","desc")
                            ->take(20)
                            ->get(); 

            $searchResult = $query->where("appoinment_date",Carbon::now()->toDateString());
  
              if( $searchResult){
                return response()->json(['searchResult'=> new AppoinmentResourceCollection($searchResult)], 200);
            }
                              
          }
          else{
              $searchResult = Appoinment::select("id","appoinment_no","appoinment_date","total","status","payment_status","patient_id")->where('appoinment_date',Carbon::now()->toDateString())->orderBy("id","desc")->take(20)->get();
              return response()->json(['searchResult'=>new AppoinmentResourceCollection($searchResult)], 200);
          }
      }

    //profile setting function start
    public function profile_setting_page(){
        return view("frontend.pages.profile.medical_assistant.pages.profile_setting");
    }
    //profile setting function end


    //update profile setting function start
    public function update_profile_setting(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|unique:medical_assistants,email,". auth('medical_assistant')->user()->id,
            "phone" => "required|numeric|regex:/(01)[0-9]{9}/|unique:medical_assistants,phone,". auth('medical_assistant')->user()->id,
            'present_address' => 'required',
            'permanent_address' => 'required',
            'nid' => 'required|numeric|unique:medical_assistants,nid,' . auth('medical_assistant')->user()->id,
            'bmdc_reg_no' => 'required|numeric|unique:medical_assistants,bmdc_reg_no,' . auth('medical_assistant')->user()->id,
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $medical_assistant = MedicalAssistant::find(auth('medical_assistant')->user()->id);

                $medical_assistant->name = $request->name;
                $medical_assistant->email  = $request->email;
                $medical_assistant->phone   = $request->phone;

                $medical_assistant->present_address   = $request->present_address;
                $medical_assistant->permanent_address   = $request->permanent_address;
                $medical_assistant->nid   = $request->nid;
                $medical_assistant->bmdc_reg_no   = $request->bmdc_reg_no;

                if( $request->image ){
                    if( File::exists('images/profile/medical_assistant/'. $medical_assistant->image) ){
                        File::delete('images/profile/medical_assistant/'. $medical_assistant->image);
                    }
                    $image = $request->file('image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/profile/medical_assistant/'.$img);
                    Image::make($image)->save($location);
                    $medical_assistant->image = $img;
                }

                if( $medical_assistant->save() ){
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
        return view("frontend.pages.profile.medical_assistant.pages.change_password");
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
                $medical_assistant = MedicalAssistant::find(auth('medical_assistant')->user()->id);

                if( $medical_assistant ){
                    if (Hash::check($request->old_password, $medical_assistant->password)){
                        $medical_assistant->password = Hash::make($request->password);
                        if ($medical_assistant->save()) {
                            return response()->json(['success' => 'Password Updated'], 200);
                        }
                    } 
                    else {
                        return response()->json(['error' => 'Old Password did not match'], 200);
                    }
                }
                else{
                    return response()->json(['error' => 'Invalid Medical Assistant' ], 200); 
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
        Auth::guard('medical_assistant')->logout();
        return redirect()->route('login');
    }
    //logout function end
}
