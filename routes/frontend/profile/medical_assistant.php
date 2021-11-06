<?php

use App\Http\Controllers\Frontend\Profile\MedicalAssistant\AppoinmentController;
use App\Http\Controllers\Frontend\Profile\MedicalAssistant\MedicalAssistantProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'medical_assistant','middleware' => 'medical_assistant'], function(){
  
    //index route
    Route::get("/",[MedicalAssistantProfileController::class,"index"])->name("medical.assistant.dashboard");

    //all route
    Route::get("/all",[MedicalAssistantProfileController::class,"all"])->name("medical.assistant.dashboard.appoinment.all");
    
    // search today route
    Route::get('/search_today_appointment', [MedicalAssistantProfileController::class, 'search_today'])->name('medical_assistant.appointment.search_today');
    
    // search all route
    Route::get('/search_all_appointment', [MedicalAssistantProfileController::class, 'search_all'])->name('medical_assistant.appointment.search_all');
    
    //profile setting
    Route::get("/profile-setting",[MedicalAssistantProfileController::class,"profile_setting_page"])->name("medical.assistant.profile.setting.page");
    Route::post("/profile-setting",[MedicalAssistantProfileController::class,"update_profile_setting"])->name("medical.assistant.update.profile.setting");

    //change password setting
    Route::get("/change-password",[MedicalAssistantProfileController::class,"change_password_page"])->name("medical.assistant.change.password.page");
    Route::post("/change-password",[MedicalAssistantProfileController::class,"change_password"])->name("medical.assistant.change.password");

    //view appoinment modal
    Route::get("appoinment-view-modal/{id}",[AppoinmentController::class,"view_modal"])->name("medical.assistant.appoinment.view.modal");

    //appoinment note route
    Route::get("/appoinment-note/{id}",[AppoinmentController::class,"note_modal"])->name("medical.assistant.appoinment.note.modal");
    Route::post("/appoinment-note/{id}",[AppoinmentController::class,"note"])->name("medical.assistant.appoinment.note");

    //appoinment cancel route
    Route::get("/appoinment-cancel/{id}",[AppoinmentController::class,"cancel_modal"])->name("medical.assistant.appoinment.cancel.modal");
    Route::post("/appoinment-cancel/{id}",[AppoinmentController::class,"cancel"])->name("medical.assistant.appoinment.cancel");


    //appoinment detail
    Route::get("/appoinment-details/{appoinment_no}",[AppoinmentController::class,"details_page"])->name("medical.assistant.appoinment.details");


    //appoinment initial test route
    Route::group(['prefix' => 'appoinment-initial-test'],function(){

        //data
        Route::get("/data/{appoinment_no}",[AppoinmentController::class,"appoinment_initial_test_data"])->name("medical.assistant.appoinment.initial.test.data");

        //add route
        Route::post("/add/{appoinment_no}",[AppoinmentController::class,"appoinment_initial_test"])->name("medical.assistant.appoinment.initial.test");

        //edit route
        Route::get("/edit/{id}",[AppoinmentController::class,"appoinment_initial_test_edit_modal"])->name("medical.assistant.appoinment.initial.test.edit.modal");
        Route::post("/edit/{id}",[AppoinmentController::class,"appoinment_initial_test_edit"])->name("medical.assistant.appoinment.initial.test.edit");

        //delete route
        Route::get("/delete/{id}",[AppoinmentController::class,"appoinment_initial_test_delete_modal"])->name("medical.assistant.appoinment.initial.test.delete.modal");
        Route::post("/delete/{id}",[AppoinmentController::class,"appoinment_initial_test_delete"])->name("medical.assistant.appoinment.initial.test.delete");

    });
    //appoinment initial test route
    

    //appoinment create page
    Route::get("/appoinment-create-page/{appoinment_no}",[AppoinmentController::class,"create_page"])->name("medical.assistant.appoinment.create.page");

    //add prescription route
    Route::post("/add-prescription/{appoinment_no}",[AppoinmentController::class,"add_prescription"])->name("medical.assistant.perscription.add");

    //all prescription list start
    Route::get("/all-prescription/{appoinment_no}",[AppoinmentController::class,"all_prescription"])->name("medical.assistant.perscription.all");

    //edit prescription route
    Route::get("/edit-prescription/{prescription_no}",[AppoinmentController::class,"edit_prescription_page"])->name("medical.assistant.perscription.edit.page");
    Route::post("/edit-prescription/{prescription_no}",[AppoinmentController::class,"edit_prescription"])->name("medical.assistant.perscription.edit");

    //view prescription start
    Route::get("/view-prescription/{prescription_no}",[AppoinmentController::class,"view_prescription"])->name("medical.assistant.perscription.view");
    
    //view-all-individual-report
    Route::get("/view-all-individual-report/{prescription_id}/{appoinment_id}",[AppoinmentController::class,"view_all_individual_report"])->name("medical.assistant.perscription.report.view");
        
    //view billing start
    Route::get("/view-billing/{prescription_no}",[AppoinmentController::class,"view_billing"])->name("medical.assistant.perscription.billing");

    Route::get("/change-status/{prescription_no}",[AppoinmentController::class,"change_status"])->name("medical.assistant.perscription.billing.change.status");

    //logout route
    Route::post("/logout",[MedicalAssistantProfileController::class,"logout"])->name("medical.assistant.logout");
    
});

?>