<?php

namespace App\Http\Controllers\Frontend\Profile\Patient;

use App\Http\Controllers\Controller;
use App\Models\AppoinmentModule\Appoinment;
use App\Models\AppoinmentModule\AppoinmentInitialTest;
use App\Models\AppoinmentModule\Prescription;
use App\Models\AppoinmentModule\PrescriptionReport;
use App\Models\TestModule\InitialTest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class AppoinmentController extends Controller
{
     //appoinment details page function start
     public function details_page($appoinment_no){
        $appoinment = Appoinment::where("appoinment_no", $appoinment_no)->first();  
        
        if( $appoinment ){
            $patient = $appoinment->patient;
            $notes = $appoinment->note;
            $initial_test_timing = AppoinmentInitialTest::where("appoinment_id",$appoinment->id)->select("created_at")->distinct('created_at')->first();
    
            return view("frontend.pages.profile.patient.pages.appoinment.details", compact("appoinment", "patient","notes",'initial_test_timing'));
        }
        else{
            return view("errors.404");
        }
    }
    //appoinment details page function end

     //all prescription start
     public function all_prescription($appoinment_no){
        
        if(auth('patient')->check()){
            $appoinment = Appoinment::where("appoinment_no", $appoinment_no)->first();  
            if( $appoinment ){
                $prescriptions = Prescription::orderBy("id","desc")->where("appoinment_id",$appoinment->id)->paginate(10);
                return view("frontend.pages.profile.patient.pages.appoinment.prescription.all", compact("appoinment","prescriptions"));
            }
            else{
                return view("errors.404");
            }
        }
        else{
            return view("errors.404");
        }
        
    }
    //all prescription end


    //search all appoinment function start
    public function search_all_appoinment(Request $request){
        $searchInput = $request->search;
        if($searchInput){ 

            $query = Appoinment::select("id","appoinment_no","appoinment_date","total","status","payment_status","doctor_id","patient_id")
                            ->where('appoinment_no', 'like', '%'.$searchInput.'%')
                            ->orWhere('appoinment_date', 'like', '%'.$searchInput.'%')
                            ->orWhere('total', 'like', '%'.$searchInput.'%')
                            ->orWhere('status', 'like', '%'.$searchInput.'%')
                            ->orWhere('payment_status', 'like', '%'.$searchInput.'%')
                            ->orderBy("id","desc")
                            ->take(20)
                            ->get();

            $searchResult = $query->where("patient_id",$request->patient);

            if( $searchResult){
                return response()->json(['searchResult'=> $searchResult], 200);
            }
                            
        }
        else{
            $searchResult = Appoinment::where("patient_id",$request->patient)->orderBy("id","desc")->select("id","appoinment_no","appoinment_date","total","status","payment_status","doctor_id","patient_id")->take(20)->get();
            return response()->json(['searchResult'=> $searchResult ], 200);
        }
    }
    //search all appoinment function end


    //search today's appoinment function start
    public function search_today_appoinment(Request $request){
        $searchInput = $request->search;
        if($searchInput){ 

            $query = Appoinment::select("id","appoinment_no","appoinment_date","total","status","payment_status","doctor_id","patient_id")
                            ->where('appoinment_no', 'like', '%'.$searchInput.'%')
                            ->orWhere('appoinment_date', 'like', '%'.$searchInput.'%')
                            ->orWhere('total', 'like', '%'.$searchInput.'%')
                            ->orWhere('status', 'like', '%'.$searchInput.'%')
                            ->orWhere('payment_status', 'like', '%'.$searchInput.'%')
                            ->orderBy("id","desc")
                            ->take(20)
                            ->get();

            $searchResult = $query->where("patient_id",$request->patient);
            $searchResult = $query->where("appoinment_date",Carbon::now()->toDateString());
            
            if( $searchResult){
                return response()->json(['searchResult'=> $searchResult], 200);
            }
                            
        }
        else{
            $searchResult = Appoinment::where("appoinment_date",Carbon::now()->toDateString())->where("patient_id",$request->patient)->orderBy("id","desc")->select("id","appoinment_no","appoinment_date","total","status","payment_status","doctor_id","patient_id")->take(20)->get();
            return response()->json(['searchResult'=>$searchResult], 200);
        }
    }
    //search today's appoinment function end


    //view prescription function start
    public function view_prescription($prescription_no){
       
        $prescription = Prescription::where("prescription_no",$prescription_no)->first();
        $appoinment = Appoinment::where("id", $prescription->appoinment_id)->first(); 
        if( $prescription && $appoinment ){
            return view("frontend.pages.profile.patient.pages.appoinment.prescription.view", compact("prescription","appoinment"));
        }
        else{
            return view("errors.404");      
        }
    }

    //view prescription function end


    //add prescription form report start
    public function add_report_form($prescription_no){
       $prescription = Prescription::where("prescription_no",$prescription_no)->first();
       $appoinment = Appoinment::where("id", $prescription->appoinment_id)->first(); 
       if( $prescription && $appoinment ){
           return view("frontend.pages.profile.patient.pages.appoinment.prescription.report.add", compact("prescription","appoinment"));
       }
       else{
           return view("errors.404");      
       }
   }
    //add prescription form report end

    //add prescription report start
    public function add_report(Request $request, $prescription_no){
        $prescription_no = Prescription::where("prescription_no",$prescription_no)->first();
        
        $validator = Validator::make($request->all(), [
            "name.*" => "required",
            'image.*' => 'mimes:jpeg,jpg,png,gif,pdf|max:2048'
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{               
                
                if( $request['image'] ){
                    foreach( $request['image'] as $key => $image ){
                        
                        $prescription_report = new PrescriptionReport();
                        $prescription_report->name = $request['name'][$key];
                        $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                        $location = public_path('images/report/'.$img);
                        Image::make($image)->save($location);
                        $prescription_report->image = $img;
                        $prescription_report->prescription_id = $prescription_no->id;

                        $prescription_report->save();
                    }
                    
                    $url = route('patient.perscription.report.view',['prescription_id'=>$prescription_report->prescription_id , 'appoinment_id' =>$prescription_report->prescription->appoinment->appoinment_no]);
                    return response()->json([
                        'redirect_message' => 'Report Added',
                        'redirect' => $url,
                    ],200);
                    
                }

            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }

    }
    //add prescription report end


    // all_individual_report function start
    public function view_all_individual_report($prescription_id, $appoinment_id){
        $prescription_reports = PrescriptionReport::where("prescription_id",$prescription_id)->get();
        $appoinment = Appoinment::where("appoinment_no", $appoinment_id)->first();
        if( $prescription_reports && $appoinment){
            return view("frontend.pages.profile.patient.pages.appoinment.prescription.report.all_individual_report", compact("prescription_reports","appoinment"));
        }
        else{
            return view("errors.404");      
        }
    }

    // all_individual_report function end


    //edit prescription page function start
    public function edit_report_page($prescription_report_id , $appoinment_no){          
           
             $prescription_report = PrescriptionReport::where("id",$prescription_report_id)->first();         
             $appoinment = Appoinment::where("appoinment_no", $appoinment_no)->first();
            if( $prescription_report){
                return view("frontend.pages.profile.patient.pages.appoinment.prescription.report.edit", compact("prescription_report" , "appoinment"));
            }
            else{
                return view("errors.404");      
            }     
        
    }
    //edit prescription report page function end

    // update report start
    public function edit_report(Request $request , $id ){
        
        $validator = Validator::make($request->all(), [
            "name.*" => "required",
            'image.*' => 'mimes:jpeg,jpg,png,gif,pdf|max:2048'
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $prescription_report = PrescriptionReport::find($id);
                $prescription_report->name = $request->name;

                if( $request->image ){
                    if( File::exists('images/report/'. $prescription_report->image) ){
                        File::delete('images/report/'. $prescription_report->image);
                    }
                    $image = $request->file('image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/report/'.$img);
                    Image::make($image)->save($location);
                    $prescription_report->image = $img;
                }

                if( $prescription_report->save() ){
                    $url = route('patient.perscription.report.view',['prescription_id'=>$prescription_report->prescription_id , 'appoinment_id' =>$prescription_report->prescription->appoinment->appoinment_no]);
                    return response()->json([
                        'redirect_message' => 'Report Updated',
                        'redirect' => $url,
                    ],200);
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }
    // update report start

    
    //delete prescription report modal
    public function delete_modal($id){                
        $prescription_id = PrescriptionReport::where("id",$id)->select("id")->first();
        return view("frontend.pages.profile.patient.pages.appoinment.prescription.report.delete_modal", compact("prescription_id"));      
       
        }
    // end delete modal

    //prescription report delete function start    
    public function delete($id){
      
        $report = PrescriptionReport::find($id);       

        if( File::exists('images/report/'. $report->image) ){
            File::delete('images/report/'. $report->image);
            } 
            $report->delete();

        session()->flash('success' , 'Prescription Report Deleted Successfully...');
        return back();
       
    }
   //prescription report delete function end

    //view billing function start
    public function view_billing($prescription_no){
        $prescription = Prescription::where("prescription_no",$prescription_no)->first();
        $appoinment = Appoinment::where("id", $prescription->appoinment_id)->first(); 
        if( $prescription && $appoinment ){
            return view("frontend.pages.profile.patient.pages.appoinment.prescription.billing", compact("prescription","appoinment"));
        }
        else{
            return view("errors.404");      
        }
    }
    //view billing function end

}
