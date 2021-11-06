<?php


use App\Http\Controllers\Backend\AppointmentModule\ApiController;
use App\Http\Controllers\Backend\AppsModule\ApiBannerController;
use App\Http\Controllers\Backend\BlogModule\ApiBlogController;
use App\Http\Controllers\Backend\PageModule\ApiServiceController;
use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//register api route
Route::post("/register", [RegisterController::class, "api_register"]);

//login api route
Route::post("/login", [LoginController::class, "api_login"]);





//get appoinmentn api
Route::post("/appoinment-get", [ApiController::class, "get_appoinment"]);

//get prescription api
Route::get("/prescription-get", [ApiController::class, "get_prescription"]);

//prescription pdf
Route::get("/prescription-pdf/{id}", [ApiController::class, "prescription_pdf"]);

//billing pdf
Route::get("/billing-pdf/{id}", [ApiController::class, "billing_pdf"]);

//banner route
Route::get("/banner", [ApiBannerController::class, "banner_all"]);

//report api
Route::get("/prescription-report", [ApiController::class, "prescription_report"]);

//create report api
Route::post("/report-create", [ApiController::class, "report_create"]);

//edit report api
Route::post("/report-edit", [ApiController::class, "report_edit"]);

//delete report api
Route::post("/report-delete", [ApiController::class, "report_delete"]);

//all test api
Route::get("/all-test", [ApiController::class, "all_test"]);

//prescription list
Route::get("/prescription-list", [ApiController::class, "prescription_list"]);

//password reset
Route::post("/password-reset", [ApiController::class, "password_reset"]);

//patient-profile-update
Route::post("/patient-profile-update", [ApiController::class, "patient_profile_update"]);

//patient forgot password 
Route::post("/patient-forgot-password", [ApiController::class, "patient_forgot_password"]);

//all medecine route
Route::get("/medicine-all",[ApiController::class,"medecine_all"]);

//content
Route::get("/content",[ApiController::class,"content"]);

//about
Route::get("/about",[ApiController::class,"about"]);

//service api route
Route::get("/all-services" , [ApiServiceController::class, "all_services"]);


//blog post route
Route::get("/all-blog", [ApiBlogController::class, "all_blog"]);
