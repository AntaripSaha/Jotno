<?php

namespace App\Http\Controllers\Backend\PageModule;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceModule\ServiceResourceCollection;
use App\Models\ServiceModule\Service;
use Illuminate\Http\Request;

class ApiServiceController extends Controller
{
    public function all_services(){

        $all_services = Service::select("id","name",'image','is_active')->orderBy("id","desc")->get();

        if( $all_services ){
            return response()->json([
                'status' => 'success',
                'banner' => new ServiceResourceCollection($all_services)
            ],200);
        }
        else{
            return response()->json([
                'status' => 'error',
                'body' => [
                    'message' => 'No Service Found'
                ]
            ],200);
        }
    }
}
