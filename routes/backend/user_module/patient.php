<?php

use App\Http\Controllers\Backend\UserModule\Patient\PatientController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'patient'], function(){

    //index route start
    Route::get("/",[PatientController::class,"index"])->name("patient.all");
    Route::get("/data",[PatientController::class,'data'])->name('patient.data');

    //patient edit
    Route::get("/edit/{id}",[PatientController::class,'edit'])->name('patient.edit');
    Route::post("/edit/{id}",[PatientController::class,'update'])->name('patient.update');
    
    //password reset
    Route::get("/reset/modal/{id}",[PatientController::class,'reset_modal'])->name('patient.reset.modal');
    Route::post("/reset/{id}",[PatientController::class,'reset'])->name('patient.reset');
    
    //view route
    Route::get("/view/{id}",[PatientController::class,"view_modal"])->name("patient.view.modal");

});

?>