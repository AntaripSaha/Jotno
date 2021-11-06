<?php

use App\Http\Controllers\Backend\TestModule\InitialTestController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'initial_test'], function(){

    //index route start
    Route::get("/",[InitialTestController::class,"index"])->name("initial_test.all");
    Route::get("/data",[InitialTestController::class,'data'])->name('initial_test.data');

    //initial_test edit
    Route::get("/edit/{id}",[InitialTestController::class,'edit'])->name('initial_test.edit');
    Route::post("/edit/{id}",[InitialTestController::class,'update'])->name('initial_test.update');

    //password reset
    Route::get("/reset/modal/{id}",[InitialTestController::class,'reset_modal'])->name('initial_test.reset.modal');
    Route::post("/reset/{id}",[InitialTestController::class,'reset'])->name('initial_test.reset');
    //add route
    Route::get("/add",[InitialTestController::class,'add_modal'])->name('initial_test.add.modal');
    Route::post("/add",[InitialTestController::class,'add'])->name('initial_test.add');

});

?>