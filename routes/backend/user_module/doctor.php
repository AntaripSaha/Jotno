<?php

use App\Http\Controllers\Backend\UserModule\Doctor\DoctorController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'doctor'], function(){

    //index route start
    Route::get("/",[DoctorController::class,"index"])->name("doctor.all");
    Route::get("/data",[DoctorController::class,'data'])->name('doctor.data');

    //doctor edit
    Route::get("/edit/{id}",[DoctorController::class,'edit'])->name('doctor.edit');
    Route::post("/edit/{id}",[DoctorController::class,'update'])->name('doctor.update');

    //password reset
    Route::get("/reset/modal/{id}",[DoctorController::class,'reset_modal'])->name('doctor.reset.modal');
    Route::post("/reset/{id}",[DoctorController::class,'reset'])->name('doctor.reset');

    //add route
    Route::get("/add",[DoctorController::class,'add_modal'])->name('doctor.add.modal');
    Route::post("/add",[DoctorController::class,'add'])->name('doctor.add');

    //view route
    Route::get("/view/{id}",[DoctorController::class,"view_modal"])->name("doctor.view.modal");

});

?>