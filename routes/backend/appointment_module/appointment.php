<?php

use App\Http\Controllers\Backend\AppointmentModule\AppointmentController;
use Illuminate\Support\Facades\Route;

//appointment management start
Route::group(['prefix' => 'appointment'], function () {
    Route::get('/all', [AppointmentController::class, 'index'])->name('appointment.all');
    Route::get('/search', [AppointmentController::class, 'search'])->name('appointment.search');

    //view_individual_prescription
    Route::get('/view-individual-prescription/{appointment}', [AppointmentController::class, 'view_individual_prescription'])->name('perscription.view');
  
    //view_appointment_details route
    Route::get('/appointment-details/{appoinment_no}', [AppointmentController::class, 'view_appointment_details'])->name('individual.appointment.details');

    //cancel appoinment route
    Route::post('/appointment-cancel/{appoinment_no}', [AppointmentController::class, 'appointment_cancel'])->name('individual.appointment.cancel');
  
    //appointment_view_billing route
    Route::get("/appointment-view-billing/{prescription_no}",[AppointmentController::class,"appointment_view_billing"])->name("appointment.perscription.billing");
    
    //appointment_prescription_report route
    Route::get("/appointment-prescription-report/{prescription_id}/{appoinment_id}",[AppointmentController::class,"appointment_prescription_report"])->name("appointment.perscription.report");

    
});
//appointment management end

?>