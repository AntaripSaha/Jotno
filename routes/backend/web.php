<?php

use App\Http\Controllers\Backend\Auth\ForgetPasswordController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Auth\LogoutController;
use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;

//login route start
Route::get('/adminpanel', [LoginController::class, 'login_show'])->name('login.show');
Route::post('/do-login', [LoginController::class, 'do_login'])->name('do.login');
//login route end

//forget password route start
Route::get('/forget-password', [ForgetPasswordController::class, 'getEmail'])->name('get.email');
Route::post('/forget-password', [ForgetPasswordController::class, 'postEmail'])->name('post.email');
Route::get('reset-password/{token}/{email}', [ForgetPasswordController::class, 'getPassword'])->name('get.password');
Route::post('reset-password/{email}', [ForgetPasswordController::class, 'reset_password'])->name('password.reset');
//forget password route end

//logout route start
Route::post('/do-logout', [LogoutController::class, 'do_logout'])->name('do.logout');
//logout route end


//backend route group start
Route::group(['prefix' => 'admindashboard', 'middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    require_once "data.php";

    //profile module routes start
    Route::group(['prefix' => 'profile_module'], function () {
        require_once 'profile_module/profile.php';
    });
    //profile module routes end

    //user module routes start
    Route::group(['prefix' => 'user_module'], function () {
        require_once 'user_module/user.php';
        require_once 'user_module/role.php';
        require_once 'user_module/doctor.php';
        require_once 'user_module/medical_assistant.php';
        require_once 'user_module/patient.php';
    });
    //user module routes end

    //settings module routes start
    Route::group(['prefix' => 'settings_module'], function () {
        require_once 'settings_module/app_info.php';
    });
    //settings module routes end


    //test module routes start
    Route::group(['prefix' => 'test_module'], function () {
        require_once 'test_module/test_type.php';
        require_once 'test_module/medicine.php';
        require_once 'test_module/initial_test.php';
    });
    //test module routes end

    //appointment module routes start
    Route::group(['prefix' => 'appointment_module'], function () {
        require_once 'appointment_module/appointment.php';
        require_once 'appointment_module/charge.php';
    });
    //appointment module routes end

    //apps module routes start
    Route::group(['prefix' => 'apps_module'], function () {
        require_once 'apps_module/apps.php';
    });
    //apps module routes end

    //service module routes start
     Route::group(['prefix' => 'service_module'], function () {
        require_once 'service_module/service.php';
    });
    //service module routes end

    //chief_complaints module routes start
     Route::group(['prefix' => 'chief_complaints'], function () {
        require_once 'test_module/chief_complaints.php';
    });
    //chief_complaints module routes end

     //contact module routes start
     Route::group(['prefix' => 'contact_module'], function () {
        require_once 'contact_module/contact.php';
    });
    //contact module routes end

    //contact module routes start
    Route::group(['prefix' => 'page_module'], function () {
        require_once 'page_module/page.php';
    });
    //contact module routes end

    //contact module routes start
    Route::group(['prefix' => 'blog_module'], function () {
        require_once 'blog_module/blog.php';
    });
    //contact module routes end


    //new_pages_module module routes start
    Route::group(['prefix' => 'new_pages_module'], function () {
        require_once 'new_pages_module/new_pages.php';
    });
    //new_pages_module module routes end

    
});
//backend route group end
