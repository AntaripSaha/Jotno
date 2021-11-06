<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AppoinmentModule\Appoinment;
use App\Models\Reports\History;
use App\Models\Reports\SmsHistory;
use App\Models\Reports\Transaction;
use App\Models\TestModule\Medicine;
use App\Models\TestModule\TestTypeList;
use App\Models\UserModule\Doctor;
use App\Models\UserModule\MedicalAssistant;
use App\Models\UserModule\Patient;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {

        if( auth('super_admin')->check() || auth('web')->check() ){

            $total_appoinment = Appoinment::select("id")->count();
            $todays_appoinment = Appoinment::where("appoinment_date",Carbon::now()->toDateString())->select("id")->count();
            $medicine = Medicine::select("id")->count();
            $tests = TestTypeList::select("id")->count();

            return view('backend.dashboard',compact('total_appoinment','todays_appoinment','medicine','tests'));
        }else{
            return view("errors.404");
        }
    }


    public function last_three_month_appoinment(){

        //last 3 month success sms data show start
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $done = 1;
        $data = [];

        for( $i = 0 ; $i < 3 ; $i++ ){
            if( $month != 0 ){

                $pending = Appoinment::where("month", $month)->where("year",$year)->where("status","Pending")->select("id")->count();
                $confirm = Appoinment::where("month", $month)->where("year",$year)->where("status","Confirm")->select("id")->count();
                $complete = Appoinment::where("month", $month)->where("year",$year)->where("status","Complete")->select("id")->count();
                $cancel = Appoinment::where("month", $month)->where("year",$year)->where("status","Cancel")->select("id")->count();
                

                array_push($data,
                    [
                        "pending" => $pending,
                        "confirm" => $confirm,
                        "complete" => $complete,
                        "time" => Carbon::now()->month($month)->format('M') .' '. Carbon::now()->year,
                        "cancel" => $cancel,
                    ]
                );
                
                $month--;
            }
            else{
                $i++;
            }
        }
        //last 3 month success sms data show end

        return response()->json(['data' => $data], 200);
    }


    public function last_three_month_registration(){

        //last 3 month success sms data show start
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $done = 1;
        $data = [];

        for( $i = 0 ; $i < 3 ; $i++ ){
            if( $month != 0 ){

                $doctor = Doctor::where("month", $month)->where("year",$year)->select("id")->count();
                $medical_assistant = MedicalAssistant::where("month", $month)->where("year",$year)->select("id")->count();
                $patient = Patient::where("month", $month)->where("year",$year)->select("id")->count();
                

                array_push($data,
                    [
                        "doctor" => $doctor,
                        "medical_assistant" => $medical_assistant,
                        "patient" => $patient,
                        "time" => Carbon::now()->month($month)->format('M') .' '. Carbon::now()->year,
                    ]
                );
                
                $month--;
            }
            else{
                $i++;
            }
        }
        //last 3 month success sms data show end

        return response()->json(['data' => $data], 200);
    }


    public function last_six_month_sales(){
        //last 6 month success sms data show start
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $done = 1;
        $data = [];

        for( $i = 0 ; $i < 6 ; $i++ ){
            if( $month != 0 ){

                $sales = Appoinment::where("month", $month)->where("year",$year)->where("payment_status","Paid")->select("total")->sum("total");
                
                array_push($data,
                    [
                        "sales" => $sales,
                        "time" => Carbon::now()->month($month)->format('M') .' '. Carbon::now()->year,
                    ]
                );
                
                $month--;
            }
            else{
                $i++;
            }
        }
        //last 6 month success sms data show end

        return response()->json(['data' => $data], 200);
    }


}