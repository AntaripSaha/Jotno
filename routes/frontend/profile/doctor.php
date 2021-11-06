<?php

use App\Http\Controllers\Frontend\Profile\Doctor\DoctorProfileController;
use App\Http\Controllers\Frontend\Profile\Doctor\AppoinmentController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'doctor','middleware' => 'doctor'], function(){
   
    //index route
    Route::get("/",[DoctorProfileController::class,"index"])->name("doctor.dashboard");

    //all route
    Route::get("/all",[DoctorProfileController::class,"all"])->name("doctor.dashboard.appoinment.all");

    //profile setting
    Route::get("/profile-setting",[DoctorProfileController::class,"profile_setting_page"])->name("doctor.profile.setting.page");
    Route::post("/profile-setting",[DoctorProfileController::class,"update_profile_setting"])->name("doctor.update.profile.setting");

    //change password setting
    Route::get("/change-password",[DoctorProfileController::class,"change_password_page"])->name("doctor.change.password.page");
    Route::post("/change-password",[DoctorProfileController::class,"change_password"])->name("doctor.change.password");

    //logout route
    Route::post("/logout",[DoctorProfileController::class,"logout"])->name("doctor.logout");

    //view appoinment modal
    Route::get("appoinment-view-modal/{id}",[AppoinmentController::class,"view_modal"])->name("doctor.appoinment.view.modal");

    //appoinment note route
    Route::get("/appoinment-note/{id}",[AppoinmentController::class,"note_modal"])->name("doctor.appoinment.note.modal");
    Route::post("/appoinment-note/{id}",[AppoinmentController::class,"note"])->name("doctor.appoinment.note");

    //appoinment detail
    Route::get("/appoinment-details/{appoinment_no}",[AppoinmentController::class,"details_page"])->name("doctor.appoinment.details");

    //appoinment create page
    Route::get("/appoinment-create-page/{appoinment_no}",[AppoinmentController::class,"create_page"])->name("doctor.appoinment.create.page");

    //add prescription route
    Route::post("/add-prescription/{appoinment_no}",[AppoinmentController::class,"add_prescription"])->name("doctor.perscription.add");

    //all prescription list start
    Route::get("/all-prescription/{appoinment_no}",[AppoinmentController::class,"all_prescription"])->name("doctor.perscription.all");

    //view prescription start
    Route::get("/view-prescription/{prescription_no}",[AppoinmentController::class,"view_prescription"])->name("doctor.perscription.view");
  
    //view-all-individual-report
    Route::get("/view-all-individual-report/{prescription_id}/{appoinment_id}",[AppoinmentController::class,"view_all_individual_report"])->name("doctor.perscription.report.view");

    //view billing start
    Route::get("/view-billing/{prescription_no}",[AppoinmentController::class,"view_billing"])->name("doctor.perscription.billing");

    Route::get("/change-status/{prescription_no}",[AppoinmentController::class,"change_status"])->name("doctor.perscription.billing.change.status");

    //edit prescription route
    Route::get("/edit-prescription/{prescription_no}",[AppoinmentController::class,"edit_prescription_page"])->name("doctor.perscription.edit.page");
    Route::post("/edit-prescription/{prescription_no}",[AppoinmentController::class,"edit_prescription"])->name("doctor.perscription.edit");

    //all appoinment search
    Route::get("/appoinment-all-search",[AppoinmentController::class,"search_all_appoinment"])->name("doctor.all.appoinment.search");

    //today's appoinment search
    Route::get("/appoinment-today-search",[AppoinmentController::class,"search_today_appoinment"])->name("doctor.today.appoinment.search");
    
});

?>