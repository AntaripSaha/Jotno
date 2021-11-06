<?php

use App\Http\Controllers\Backend\PageModule\HomePageController;
use Illuminate\Support\Facades\Route;

//page management start
Route::group(['prefix' => 'page'], function () {
      //index route start
      Route::get("/home-edit",[HomePageController::class,"index"])->name("home.page");
      Route::post("/home-update/{id}",[HomePageController::class,"update"])->name("home.page.update");
      Route::post("/about-update/{id}",[HomePageController::class,"update_about_us"])->name("about.page.update");
      
      // quality
      Route::get("/quality",[HomePageController::class,"quality"])->name("quality.page");
      
      //add route
      Route::get("/add",[HomePageController::class,"add_modal"])->name("quality.add.modal");
      Route::post("/add",[HomePageController::class,"add"])->name("quality.add");
      
      //quality delete
      Route::get("/delete/{id}",[HomePageController::class,"delete_modal"])->name("quality.delete.modal");
      Route::post("/delete/{id}",[HomePageController::class,'delete'])->name('quality.delete');
      
      //data route
      Route::get("/data",[HomePageController::class,"data"])->name("quality.all.data");
      //edit route
      Route::get("/edit/{id}",[HomePageController::class,"edit_modal"])->name("quality.edit.modal");
      //update route
      Route::post("/quality-update/{id}",[HomePageController::class,"update_quality"])->name("quality.update");

      Route::get("/about-us",[HomePageController::class,"index"])->name("about.page");
      Route::get("/blog",[HomePageController::class,"index"])->name("blog.page");

});
//page management end

?>