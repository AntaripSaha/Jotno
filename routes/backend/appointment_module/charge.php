<?php

use App\Http\Controllers\Backend\AppointmentModule\ChargeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'charge'], function(){

    //index route
    Route::get("/",[ChargeController::class,"index"])->name("charge.all");

    //data route
    Route::get("/data",[ChargeController::class,"data"])->name("charge.data");

    //add route
    Route::get("/add",[ChargeController::class,"add_modal"])->name("charge.add.modal");
    Route::post("/add",[ChargeController::class,"add"])->name("charge.add");

    //edit route
    Route::get("/edit/{id}",[ChargeController::class,"edit_modal"])->name("charge.edit.modal");
    Route::post("/edit/{id}",[ChargeController::class,"edit"])->name("charge.edit");

});

?>