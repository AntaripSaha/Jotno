<?php

namespace App\Http\Controllers\Backend\AppointmentModule;

use App\Http\Controllers\Controller;
use App\Models\AppoinmentModule\Appoinment;
use App\Models\AppoinmentModule\Prescription;
use App\Models\AppoinmentModule\PrescriptionReport;
use App\Models\TestModule\InitialTest;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(){
        $appointments = Appoinment::orderBy("id","desc")->select("appoinment_no","appoinment_date","total","status","payment_status")->paginate(20);
        return view('backend.modules.appointment_module.index', compact('appointments'));
    }

    //ajax search method
    public function search(Request $request){
      $searchInput = $request->get('search');
        if($searchInput){ 
            
            $searchResult = Appoinment::select("appoinment_no","appoinment_date","total","status","payment_status")
                            ->where('appoinment_no', 'like', '%'.$searchInput.'%')
                            ->orWhere('appoinment_date', 'like', '%'.$searchInput.'%')
                            ->orWhere('total', 'like', '%'.$searchInput.'%')
                            ->orWhere('status', 'like', '%'.$searchInput.'%')
                            ->orWhere('payment_status', 'like', '%'.$searchInput.'%')
                            ->orderBy("id","desc")
                            ->take(20)
                            ->get();

            if( $searchResult){
                return response()->json(['searchResult'=>$searchResult], 200);
            }
                            
        }
        else{
            $searchResult = Appoinment::orderBy("id","desc")->select("appoinment_no","appoinment_date","total","status","payment_status")->take(20)->get();
            return response()->json(['searchResult'=>$searchResult], 200);
        }
    }

    // view_individual_prescription function start
    public function view_individual_prescription($appointment){
        
       $appoinment = Appoinment::where("appoinment_no", $appointment)->first();
       $prescription = Prescription::where("appoinment_id",$appoinment->id)->first();
	   
        if( $prescription && $appoinment){
            return view("backend.modules.appointment_module.view_individual_prescription", compact("appoinment","prescription"));
        }
        else{
            $appoinment = Appoinment::where("appoinment_no", $appointment)->first();
            return view("backend.modules.appointment_module.no-prescription", compact("appoinment"));     
        }
    }
    // view_individual_prescription function end


    //view_individual_appointment function start
    public function view_appointment_details($appoinment_no){
        $appoinment = Appoinment::where("appoinment_no", $appoinment_no)->first();  

        if( $appoinment ){
            $patient = $appoinment->patient;
            $appoinment_initial_tests = $appoinment->initial_test;
            $notes = $appoinment->note;

            $initial_tests = InitialTest::where("is_active",true)->select("id","name")->get();
    
            return view("backend.modules.appointment_module.details", compact("appoinment", "patient","appoinment_initial_tests","initial_tests",'notes'));
        }
        else{
            return view("errors.404");
        }
    }
    //view_individual_appointment function end


    //cancel appoinment function start
    public function appointment_cancel($appoinment_no){
        $appoinment = Appoinment::where("appoinment_no", $appoinment_no)->first();
        if( $appoinment ){
            $appoinment->status = "Cancel";
            if( $appoinment->save() ){
                return back()->with("success","Appoinment Cancelled");
            }
        }
        else{
            return view("errors.404");
        }
    }
    //cancel appoinment function end


    //appointment_view_billing function start    

        public function appointment_view_billing($prescription_no){
            $prescription = Prescription::where("prescription_no",$prescription_no)->first();
            $appoinment = Appoinment::where("id", $prescription->appoinment_id)->first(); 
            if( $prescription && $appoinment ){
                return view("backend.modules.appointment_module.billing", compact("prescription","appoinment"));
            }
            else{
                return view("errors.404");      
            }
        }

        //appointment_view_billing function end

        
        //appointment_prescription_report start
        public function appointment_prescription_report($prescription_id, $appoinment_id){
            
            $prescription_reports = PrescriptionReport::where("prescription_id",$prescription_id)->paginate(10);
            $appoinment = Appoinment::where("appoinment_no", $appoinment_id)->first();
            if( $prescription_reports && $appoinment){
                return view("backend.modules.appointment_module.all_individual_report", compact("prescription_reports","appoinment"));
            }
            else{
                return view("errors.404");      
            }
        }
        //appointment_prescription_report end



    }
