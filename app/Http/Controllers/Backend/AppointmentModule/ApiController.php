<?php

namespace App\Http\Controllers\Backend\AppointmentModule;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppoinmentModule\AppoinmentResourceCollection;
use App\Http\Resources\AppoinmentModule\PrescriptionReportResourceCollection;
use App\Http\Resources\AppoinmentModule\PrescriptionResource;
use App\Http\Resources\PrescriptionModule\PrescriptionResourceCollection;
use App\Http\Resources\UserModule\PatientResource;
use App\Http\Resources\UserModule\PatientResourceCollection;
use App\Models\AppoinmentModule\Appoinment;
use App\Models\AppoinmentModule\Prescription;
use App\Models\AppoinmentModule\PrescriptionChiefComplaint;
use App\Models\AppoinmentModule\PrescriptionMedicine;
use App\Models\AppoinmentModule\PrescriptionReport;
use App\Models\AppoinmentModule\PrescriptionTest;
use App\Models\AppoinmentModule\Timing;
use App\Models\HomeModule\Home;
use App\Models\SettingsModule\AppInfo;
use App\Models\TestModule\ChiefComplaint;
use App\Models\TestModule\Medicine;
use App\Models\TestModule\TestTypeList;
use App\Models\UserModule\Patient;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use PDF;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ApiController extends Controller
{

    //today's appoinment 
    public function appoinment_today(Request $request){
        $patient = Patient::where("id",$request->id)->select("id")->first(); // $patient returns instance of Patient Model not patient id

        if( $patient ){
            $appoinment = Appoinment::where("patient_id",$patient->id)->where("appoinment_date",Carbon::now()->toDateString())->get();
           
            return response()->json([
                'status' => 'success',
                'body' => new AppoinmentResourceCollection($appoinment)
            ],200);
        }
        else{
            return response()->json([
                'status' => 'error',
                'body' => [
                    'message' => 'No Patient Found'
                ]
            ],200);
        }

    }
    //today's appoinment end 

    //all appoinment 
    public function appoinment_all(Request $request){
        $patient = Patient::where("id",$request->id)->select("id")->first();

        if( $patient ){
            $appoinment = Appoinment::where("patient_id",$patient->id)->get();
            return response()->json([
                'status' => 'success',
                'body' => new AppoinmentResourceCollection($appoinment)
            ],200);
        }
        else{
            return response()->json([
                'status' => 'error',
                'body' => [
                    'message' => 'No Patient Found'
                ]
            ],200);
        }

    }
    //all appoinment end 

    //get appoinment 
    public function get_appoinment(Request $request){
        $patient = Patient::where("id",$request->id)->select("id")->first();

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
                return response()->json([
                    'status' => 'success',
                    'body' => [
                        'message' => 'New Appoinment Created.'
                    ]
                ], 200);
            }
        }
        else{
            return response()->json([
                'status' => 'error',
                'body' => [
                    'message' => 'No Patient Found'
                ]
            ],200);
        }

    }
    //get appoinment end 

    //get prescription data start
    public function get_prescription(Request $request){

        $prescription = Prescription::where("id",$request->id)->first();

        if( $prescription ){

            //All initial test start
            $initial_tests = [];
            foreach( $prescription->appoinment->initial_test as $initial_test ){
                array_push($initial_tests,[
                    'name' => $initial_test->initial_test->name,
                    'result' => $initial_test->value,
                ]);
            }
            //All initial test end

            //All test data get start
            $main_test = [];
            foreach( PrescriptionTest::where("prescription_id",$prescription->id)->select("test_type_id","test_type_list")->get() as $prescription_test ){
                $test_type_list_data = TestTypeList::whereIn("id",unserialize($prescription_test->test_type_list))->select("name","price")->get();
                array_push($main_test,[
                    'test_type' => $prescription_test->test_type->name,
                    'test_type_list' => $test_type_list_data
                ]);
            }
            //All test data get end

            //chief complaint data get start
            $chief_complaint  = [];
            $prescription_chief_complaints = $prescription->chief_complaint->pluck("chief_complaint_id");
            foreach( $prescription_chief_complaints as $prescription_chief_complaint ){
                $chief_complaint_name = ChiefComplaint::where("id",$prescription_chief_complaint)->select("name")->first();
                if( $chief_complaint_name ){
                    array_push($chief_complaint,[
                        'name' => $chief_complaint_name->name,
                        'price' => 0,
                    ]);
                }
            }
            array_push($main_test,[
                'test_type' => "Chief Complaint",
                'test_type_list' => $chief_complaint
            ]);
            //chief complaint data get end

            //All medicine data get start
            $medicine = [];
            foreach( $prescription->prescription_medicine as $prescription_medicine ){

                if( $prescription_medicine->type == "Mark" || $prescription_medicine->type == "Drop" ){
                    $times = "";
                    $meal = "";
                    $span = "";
                    foreach( unserialize($prescription_medicine->timing) as $timings ){
                        foreach( $timings as $key => $timing ){
                            if( $timing['value'] == 'Timming' ){
                                $meal = Timing::where("id",$timing['id'])->select('value')->first()->value;
                                
                            }
                            elseif( $timing['value'] == 'Running' ){
                                $span = Timing::where("id",$timing['id'])->select('value')->first()->value;
                            }
                            else{
                                $times .= Timing::where("id",$timing['id'])->select('value')->first()->value . 
                                ( ( $key < 2 ) ? '+' :  "");
                            }
                        }
                        array_push($medicine,[
                            'name' => Medicine::where("id",$prescription_medicine->medicine_id)->select("name")->first()->name,
                            'type' => $prescription_medicine->type,
                            'timing' => $times,
                            'meal' => $meal,
                            'span' => $span,
                        ]);
                    }
                }
                else{
                    array_push($medicine,[
                        'name' => $prescription_medicine->medicine->name,
                        'type' => $prescription_medicine->type,
                        'timing' => $prescription_medicine->note,
                        'meal' => "",
                        'span' => "",
                    ]);
                }
               
            }
            //All medicine data get end

            return response()->json([
                'status' => 'success',
                'age' => Carbon::parse($prescription->appoinment->patient->date_of_birth)->diff(Carbon::now())->format('%y years'),
                'prescription' => new PrescriptionResource($prescription),
                'initial_tests' => $initial_tests,
                'main_test' => $main_test,
                'medicine' => $medicine,
            ], 200);
        }
        else{
            return response()->json([
                'status' => 'error',
                'body' => [
                    'message' => 'No prescription found'
                ]
            ],200); 
        }

    }
    //get prescription data end


    //prescription pdf funciton start
    public function prescription_pdf($id){
        $prescription = Prescription::where("id",$id)->first();

        if( $prescription ){
            $pdf = PDF::loadView('frontend.pages.pdf.prescription', compact('prescription'));

            $pdf->setPaper('A4', 'potrait');
            $name = "prescription-" . $prescription->prescription_no . ".pdf";
            return $pdf->stream($name, array("Attachment" => false));
        }
        else{
            return view("errors.404"); 
        }

    }
    //prescription pdf funciton end


    //billing pdf funciton start
    public function billing_pdf($id){
       $prescription = Prescription::where("id",$id)->first();

        if( $prescription ){
            $pdf = PDF::loadView('frontend.pages.pdf.billing', compact('prescription'));

            $pdf->setPaper('A4', 'potrait');
            $name = "prescription-bill-" . $prescription->prescription_no . ".pdf";
            return $pdf->stream($name, array("Attachment" => false));
        }
        else{
            return view("errors.404"); 
        }

    }
    //billing pdf funciton end


    //prescription report function start
    public function prescription_report(Request $request){
        $prescription = Prescription::where("id",$request->id)->first(); // returns objects not id

        if( $prescription ){
            $prescription_report = PrescriptionReport::where("prescription_id",$prescription->id)
            ->select("id","image","name","prescription_id","created_at")->get();

            return response()->json([
                'status' => 'success',
                'body' => new PrescriptionReportResourceCollection($prescription_report),
            ],200); 

        }
        else{
            return response()->json([
                'status' => 'error',
                'body' => [
                    'message' => 'No prescription found'
                ]
            ],200);  
        }
    }
    //prescription report function end


    //create report function start
    public function report_create(Request $request){
        try{
            
            $prescription = Prescription::where("id",$request->prescription_id)->select("id")->first();

            if( $prescription ){
                $prescription_report = new PrescriptionReport();

                $prescription_report->prescription_id = $prescription->id;
                
                if( $request->hasFile('file') ){
                    $image = $request->file('file');
                    $img = Carbon::now()->toDateString().'.'. $request['description'] .'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/report/'.$img);
                    Image::make($image)->save($location);
                    $prescription_report->image = $img;
                }

                $prescription_report->name = $request['description'];

                if( $prescription_report->save() ){
                    return response()->json([
                        'status' => 'success',
                        'body' => [
                            'message' => $request['description'] . " Report Uploaded"
                        ]
                    ],200); 
                }
            }
            else{
                return response()->json([
                    'status' => 'error',
                    'body' => [
                        'message' => 'No Prescription Found'
                    ]
                ],200); 
            }
            
        }
        catch( Exception $e ){
            return response()->json([
                'status' => 'error',
                'body' => [
                    'message' => $e->getMessage()
                ]
            ],200); 
        }
    }
    //create report function end


    //edit report function start
    public function report_edit(Request $request){
        try{
            
            $prescription_report = PrescriptionReport::where("id",$request->report_id)->first();

            if( $prescription_report ){
                
                if( $request->hasFile('file') ){

                    if( File::exists("images/report/".$prescription_report->image) ){
                        File::delete("images/report/".$prescription_report->image);
                    }

                    $image = $request->file('file');
                    $img = Carbon::now()->toDateString().'.'. $request['description'] .'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/report/'.$img);
                    Image::make($image)->save($location);
                    $prescription_report->image = $img;
                }

                $prescription_report->name = $request['description'];

                if( $prescription_report->save() ){
                    return response()->json([
                        'status' => 'success',
                        'body' => [
                            'message' => $request['description'] . " Report Updated"
                        ]
                    ],200); 
                }
            }
            else{
                return response()->json([
                    'status' => 'error',
                    'body' => [
                        'message' => 'No Report Found'
                    ]
                ],200); 
            }
            
        }
        catch( Exception $e ){
            return response()->json([
                'status' => 'error',
                'body' => [
                    'message' => $e->getMessage()
                ]
            ],200); 
        }
    }
    //edit report function end


    //delete report function start
    public function report_delete(Request $request){
        try{
            
            $prescription_report = PrescriptionReport::where("id",$request->report_id)->first();

            if( $prescription_report ){

                if( File::exists("images/report/".$prescription_report->image) ){
                    File::delete("images/report/".$prescription_report->image);
                }

                if( $prescription_report->delete() ){
                    return response()->json([
                        'status' => 'success',
                        'body' => [
                            'message' => $request['description'] . " Report Deleted"
                        ]
                    ],200); 
                }
            }
            else{
                return response()->json([
                    'status' => 'error',
                    'body' => [
                        'message' => 'No Prescription Found'
                    ]
                ],200); 
            }

        }
        catch( Exception $e ){
            return response()->json([
                'status' => 'error',
                'body' => [
                    'message' => $e->getMessage()
                ]
            ],200); 
        }
    }
    //delete report function end


    //all test function start
    public function all_test(Request $request){
        $patient = Patient::where("id",$request->id)->select("id")->first();

        if( $patient ){
            $appoinments = Appoinment::where("patient_id",$patient->id)->select("id")->get();
            $prescriptions = Prescription::whereIn("appoinment_id",$appoinments)->select("id")->get();
            $prescription_report = PrescriptionReport::whereIn("prescription_id",$prescriptions)->select("prescription_id","image","name","created_at")->get();

            return response()->json([
                'status' => 'success',
                'body' => new PrescriptionReportResourceCollection($prescription_report)
            ],200);            

        }
        else{
            return response()->json([
                'status' => 'error',
                'body' => [
                    'message' => 'No patient found'
                ]
            ],200); 
        }

    }
    //all test function end


    //prescription list start
    public function prescription_list(Request $request){
        $appoinment = Appoinment::where("patient_id",$request->id)->select("id")->first(); 
        
        if( $appoinment ){
            $prescription_list = Prescription::where("appoinment_id",$appoinment->id)->get();
  
            if( $prescription_list->count() > 0 ){
                return response()->json([
                    'status' => 'success',
                    'body' => new PrescriptionResourceCollection($prescription_list)
                ],200);
            }
            else{
                return response()->json([
                    'status' => 'error',
                    'body' => [
                        'message' => 'No Prescription Found'
                    ]
                ],200);
            }
        }
        else{
            return response()->json([
                'status' => 'error',
                'body' => [
                    'message' => 'No Appoinment Found'
                ]
            ],200);
        }

        
  
    }
    //prescription list end
  
    //password reset api start
    public function password_reset(Request $request){
  
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            
            $patient = Patient::where("id",$request->id)->first();

            if( $patient ){
                if (Hash::check($request->old_password, $patient->password)){
                    $patient->password = Hash::make($request->password);

                    if( $patient->save() ){
                        return response()->json([
                            'status' => 'success',
                            'body' => [
                                'message' => 'Password Reset Successfully.'
                            ]
                        ], 200);
                    }
                }
                else{
                    return response()->json([
                        'status' => 'error',
                        'body' => [
                            'message' => 'Old Password Does not Match'
                        ]
                    ],200);
                }
                
            }
            else{
                return response()->json([
                    'status' => 'error',
                    'body' => [
                        'message' => 'Patient not found'
                    ]
                ],200);
            }
        }
         
  
    }
     
    //patient_profile_update start 
    public function patient_profile_update(Request $request){
        
        $validator = Validator::make($request->all(), [
            "full_name" => "required",
            "email" => "required|unique:patients,email,".$request['patient_id'],
            "mobile" => "required|numeric|regex:/(01)[0-9]{9}/|unique:patients,phone,".$request['patient_id'],
            "date_of_birth" => "required",
            "blood_group" => "required",
            "gender" => "required",
            "city" => "required",
            "district" => "required",
            "address" => "required",
        ]);
        
        

        if( $validator->fails() ){
            return response()->json([
                            'status' => 'error',
                            'body' => 'Validation Error'
                        ], 200);
        }else{
                        
            $patient = Patient::find($request['patient_id']);
            if($patient){
                $patient->name = $request['full_name'];
                $patient->email  = $request['email'];
                $patient->phone   = $request['mobile'] ;
                $patient->date_of_birth   =  $request['date_of_birth'];
                $patient->blood_group   = $request['blood_group'] ;
                $patient->gender   = $request['gender'] ;
                $patient->address   = $request['address'] ;
                $patient->city   = $request['city'] ;
                $patient->district   = $request['district'] ;

                if( $request->file('file') ){
                    if( File::exists('images/profile/patient/'. $patient->image) ){
                        File::delete('images/profile/patient/'. $patient->image);
                    }
                    $image = $request->file('file');
                    $img = Carbon::now()->toDateString().'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/profile/patient/'.$img);
                    Image::make($image)->save($location);
                    $patient->image = $img;
                }

                if( $patient->save() ){
                    return response()->json([
                        'status' => 'success',
                        'body' => [
                            'message' => 'Patient Profile Updated Successfully.',
                            'patient' => new PatientResource($patient) ,
                        ]
                    ], 200);
                }
            }
            else{
                return response()->json([
                    'status' => 'error',
                    'body' => [
                        'message' => 'Patient Not Found !'
                    ]
                ],200);
            }
            
        }
    }
    //patient_profile_update ends


    //all medecine route start
    public function medecine_all(Request $request){
        $patient = Patient::where("id",$request->patient_id)->select("id")->first();

        if( $patient ){
            $appoinments = Appoinment::where("patient_id",$patient->id)->select("id")->get();
            $prescriptions = Prescription::whereIn("appoinment_id",$appoinments)->select("id")->get();
            $prescription_medecines = PrescriptionMedicine::whereIn("prescription_id",$prescriptions)->with("medicine")->select("medicine_id","type","timing","note")->get();

            //All medicine data get start
            $medicine = [];
            foreach( $prescription_medecines as $prescription_medicine ){

                if( $prescription_medicine->type == "Mark" || $prescription_medicine->type == "Drop" ){
                    $times = "";
                    $meal = "";
                    $span = "";
                    foreach( unserialize($prescription_medicine->timing) as $timings ){
                        foreach( $timings as $key => $timing ){
                            if( $timing['value'] == 'Timming' ){
                                $meal = Timing::where("id",$timing['id'])->select('value')->first()->value;
                                
                            }
                            elseif( $timing['value'] == 'Running' ){
                                $span = Timing::where("id",$timing['id'])->select('value')->first()->value;
                            }
                            else{
                                $times .= Timing::where("id",$timing['id'])->select('value')->first()->value . 
                                ( ( $key < 2 ) ? '+' :  "");
                            }
                        }
                        array_push($medicine,[
                            'name' => Medicine::where("id",$prescription_medicine->medicine_id)->select("name")->first()->name,
                            'type' => $prescription_medicine->type,
                            'timing' => $times,
                            'meal' => $meal,
                            'span' => $span,
                        ]);
                    }
                }
                else{
                    array_push($medicine,[
                        'name' => $prescription_medicine->medicine->name,
                        'type' => $prescription_medicine->type,
                        'timing' => $prescription_medicine->note,
                        'meal' => "",
                        'span' => "",
                    ]);
                }
               
            }
            //All medicine data get end

            return response()->json([
                'status' => 'success',
                'medicine' => $medicine,
            ], 200);
        }
        else{
            return response()->json([
                'status' => 'error',
                'body' => [
                    'message' => 'Patient Not Found !'
                ]
            ],200);
        }

    }
    //all medecine route end

    
    //patient_forgot_password api start
    public function patient_forgot_password(Request $request)
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
                    return response()->json([
                        'status' => 'success',
                        'body' => [
                            'message' => 'We send you a password reset link in your given email address.'
                        ]
                    ], 200);
                    
                }
                else{
                    return response()->json([
                        'status' => 'error',
                        'body' => [
                            'message' => 'Patient Not Found.'
                        ]
                    ], 200);
                }
            }
            catch( Exception $e ){
                return response()->json([
                    'status' => 'error',
                    'body' => [
                        'message' => $e->getMessage()
                    ]
                ], 200);
            }

        }

    }
    //patient_forgot_password api ends


    //content data funciton start
    public function content(){
        try{
            $app_info = AppInfo::first();
            $home = Home::first(); 

            if( $app_info && $home ){
                $content = [
                    'logo' => asset("images/info/".$app_info->logo),
                    'title' => $home->title,
                    'about_title' => $home->about_title,
                    'about_description' => $home->about_description,
                    'about_image' => asset("images/home/".$home->about_image),
                    'address' => $app_info->address,
                    'email' => $app_info->email,
                    'phone' => $app_info->phone,
                    'facebook_url' => $app_info->facebook_url,
                    'twitter_url' => $app_info->twitter_url,
                    'linkedin_url' => $app_info->linkedin_url,
                    'satisfied_patient' => $home->satisfied_patient,
                    'patient_per_year' => $home->patient_per_year,
                ];
                return response()->json([
                    'status' => 'success',
                    'body' => $content,
                ], 200);
            }
            else{
                return response()->json([
                    'status' => 'error',
                    'body' => 'No data found',
                ], 200);
            }
            
        }
        catch( Exception $e ){
            return response()->json([
                'status' => 'error',
                'body' => [
                    'message' => $e->getMessage()
                ]
            ], 200);
        }
    }
    //content data funciton end

}
