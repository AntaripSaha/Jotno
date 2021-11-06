<?php

use App\Http\Controllers\Frontend\Profile\Patient\AppoinmentController;
use App\Http\Controllers\Frontend\Profile\Patient\PatientProfileController;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'patient','middleware' => 'patient'], function(){
   
    //index route
    Route::get("/",[PatientProfileController::class,"index"])->name("patient.dashboard");

    //all route
    Route::get("/all",[PatientProfileController::class,"all"])->name("patient.dashboard.appoinment.all");

    //profile setting
    Route::get("/profile-setting",[PatientProfileController::class,"profile_setting_page"])->name("patient.profile.setting.page");
    Route::post("/profile-setting",[PatientProfileController::class,"update_profile_setting"])->name("patient.update.profile.setting");

    //change password setting
    Route::get("/change-password",[PatientProfileController::class,"change_password_page"])->name("patient.change.password.page");
    Route::post("/change-password",[PatientProfileController::class,"change_password"])->name("patient.change.password");

    //get appoinment
    Route::get("/get-appoinment",[PatientProfileController::class,"get_appoinment"])->name("get.appoinment");

    //logout route
    Route::post("/logout",[PatientProfileController::class,"logout"])->name("patient.logout");

    //appoinment detail
    Route::get("/appoinment-details/{appoinment_no}",[AppoinmentController::class,"details_page"])->name("patient.appoinment.details");
    
    //all prescription list start
    Route::get("/all-prescription/{appoinment_no}",[AppoinmentController::class,"all_prescription"])->name("patient.perscription.all");
    
    //view prescription start
    Route::get("/view-prescription/{prescription_no}",[AppoinmentController::class,"view_prescription"])->name("patient.perscription.view");
    
    //add report form route
    Route::get("/add-report/{prescription_no}",[AppoinmentController::class,"add_report_form"])->name("patient.perscription.report.add.form");
    
    // add report 
    Route::post("/add-report/{prescription_no}",[AppoinmentController::class,"add_report"])->name("patient.perscription.report.add");
    
    //view-all-individual-report route
    Route::get("/view-all-individual-report/{prescription_id}/{appoinment_id}",[AppoinmentController::class,"view_all_individual_report"])->name("patient.perscription.report.view");
     
    //delete route
    Route::get("/report-delete/{id}",[AppoinmentController::class,'delete_modal'])->name('prescription.delete.modal');
    Route::post("/report-delete/{id}",[AppoinmentController::class,'delete'])->name('prescription.delete');

    //edit-report page view
    Route::get("/edit-report/{prescription_report_id}/{appoinment_no}",[AppoinmentController::class,"edit_report_page"])->name("patient.perscription.report.edit.page");
    
    // edit submit page
    Route::post("/edit-report/{id}",[AppoinmentController::class,"edit_report"])->name("patient.perscription.report.update");
    
    //view prescription start
    Route::get("/view-prescription/{prescription_no}",[AppoinmentController::class,"view_prescription"])->name("patient.perscription.view");

    //view billing start
    Route::get("/view-billing/{prescription_no}",[AppoinmentController::class,"view_billing"])->name("patient.perscription.billing");

    //all appoinment search
    Route::get("/appoinment-all-search",[AppoinmentController::class,"search_all_appoinment"])->name("patient.all.appoinment.search");

    //today's appoinment search
    Route::get("/appoinment-today-search",[AppoinmentController::class,"search_today_appoinment"])->name("patient.today.appoinment.search");

});

?>