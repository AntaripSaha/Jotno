<?php

use App\Http\Controllers\Backend\BlogModule\BlogController;
use Illuminate\Support\Facades\Route;

//blog management start


Route::group(['prefix' => 'blog'], function () {
    //index route start
    Route::get("/", [BlogController::class, "index"])->name("blog.page");
    Route::get("/data", [BlogController::class, "data"])->name("blog.data");

    //add route
    Route::get("/add", [BlogController::class, 'add_modal'])->name('blog.add.modal');
    Route::post("/add", [BlogController::class, 'add'])->name('blog.add');

    //blog edit
    Route::get("/edit/{id}", [BlogController::class, 'edit'])->name('blog.edit');
    Route::post("/edit/{id}", [BlogController::class, 'update'])->name('blog.update');

    //view route
    Route::get("/view/{id}", [BlogController::class, "view_modal"])->name("blog.view.modal");

    //delete route
    Route::get("/delete/{id}", [BlogController::class, 'delete_modal'])->name('blog.delete.modal');
    Route::post("/delete/{id}", [BlogController::class, 'delete'])->name('blog.delete');
});


//blog management end
