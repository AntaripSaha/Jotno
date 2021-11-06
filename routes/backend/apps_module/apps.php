<?php

use App\Http\Controllers\Backend\AppsModule\AppBannerController;
use Illuminate\Support\Facades\Route;

//banner management start
Route::group(['prefix' => 'banner'], function () {
      //index route start
      Route::get("/",[AppBannerController::class,"index"])->name("banner.all");
      Route::get("/data",[AppBannerController::class,'data'])->name('banner.data');
  
      //banner edit
      Route::get("/edit/{id}",[AppBannerController::class,'edit'])->name('banner.edit');
      Route::post("/edit/{id}",[AppBannerController::class,'update'])->name('banner.update');     
  
      //add route
      Route::get("/add",[AppBannerController::class,'add_modal'])->name('banner.add.modal');
      Route::post("/add",[AppBannerController::class,'add'])->name('banner.add');
  
      //view route
      Route::get("/view/{id}",[AppBannerController::class,"view_modal"])->name("banner.view.modal");

      //delete route
      Route::get("/delete/{id}",[AppBannerController::class,'delete_modal'])->name('delete.modal');
      Route::post("/delete/{id}",[AppBannerController::class,'delete'])->name('banner.delete');
});
//banner management end

?>