<?php

use App\Http\Controllers\Backend\TestModule\TestTypeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'test_type'], function(){
    
    //index route
    Route::get("/",[TestTypeController::class,"index"])->name("test.all");

    //data route
    Route::get("/data",[TestTypeController::class,"data"])->name("test.all.data");

    //add route
    Route::get("/add",[TestTypeController::class,"add_modal"])->name("test.add.modal");
    Route::post("/add",[TestTypeController::class,"add"])->name("test.add");

    //edit route
    Route::get("/edit/{id}",[TestTypeController::class,"edit_modal"])->name("test.edit.modal");
    Route::post("/edit/{id}",[TestTypeController::class,"edit"])->name("test.edit");

});

?>