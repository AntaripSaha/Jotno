<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;



//live server command route start
Route::get('/clear', function(){
    Artisan::call("config:cache");
    Artisan::call("cache:clear");
    return "success";
});

Route::get('/db', function(){
    Artisan::call("migrate");
    Artisan::call("db:seed");
    return "success";
});
Route::get('/db-download', function () {
    $username = "beautycl_jotno";
    $password = "beautycl_jotno";
    $db_name = "beautycl_jotno";
    $name = 'export_'.time().'.sql';
    $upload_path = public_path('database/');
    $full_path = $upload_path.$name;
    
    exec("mysqldump -u$username -p$password $db_name > $full_path");
    
    $headers = array(
      'Content-Type: application/sql',
    );

    return Response::download($full_path,$name,$headers);
    
    return "Success";
});
//live server command route end


/*
|--------------------------------------------------------------------------
| Backend Routes Start
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    require_once "backend/web.php";
/*
|--------------------------------------------------------------------------
| Backend Routes End
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





/*
|--------------------------------------------------------------------------
| Frontend Routes Start
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require_once "frontend/web.php";
/*
|--------------------------------------------------------------------------
| Frontend Routes End
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/