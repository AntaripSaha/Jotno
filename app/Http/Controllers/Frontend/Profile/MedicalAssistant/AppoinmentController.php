<?php

namespace App\Http\Controllers\Frontend\Profile\MedicalAssistant;

use App\Http\Controllers\Controller;
use App\Models\AppoinmentModule\Appoinment;
use App\Models\AppoinmentModule\AppoinmentInitialTest;
use App\Models\AppoinmentModule\AppoinmentNote;
use App\Models\AppoinmentModule\Prescription;
use App\Models\AppoinmentModule\PrescriptionChiefComplaint;
use App\Models\AppoinmentModule\PrescriptionMedicine;
use App\Models\AppoinmentModule\PrescriptionReport;
use App\Models\AppoinmentModule\PrescriptionTest;
use App\Models\AppoinmentModule\Timing;
use App\Models\TestModule\ChiefComplaint;
use App\Models\TestModule\InitialTest;
use App\Models\TestModule\Medicine;
use App\Models\TestModule\TestType;
use App\Models\TestModule\TestTypeList;
use App\Models\UserModule\Doctor;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class AppoinmentController extends Controller
{


    //view modal function start
    public function view_modal($id)
    {
        $appoinment = Appoinment::where("id", $id)->select("id", "status", "appoinment_no", "appoinment_date", "total", "patient_id","doctor_id")->first();
        $patient = $appoinment->patient;
        $notes = $appoinment->note;
        return view("frontend.pages.profile.medical_assistant.modals.view", compact("appoinment", "patient", "notes"));
    }
    //view modal function end



    //note_modal function start
    public function note_modal($id)
    {
        $appoinment = Appoinment::where("id", $id)->select("id", "status", "appoinment_no", "appoinment_date","doctor_id")->first();

        if ($appoinment) {
            return view("frontend.pages.profile.medical_assistant.modals.note", compact("appoinment"));
        } else {
            return "Invalid Appoinment";
        }
    }
    //note_modal function end


    //note function start
    public function note(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "appoinment_date" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            try {
                $appoinment = Appoinment::find($id);
                $appoinment->appoinment_date = $request->appoinment_date;
                $appoinment->status = "Confirm";

                if ($appoinment->save()) {

                    if ($request->note) {
                        if (auth('medical_assistant')->check()) {

                            $appoinment_note = new AppoinmentNote();
                            $appoinment_note->appoinment_id  = $appoinment->id;
                            $appoinment_note->note  = $request->note;
                            $appoinment_note->created_by  = auth('medical_assistant')->user()->id;
                            $appoinment_note->type  = "MA";
                            $appoinment_note->save();
                            return response()->json(['success' => 'Note added'], 200);

                        }
                    }

                    return response()->json(['success' => 'Updated Successfully'], 200);
                }
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }
    //note function end


    //cancel modal function start
    public function cancel_modal($id){
        $appoinment = Appoinment::where("id", $id)->select("id", "status", "appoinment_no")->first();

        if ($appoinment) {
            return view("frontend.pages.profile.medical_assistant.modals.cancel", compact("appoinment"));
        } else {
            return "Invalid Appoinment";
        }

    }
    //cancel modal function end


    //cancel appoinment function start
    public function cancel($id){
        $appoinment = Appoinment::where("id", $id)->first();

        if ($appoinment) {
            $appoinment->status = "Cancel";
            if( $appoinment->save() ){
                return back()->with("success","Appoinment Cancelled");
            }
        }
        else {
            return back()->with("error","Invalid Appoinment");
        }

    }
    //cancel appoinment function end


    //appoinment details page function start
    public function details_page($appoinment_no){
        $appoinment = Appoinment::where("appoinment_no", $appoinment_no)->first();  

        if( $appoinment ){
            $patient = $appoinment->patient;
            $appoinment_initial_tests = $appoinment->initial_test;
            $notes = $appoinment->note;

            $current_time = (string) Carbon::now()->format("H:i");
            $doctors = Doctor::where("is_active", true)
                ->where("id","!=",$appoinment->doctor_id)
                ->where("is_available", true)
                ->where("in","<=",$current_time)
                ->where("out",">=",$current_time)
                ->select("id","name","charge_id")
                ->get();

            $assign_doctor = Doctor::where("id",$appoinment->doctor_id)->select("id","name","charge_id")
            ->get();

            $initial_tests = InitialTest::where("is_active",true)->select("id","name")->get();
    
            return view("frontend.pages.profile.medical_assistant.pages.appoinment.details", compact("appoinment", "patient","appoinment_initial_tests","doctors","assign_doctor","initial_tests",'notes'));
        }
        else{
            return view("errors.404");
        }
    }
    //appoinment details page function end


    //appoinment initial test data function start
    public function appoinment_initial_test_data($appoinment_no){
        $appoinment = Appoinment::where("appoinment_no", $appoinment_no)->first(); 

        if( $appoinment ){

            $appoinment_initial_test = $appoinment->initial_test;

            return DataTables::of($appoinment_initial_test)
            ->rawColumns(['action', 'test_name','value'])
            ->editColumn('test_name', function ($appoinment_initial_test) {
                return $appoinment_initial_test->initial_test->name;
            })
            ->editColumn('value', function ($appoinment_initial_test) {
                return $appoinment_initial_test->value;
            })
            ->addColumn('action', function ($appoinment_initial_test) {
                return '

                    <button type="button" data-content="'.route('medical.assistant.appoinment.initial.test.edit.modal',$appoinment_initial_test->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                        <i class="fas fa-edit"></i>
                    </button>

                    <button type="button" data-content="'.route('medical.assistant.appoinment.initial.test.delete.modal',$appoinment_initial_test->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                        <i class="fas fa-trash"></i>
                    </button>

                ';
            })
            ->make(true);

        }
        else{
            return view("errors.404");
        }
    }
    //appoinment initial test data function end


    //appoinment initial test modal start
    public function appoinment_initial_test($appoinment_no, Request $request){

        if( $request->assign_doctor == true ){
            $request->validate([
                "doctor_id" => "required", 
            ]);
        }
        else{
            $request->validate([
                "doctor_id" => "required", 
                "initial_test_id.*" => "required", 
                "test_value.*" => "required", 
            ]);
        }
        

        
        try{
            $appoinment = Appoinment::where("appoinment_no", $appoinment_no)->first();  

            if( $appoinment ){
                $appoinment->doctor_id = $request->doctor_id;
                $appoinment->save();

                if( $request->assign_doctor == false ){
                    if( $request['initial_test_id'] ){
                        foreach( $request['initial_test_id'] as $key => $initial_test_id ){
                            $appoinment_initial_test = new AppoinmentInitialTest();
                            $appoinment_initial_test->appoinment_id = $appoinment->id;
                            $appoinment_initial_test->initial_test_id  = $initial_test_id;
                            $appoinment_initial_test->value  = $request['test_value'][$key];
                            $appoinment_initial_test->save();
                        }
                        return back()->with('success','Initial Test Added');
                    }
                }
                return back()->with('success','Doctor Assigned');
            }
            else{
                return back()->with('error','Invalid Appoinment');
            }
        }
        catch( Exception $e ){
            return back()->with('error',$e->getMessage());
        }

    }
    //appoinment initial test modal end


    //edit modal 
    public function appoinment_initial_test_edit_modal($id){
        $appoinment_initial_test = AppoinmentInitialTest::find($id);
        $current_time = (string) Carbon::now()->format("H:i");
        $doctors = Doctor::where("is_active", true)
            ->where("id","!=",$appoinment_initial_test->appoinment->doctor_id)
            ->where("is_available", true)
            ->where("in","<=",$current_time)
            ->where("out",">=",$current_time)
            ->select("id","name","phone")
            ->get();

        $assign_doctor = Doctor::where("id",$appoinment_initial_test->appoinment->doctor_id)->select("id","name","phone")
        ->get();

        $initial_tests = InitialTest::where("is_active",true)->select("id","name")->get();

        return view("frontend.pages.profile.medical_assistant.modals.edit", compact("appoinment_initial_test","doctors","assign_doctor","initial_tests"));
    }

    //edit 
    public function appoinment_initial_test_edit($id,Request $request){
        $validator = Validator::make($request->all(),[
            "initial_test_id" => "required", 
            "test_value" => "required", 
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()],422);
        }
        else{
            try{
                $appoinment_initial_test = AppoinmentInitialTest::find($id);
                $appoinment = Appoinment::where("id", $appoinment_initial_test->appoinment_id)->first();  

                if( $appoinment && $appoinment_initial_test ){
                    
                    $appoinment_initial_test->initial_test_id = $request->initial_test_id;
                    $appoinment_initial_test->value  = $request->test_value;
                    $appoinment_initial_test->save();

                    return response()->json(['success' => 'Initial Test Updated'],200);
                    
                }
                else{
                    return response()->json(['error' => 'Invalid Appoinment'],200);
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()],200);
            }
        }
    }


    //delete modal 
    public function appoinment_initial_test_delete_modal($id){
        $appoinment_initial_test = AppoinmentInitialTest::find($id);
        return view("frontend.pages.profile.medical_assistant.modals.delete", compact("appoinment_initial_test"));
    }


    //delete 
    public function appoinment_initial_test_delete($id){
        try{
            $appoinment_initial_test = AppoinmentInitialTest::find($id);
            if( $appoinment_initial_test->delete() ){
                return response()->json(['success' => 'Initial Test Removed'],200);
            }
        }
        catch(Exception $e ){
            return response()->json(['error' => $e->getMessage()],200);
        }
    }


    //view page function start
    public function create_page($appoinment_no)
    {
        $appoinment = Appoinment::where("appoinment_no", $appoinment_no)->first();  

        if( $appoinment && $appoinment->prescription->count() < 1 ){
            $test_types = TestType::orderBy("id", "desc")->where("is_active", true)->select("id", "name")->get();
            $medicines = Medicine::where("is_active",true)->select("id","name")->get();
            $timings = Timing::where("is_active",true)->get();
            $chief_complaints = ChiefComplaint::where("is_active",true)->select("id","name")->get();
            return view("frontend.pages.profile.medical_assistant.pages.appoinment.prescription.create", compact("appoinment", "test_types","medicines","timings","chief_complaints"));
        }
        else{
            return view("errors.404");
        }
    }
    //view page function end


    //add prescription function start
    public function add_prescription($appoinment_no,Request $request){
        

        try{

            $prescription = new Prescription();
            $rand = rand(000000,999999);
            $appoinment = Appoinment::where("appoinment_no",$appoinment_no)->select("id")->first();
            $prescription->prescription_no = $rand;
            $prescription->appoinment_id  = $appoinment->id;
            $prescription->created_by  = auth('medical_assistant')->user()->id;
            $prescription->type  = "MA";
            $prescription->advice  = $request->advice;

            if( $prescription->save() ){
                
                //chief complaint start
                if( $request['chief_complaint_id'] ){
                    foreach( $request['chief_complaint_id'] as $chief_complaint_id ){
                        $prescription_chief_complaint = new PrescriptionChiefComplaint();
                        $prescription_chief_complaint->prescription_id = $prescription->id;
                        $prescription_chief_complaint->chief_complaint_id = $chief_complaint_id;
                        $prescription_chief_complaint->save();
                    }
                }
                //chief complaint end

                //test create start
                $test_types = TestType::where("is_active",true)->select("id")->get();
                foreach( $test_types as $test_type ){
                    $name = $test_type->id . "_test_type_list_id";
                    $prescription_test = new PrescriptionTest();
                    $prescription_test->prescription_id = $prescription->id;
                    $prescription_test->test_type_id = $test_type->id;
                    $prescription_test->test_type_list = serialize($request[$name]);
                    $prescription_test->save();
                }
                //test create end

                //medicine create for prescription
                if( $request['medicine_id_mark'] ){
                    foreach( $request['medicine_id_mark'] as $key => $medicine_id_mark ){

                        $data = [];
                        $prescription_medicine = new PrescriptionMedicine();
                        $prescription_medicine->prescription_id  = $prescription->id;

                        //if medicine exists or not
                        $medicine = $medicine = Medicine::where("id",$medicine_id_mark)->first();
                        if( $medicine ){
                            $prescription_medicine->medicine_id   = $medicine->id;
                        }
                        else{
                            $medicine = new Medicine();
                            $medicine->name = $medicine_id_mark;
                            $medicine->slug = Str::slug($medicine_id_mark);
                            $medicine->is_active      = true;
                            if( $medicine->save() ){
                                $prescription_medicine->medicine_id   = $medicine->id;
                            }
                        }
                        

                        $prescription_medicine->type   = "Mark";
                        

                        array_push($data,[
                            [
                                "id" => $request['morning_mark'][$key],
                                "value" => "Morning", 
                            ],
                            [
                                "id" => $request['noon_mark'][$key],
                                "value" => "Noon", 
                            ],
                            [
                                "id" => $request['night_mark'][$key],
                                "value" => "Night", 
                            ],
                            [
                                "id" => $request['time_mark'][$key],
                                "value" => "Timming", 
                            ],
                            [
                                "id" => $request['running_mark'][$key],
                                "value" => "Running", 
                            ],
                        ]);

                        $prescription_medicine->timing   = \serialize($data);
                        $prescription_medicine->note   = null;
                        $prescription_medicine->save();
                        
                    }
                }
                if( $request['medicine_id_or'] ){
                    foreach( $request['medicine_id_or'] as $key => $medicine_id_or ){
                        $prescription_medicine = new PrescriptionMedicine();
                        $prescription_medicine->prescription_id  = $prescription->id;

                        //if medicine exists or not
                        $medicine = $medicine = Medicine::where("id",$medicine_id_or)->first();
                        if( $medicine ){
                            $prescription_medicine->medicine_id   = $medicine->id;
                        }
                        else{
                            $medicine = new Medicine();
                            $medicine->name = $medicine_id_or;
                            $medicine->slug = Str::slug($medicine_id_or);
                            $medicine->is_active      = true;
                            if( $medicine->save() ){
                                $prescription_medicine->medicine_id   = $medicine->id;
                            }
                        }

                        $prescription_medicine->type   = "OR";
                        $prescription_medicine->timing   = null;
                        $prescription_medicine->note   = $request['or'][$key];
                        $prescription_medicine->save();
                    }
                }
                if( $request['medicine_id_drop'] ){
                    foreach( $request['medicine_id_drop'] as $key => $medicine_id_drop ){
                        $data = [];
                        $prescription_medicine = new PrescriptionMedicine();
                        $prescription_medicine->prescription_id  = $prescription->id;

                        //if medicine exists or not
                        $medicine = $medicine = Medicine::where("id",$medicine_id_drop)->first();
                        if( $medicine ){
                            $prescription_medicine->medicine_id   = $medicine->id;
                        }
                        else{
                            $medicine = new Medicine();
                            $medicine->name = $medicine_id_drop;
                            $medicine->slug = Str::slug($medicine_id_drop);
                            $medicine->is_active      = true;
                            if( $medicine->save() ){
                                $prescription_medicine->medicine_id   = $medicine->id;
                            }
                        }

                        $prescription_medicine->type   = "Drop";

                        array_push($data,[
                            [
                                "id" => $request['morning_drop'][$key],
                                "value" => "Morning", 
                            ],
                            [
                                "id" => $request['noon_drop'][$key],
                                "value" => "Noon", 
                            ],
                            [
                                "id" => $request['night_drop'][$key],
                                "value" => "Night", 
                            ],
                            [
                                "id" => $request['time_drop'][$key],
                                "value" => "Timming", 
                            ],
                            [
                                "id" => $request['running_drop'][$key],
                                "value" => "Running", 
                            ],
                        ]);

                        $prescription_medicine->timing   = \serialize($data);
                        $prescription_medicine->note   = null;
                        $prescription_medicine->save();
                    }
                }
                //medicine create for prescription

                //total amount calculation start
                $total = 0;
                foreach( $prescription->prescription_test as $prescription_test ){
                    foreach( unserialize($prescription_test->test_type_list) as $key => $test_type_list ){
                        $total += TestTypeList::where("id",$test_type_list)->first()->price;
                    }
                }
                $appoinment = Appoinment::where("id",$prescription->appoinment_id)->first();
                $appoinment->total = $total;
                if( $appoinment->save() ){
                    $url = route('medical.assistant.perscription.view',$prescription->prescription_no);
                    return response()->json([
                        'redirect_message' => 'New Prescription Created',
                        'redirect' => $url,
                    ],200);
                }
                //total amount calculation end

                
                
            }
        }
        catch( Exception $e ){
            return response()->json(['error' => $e->getMessage()],200);
        }

    }
    //add prescription function end


    //all prescription start
    public function all_prescription($appoinment_no){
        $appoinment = Appoinment::where("appoinment_no", $appoinment_no)->first();  

        if( $appoinment ){
            $prescriptions = Prescription::orderBy("id","desc")->where("appoinment_id",$appoinment->id)->paginate(10);
            return view("frontend.pages.profile.medical_assistant.pages.appoinment.prescription.all", compact("appoinment","prescriptions"));
        }
        else{
            return view("errors.404");
        }
    }
    //all prescription end

    // all_individual_report function start
    public function view_all_individual_report($prescription_id , $appoinment_id){
        $prescription_reports = PrescriptionReport::where("prescription_id",$prescription_id)->get();
        $appoinment = Appoinment::where("appoinment_no", $appoinment_id)->first();
        if( $prescription_reports && $appoinment){
            return view("frontend.pages.profile.medical_assistant.pages.appoinment.prescription.report.all_individual_report", compact("prescription_reports","appoinment"));
        }
        else{
            return view("errors.404");      
        }
    }

    // all_individual_report function end


    //edit prescription page function start
    public function edit_prescription_page($prescription_no){
        
        $prescription   = Prescription::where("prescription_no",$prescription_no)->first();
        if( $prescription ){
            $appoinment     = Appoinment::where("id", $prescription->appoinment_id)->first(); 
            $test_types     = TestType::orderBy("id", "desc")->where("is_active", true)->select("id", "name")->get();
            $medicines      = Medicine::where("is_active",true)->select("id","name")->get();
            $timings        = Timing::where("is_active",true)->get(); 

            $chief_complaint_id = $prescription->chief_complaint->pluck("chief_complaint_id");
            $selected_chief_complaints = ChiefComplaint::where("is_active",true)->whereIn("id",$chief_complaint_id)->select("id","name")->get();
            $chief_complaints = ChiefComplaint::where("is_active",true)->whereNotIn("id",$chief_complaint_id)->select("id","name")->get();
    
            if( $appoinment ){
                return view("frontend.pages.profile.medical_assistant.pages.appoinment.prescription.edit", compact("prescription","appoinment","test_types","medicines","timings","selected_chief_complaints","chief_complaints"));
            }
            else{
                return view("errors.404");      
            }
        }
        else{
            return view("errors.404");      
        }
        
    }
    //edit prescription page function end


    //edit prescription function start
    public function edit_prescription($prescription_no,Request $request){
        $prescription = Prescription::where("prescription_no",$prescription_no)->first();
        if( $prescription ){
            try{

                DB::statement("DELETE FROM prescription_medicines WHERE prescription_id = $prescription->id");
                DB::statement("DELETE FROM prescription_tests WHERE prescription_id = $prescription->id");
                DB::statement("DELETE FROM prescription_chief_complaints WHERE prescription_id = $prescription->id");

                $prescription->advice  = $request->advice;

                if( $prescription->save() ){

                    //chief complaint start
                    if( $request['chief_complaint_id'] ){
                        foreach( $request['chief_complaint_id'] as $chief_complaint_id ){
                            $prescription_chief_complaint = new PrescriptionChiefComplaint();
                            $prescription_chief_complaint->prescription_id = $prescription->id;
                            $prescription_chief_complaint->chief_complaint_id = $chief_complaint_id;
                            $prescription_chief_complaint->save();
                        }
                    }
                    //chief complaint end

                    //test create start
                    $test_types = TestType::where("is_active",true)->select("id")->get();
                    foreach( $test_types as $test_type ){
                        $name = $test_type->id . "_test_type_list_id";
                        $prescription_test = new PrescriptionTest();
                        $prescription_test->prescription_id = $prescription->id;
                        $prescription_test->test_type_id = $test_type->id;
                        $prescription_test->test_type_list = serialize($request[$name]);
                        $prescription_test->save();
                    }
                    //test create end

                    //medicine create for prescription
                    if( $request['medicine_id_mark'] ){
                        
                        foreach( $request['medicine_id_mark'] as $key => $medicine_id_mark ){
                            $data = [];
                            $prescription_medicine = new PrescriptionMedicine();
                            $prescription_medicine->prescription_id  = $prescription->id;

                            //if medicine exists or not
                            $medicine = $medicine = Medicine::where("id",$medicine_id_mark)->first();
                            if( $medicine ){
                                $prescription_medicine->medicine_id   = $medicine->id;
                            }
                            else{
                                $medicine = new Medicine();
                                $medicine->name = $medicine_id_mark;
                                $medicine->slug = Str::slug($medicine_id_mark);
                                $medicine->is_active      = true;
                                if( $medicine->save() ){
                                    $prescription_medicine->medicine_id   = $medicine->id;
                                }
                            }

                            $prescription_medicine->type = "Mark";

                            array_push($data,[
                                [
                                    "id" => $request['morning_mark'][$key],
                                    "value" => "Morning", 
                                ],
                                [
                                    "id" => $request['noon_mark'][$key],
                                    "value" => "Noon", 
                                ],
                                [
                                    "id" => $request['night_mark'][$key],
                                    "value" => "Night", 
                                ],
                                [
                                    "id" => $request['time_mark'][$key],
                                    "value" => "Timming", 
                                ],
                                [
                                    "id" => $request['running_mark'][$key],
                                    "value" => "Running", 
                                ],
                            ]);

                            $prescription_medicine->timing   = \serialize($data);
                            $prescription_medicine->note   = null;
                            $prescription_medicine->save();
                            
                        }
                    }
                    if( $request['medicine_id_or'] ){
                        foreach( $request['medicine_id_or'] as $key => $medicine_id_or ){
                            $prescription_medicine = new PrescriptionMedicine();
                            $prescription_medicine->prescription_id  = $prescription->id;
                            
                            //if medicine exists or not
                            $medicine = $medicine = Medicine::where("id",$medicine_id_or)->first();
                            if( $medicine ){
                                $prescription_medicine->medicine_id   = $medicine->id;
                            }
                            else{
                                $medicine = new Medicine();
                                $medicine->name = $medicine_id_or;
                                $medicine->slug = Str::slug($medicine_id_or);
                                $medicine->is_active      = true;
                                if( $medicine->save() ){
                                    $prescription_medicine->medicine_id   = $medicine->id;
                                }
                            }

                            $prescription_medicine->type   = "OR";
                            $prescription_medicine->timing   = null;
                            $prescription_medicine->note   = $request['or'][$key];
                            $prescription_medicine->save();
                        }
                    }
                    if( $request['medicine_id_drop'] ){
                        foreach( $request['medicine_id_drop'] as $key => $medicine_id_drop ){
                            $data = [];
                            $prescription_medicine = new PrescriptionMedicine();
                            $prescription_medicine->prescription_id  = $prescription->id;

                            //if medicine exists or not
                            $medicine = $medicine = Medicine::where("id",$medicine_id_drop)->first();
                            if( $medicine ){
                                $prescription_medicine->medicine_id   = $medicine->id;
                            }
                            else{
                                $medicine = new Medicine();
                                $medicine->name = $medicine_id_drop;
                                $medicine->slug = Str::slug($medicine_id_drop);
                                $medicine->is_active      = true;
                                if( $medicine->save() ){
                                    $prescription_medicine->medicine_id   = $medicine->id;
                                }
                            }
                            
                            $prescription_medicine->type   = "Drop";

                            array_push($data,[
                                [
                                    "id" => $request['morning_drop'][$key],
                                    "value" => "Morning", 
                                ],
                                [
                                    "id" => $request['noon_drop'][$key],
                                    "value" => "Noon", 
                                ],
                                [
                                    "id" => $request['night_drop'][$key],
                                    "value" => "Night", 
                                ],
                                [
                                    "id" => $request['time_drop'][$key],
                                    "value" => "Timming", 
                                ],
                                [
                                    "id" => $request['running_drop'][$key],
                                    "value" => "Running", 
                                ],
                            ]);

                            $prescription_medicine->timing   = \serialize($data);
                            $prescription_medicine->note   = null;
                            $prescription_medicine->save();
                        }
                    }
                    //medicine create for prescription

                }

                //total amount calculation start
                $total = 0;
                foreach( $prescription->prescription_test as $prescription_test ){
                    foreach( unserialize($prescription_test->test_type_list) as $key => $test_type_list ){
                        $total += TestTypeList::where("id",$test_type_list)->first()->price;
                    }
                }
                $appoinment = Appoinment::where("id",$prescription->appoinment_id)->first();
                $appoinment->total = $total;
                if( $appoinment->save() ){
                    $url = route('medical.assistant.perscription.view',$prescription->prescription_no);
                    return response()->json([
                        'redirect_message' => 'Prescription Updated',
                        'redirect' => $url,
                    ],200);
                }
                //total amount calculation end
                    
                
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()],200);
            }
        }
        else{
            return view("errors.404");      
        }
    }
    //edit prescription function start


    //view prescription function start
    public function view_prescription($prescription_no){
        $prescription   = Prescription::where("prescription_no",$prescription_no)->first();

        if( $prescription ){
            $appoinment     = Appoinment::where("id", $prescription->appoinment_id)->first(); 
            if( $appoinment ){
                return view("frontend.pages.profile.medical_assistant.pages.appoinment.prescription.view", compact("prescription","appoinment"));
            }
            else{
                return view("errors.404");      
            }
        }
        else{
            return view("errors.404");      
        }
        
    }
    //view prescription function end


    //view billing function start
    public function view_billing($prescription_no){
        $prescription = Prescription::where("prescription_no",$prescription_no)->first();
        
        if( $prescription ){
            $appoinment = Appoinment::where("id", $prescription->appoinment_id)->first(); 
            if( $appoinment ){
                return view("frontend.pages.profile.medical_assistant.pages.appoinment.prescription.billing", compact("prescription","appoinment"));
            }
            else{
                return view("errors.404");      
            }
        }
        else{
            return view("errors.404");      
        }
        
    }
    //view billing function end


    //change status function start
    public function change_status(Request $request,$prescription_no){
        $prescription = Prescription::where("prescription_no",$prescription_no)->first();
        $appoinment = Appoinment::where("id", $prescription->appoinment_id)->first(); 
        if( $prescription && $appoinment ){

            if( $request->payment_status == "Paid" ){
                $appoinment->payment_status = $request->payment_status;
                $appoinment->status = "Complete";
            }
            else{
                $appoinment->payment_status = $request->payment_status;
                $appoinment->status = "Confirm";
            }
            

            if( $appoinment->save() ){
                return response()->json([
                    'success' => 'Payment Status Updated',
                    'msg' => $request->payment_status,
            ],200);  
            }
        }
        else{
            return response()->json(['error' => 'Invalid prescription or appoinment'],200);  
        }
    }
    //change status function end


}
