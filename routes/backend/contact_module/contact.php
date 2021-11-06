<?php

use App\Http\Controllers\Backend\ContactModule\ContactController;
use Illuminate\Support\Facades\Route;

//messege management start
Route::group(['prefix' => 'messege'], function () {
      //index route start
      Route::get("/",[ContactController::class,"index"])->name("messege.all");
      Route::get("/data",[ContactController::class,'data'])->name('messege.data');
  
      //messege reply with send email
      Route::get("/reply/{id}",[ContactController::class,'reply_view'])->name('messege.reply.view');
      Route::post("/reply/{id}",[ContactController::class,'reply'])->name('messege.reply');     
    
      //view route
      Route::get("/view/{id}",[ContactController::class,"view_modal"])->name("messege.view.modal");

      //delete route
      Route::get("/delete/{id}",[ContactController::class,'delete_modal'])->name('messege.delete.modal');
      Route::post("/delete/{id}",[ContactController::class,'delete'])->name('messege.delete');

});
//messege management end

?>