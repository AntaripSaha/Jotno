<?php

use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get("/last-three-month-appoinment",[DashboardController::class,"last_three_month_appoinment"])->name("last.three.month.appoinment");

Route::get("/last-three-month-registration",[DashboardController::class,"last_three_month_registration"])->name("last.three.month.registration");

Route::get("/last-six-month-sales",[DashboardController::class,"last_six_month_sales"])->name("last.six.month.sales");

?>