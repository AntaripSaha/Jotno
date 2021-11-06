<?php

use App\Http\Controllers\Backend\UserModule\MedicalAssistant\MedicalAssistantController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'medical_assistant'], function(){

    //index route
    Route::get("/",[MedicalAssistantController::class,'index'])->name('medical_assistant.all');

    Route::get("/data",[MedicalAssistantController::class,'data'])->name('medical_assistant.data');

    //medical_assistant edit
    Route::get("/edit/{id}",[MedicalAssistantController::class,'edit'])->name('medical_assistant.edit');
    Route::post("/edit/{id}",[MedicalAssistantController::class,'update'])->name('medical_assistant.update');

    //password reset
    Route::get("/reset/modal/{id}",[MedicalAssistantController::class,'reset_modal'])->name('medical_assistant.reset.modal');
    Route::post("/reset/{id}",[MedicalAssistantController::class,'reset'])->name('medical_assistant.reset');
    //add route
    Route::get("/add",[MedicalAssistantController::class,'add_modal'])->name('medical_assistant.add.modal');
    Route::post("/add",[MedicalAssistantController::class,'add'])->name('medical_assistant.add');

    //view route
    Route::get("/view/{id}",[MedicalAssistantController::class,"view_modal"])->name("medical_assistant.view.modal");
});

?> 