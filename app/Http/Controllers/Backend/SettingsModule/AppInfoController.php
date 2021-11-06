<?php

namespace App\Http\Controllers\Backend\SettingsModule;

use App\Http\Controllers\Controller;
use App\Models\SettingsModule\AppInfo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AppInfoController extends Controller
{
    //index function start
    public function index(){
        if( can("app_info") ){
            $app_info = AppInfo::select("id","logo","fav","address","email","phone","facebook_url","twitter_url","linkedin_url","footer_text")->first();
            return view("backend.modules.setting_module.app_info.index", compact("app_info"));
        }
        else{
            return view('errors.404');
        }
    }
    //index function end

    //update function start
    public function update(Request $request, $id){
            
        $validator = Validator::make($request->all(), [
                "address" => "required",
                "email" => "required",
                "phone" => "required|numeric|regex:/(01)[0-9]{9}/",
                "facebook_url" => "required",
                "twitter_url" => "required",
                "linkedin_url" => "required",
                "footer_text" => "required",
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()],422);
            }else{
                if( can("edit_app_info") ){
                    try{
                        $app_info = AppInfo::find($id);
                        $app_info->address          = $request->address;
                        $app_info->email            = $request->email;
                        $app_info->phone            = $request->phone;
                        $app_info->facebook_url     = $request->facebook_url;
                        $app_info->twitter_url      = $request->twitter_url;
                        $app_info->linkedin_url     = $request->linkedin_url;
                        $app_info->footer_text      = $request->footer_text;
        
                        //logo
                        if( $request->logo ){
                            if( File::exists('images/info/'. $app_info->logo) ){
                                File::delete('images/info/'. $app_info->logo);
                            }
                            $image = $request->file('logo');
                            $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                            $location = public_path('images/info/'.$img);
                            Image::make($image)->save($location);
                            $app_info->logo = $img;
                        }

                        //fav icon
                        if( $request->fav ){
                            if( File::exists('images/info/'. $app_info->fav) ){
                                File::delete('images/info/'. $app_info->fav);
                            }
                            $image = $request->file('fav');
                            $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                            $location = public_path('images/info/'.$img);
                            Image::make($image)->save($location);
                            $app_info->fav = $img;
                        }

                        // footer logo
                        if( $request->footer_logo ){
                            if( File::exists('images/info/'. $app_info->footer_logo) ){
                                File::delete('images/info/'. $app_info->footer_logo);
                            }
                            $image = $request->file('footer_logo');
                            $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                            $location = public_path('images/info/'.$img);
                            Image::make($image)->save($location);
                            $app_info->footer_logo = $img;
                        }
        
                        if( $app_info->save() ){
                            return response()->json(['success' => 'App Info Updated'], 200);
                        }
        
                    }
                    catch( Exception $e ){
                        return response()->json(['error' => $e->getMessage()], 200);
                    }
                }
                else{
                    return response()->json(['warning' => 'Unauthorized request'], 200);
                }
            }

        
    }
    //update function end
}
