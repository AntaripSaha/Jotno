<?php

namespace App\Http\Controllers\Backend\AppsModule;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppsModule\BannerResourceCollection;
use App\Models\AppsModule\Banner;
use Illuminate\Http\Request;

class ApiBannerController extends Controller
{
    public function banner_all(){
        
        $banner = Banner::select("id","position","title","image")->orderBy("id","desc")->get();

        if( $banner ){
            return response()->json([
                'status' => 'success',
                'body' => new BannerResourceCollection($banner)
            ],200);
        }
        else{
            return response()->json([
                'status' => 'error',
                'body' => [
                    'message' => 'No Banner Found'
                ]
            ],200);
        }

    }
}
