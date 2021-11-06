<?php

use App\Http\Controllers\Frontend\Auth\ForgetPasswordController;
use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\HomePageController;
use Illuminate\Support\Facades\Route;

//home
Route::get("/", [HomePageController::class, "index"])->name("home");
Route::get("/information/{slug}", [HomePageController::class, "new_page"])->name("new.page.view");

//about
Route::get("/about", [FrontendController::class, "about"])->name("about");

//blog
Route::get("/blog", [FrontendController::class, "blog"])->name("blog");
//blog details
Route::get("/blog-details/{slug}", [FrontendController::class, "blogDetails"])->name("blog.details");
// blog Search
Route::get("/blog-search", [FrontendController::class, "search"])->name("blog.search");

//login
Route::get("/login", [LoginController::class, "login"])->name("login");
Route::post("/login", [LoginController::class, "do_login"])->name("do.frontend.login");

//register
Route::get("/register", [RegisterController::class, "register"])->name("register");
Route::post("/register", [RegisterController::class, "do_register"])->name("do.register");

//forget password route start
Route::get('/frontend-forget-password', [ForgetPasswordController::class, 'getEmail'])->name('frontend.get.email');
Route::post('/frontend-forget-password', [ForgetPasswordController::class, 'postEmail'])->name('frontend.post.email');
Route::get('frontend-reset-password/{token}/{email}', [ForgetPasswordController::class, 'getPassword'])->name('frontend.get.password');
Route::post('frontend-reset-password/{email}/{token}', [ForgetPasswordController::class, 'reset_password'])->name('frontend.password.reset');
//forget password route end

//profile
Route::group(['prefix' => 'profile', 'middleware' => 'custom_auth'], function () {
    require_once "profile/doctor.php";
    require_once "profile/medical_assistant.php";
    require_once "profile/patient.php";
});

//contact
Route::get("/contact",[FrontendController::class,"contact"])->name("contact");
Route::post("/contact",[FrontendController::class,"contact_sms_send"])->name("contact.send");

//service route
Route::get("/services",[FrontendController::class,"services"])->name("all.services");
?>
