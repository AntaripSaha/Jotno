<?php

use App\Http\Controllers\Backend\TestModule\MedicineController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'medicine'], function(){

    //index route start
    Route::get("/",[MedicineController::class,"index"])->name("medicine.all");
    Route::get("/data",[MedicineController::class,'data'])->name('medicine.data');

    //medicine edit
    Route::get("/edit/{id}",[MedicineController::class,'edit'])->name('medicine.edit');
    Route::post("/edit/{id}",[MedicineController::class,'update'])->name('medicine.update');

    //password reset
    Route::get("/reset/modal/{id}",[MedicineController::class,'reset_modal'])->name('medicine.reset.modal');
    Route::post("/reset/{id}",[MedicineController::class,'reset'])->name('medicine.reset');
    //add route
    Route::get("/add",[MedicineController::class,'add_modal'])->name('medicine.add.modal');
    Route::post("/add",[MedicineController::class,'add'])->name('medicine.add');

});

?>