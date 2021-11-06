<?php

use App\Http\Controllers\Backend\PageModule\ServicePageController;
use Illuminate\Support\Facades\Route;

//service management start
Route::group(['prefix' => 'service'], function () {
     //index route start
     Route::get("/",[ServicePageController::class,"index"])->name("all.service");
     Route::get("/data",[ServicePageController::class,"data"])->name("service.all.data");

     //add route
     Route::get("/add",[ServicePageController::class,'add_modal'])->name('service.add.modal');
     Route::post("/add",[ServicePageController::class,'add'])->name('service.add');     
     
     //service.page edit
     Route::get("/edit/{id}",[ServicePageController::class,'edit'])->name('service.edit');
     Route::post("/edit/{id}",[ServicePageController::class,'update'])->name('service.update');     
 
     //delete route
     Route::get("/delete/{id}",[ServicePageController::class,'delete_modal'])->name('service.delete.modal');
     Route::post("/delete/{id}",[ServicePageController::class,'delete'])->name('service.delete');
});
//service management end

?>