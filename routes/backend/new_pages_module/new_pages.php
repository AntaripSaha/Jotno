<?php

use App\Http\Controllers\Backend\PageModule\NewPageController;
use Illuminate\Support\Facades\Route;

//page management start
Route::group(['prefix' => 'new_page'], function () {
      
    //index route start
      Route::get("/",[NewPageController::class,"index"])->name("new.page");
      Route::get("/data",[NewPageController::class,"data"])->name("new.page.all");
 
      //add route
      Route::get("/add",[NewPageController::class,'add_modal'])->name('new.page.add.modal');
      Route::post("/add",[NewPageController::class,'add'])->name('new.page.add');     
      
      //new.page edit
      Route::get("/edit/{id}",[NewPageController::class,'edit'])->name('new.page.edit');
      Route::post("/edit/{id}",[NewPageController::class,'update'])->name('new.page.update');     
  
      //delete route
      Route::get("/delete/{id}",[NewPageController::class,'delete_modal'])->name('delete.modal');
      Route::post("/delete/{id}",[NewPageController::class,'delete'])->name('new.page.delete');

    });
    
//page management end

?>