<?php

namespace App\Http\Controllers\Backend\UserModule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    //index function start
    public function index(){
        if( can("doctor") ){
            
        }
        else{
            return view("errors.404");
        }
    }
    //index function end
}
