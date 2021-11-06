<?php

use App\Http\Controllers\Backend\TestModule\CheifComplaintsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'cheif_complaints'], function(){
    
    //index route
    Route::get("/",[CheifComplaintsController::class,"index"])->name("chief.complaints.all");

    //data route
    Route::get("/data",[CheifComplaintsController::class,"data"])->name("chief.complaints.all.data");

    //add route
    Route::get("/add",[CheifComplaintsController::class,"add_modal"])->name("chief.complaints.add.modal");
    Route::post("/add",[CheifComplaintsController::class,"add"])->name("chief.complaints.add");

    //edit route
    Route::get("/edit/{id}",[CheifComplaintsController::class,"edit_modal"])->name("chief.complaints.edit.modal");
    Route::post("/edit/{id}",[CheifComplaintsController::class,"update"])->name("chief.complaints.update");

});

?>