<?php

namespace App\Http\Controllers\Backend\PageModule;

use App\Http\Controllers\Controller;
use App\Models\HomeModule\Home;
use App\Models\Quality_Module\Quality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Exception;


class HomePageController extends Controller
{
   //index funciton start
   public function index(){
        if( can("home_page") ){
             $homeDatas = Home::select("id","title","sub_title","description","image","about_title","about_description","about_image","satisfied_patient","patient_per_year")->first();
             $qualities = Quality::select("id","name","image")->get();
             return view("backend.modules.page_module.index", compact("homeDatas","qualities"));
        }
        else{
            return view("errors.404");
        }
    }   
    //index funciton end

    //update function start
    public function update(Request $request, $id){
            
        $validator = Validator::make($request->all(), [
                "title" => "required",
                "sub_title" => "required",
                "description" => "required",                      
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()],422);
            }else{
                if( can("home_page") ){
                    try{
                        $home = Home::find($id);
                        $home->title                = $request->title;
                        $home->sub_title            = $request->sub_title;
                        $home->description          = $request->description;      
                            
                        if( $request->image ){
                            if( File::exists('images/home/'. $home->image) ){
                                File::delete('images/home/'. $home->image);
                            }
                            $image = $request->file('image');
                            $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                            $location = public_path('images/home/'.$img);
                            Image::make($image)->save($location);
                            $home->image = $img;
                        }
        
        
                        if( $home->save() ){
                            return response()->json(['success' => 'Home Page Updated'], 200);
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

    //update about us function start
    public function update_about_us(Request $request, $id){
            
        $validator = Validator::make($request->all(), [
               
                "about_title" => "required",
                "about_description" => "required",
                "satisfied_patient" => "required",
                "patient_per_year" => "required",
                      
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()],422);
            }else{
                if( can("home_page") ){
                    try{
                        $home = Home::find($id);       
                        $home->about_title          = $request->about_title;        
                        $home->about_description    = $request->about_description;        
                        $home->satisfied_patient    = $request->satisfied_patient;        
                        $home->patient_per_year     = $request->patient_per_year;     
                            
                    
                        if( $request->about_image ){
                            if( File::exists('images/home/'. $home->about_image) ){
                                File::delete('images/home/'. $home->about_image);
                            }
                            $image = $request->file('about_image');
                            $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                            $location = public_path('images/home/'.$img);
                            Image::make($image)->save($location);
                            $home->about_image = $img;
                        }
        
        
                        if( $home->save() ){
                            return response()->json(['success' => 'About Page Updated'], 200);
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
    //update about us function end

    //quality page view start
    public function quality(){
        $qualities = Quality::select("id","name","image","position")->orderBy("id","desc")->get();
        return view("backend.modules.page_module.quality",compact("qualities"));
    }
    //quality page view ends


    //add modal function start
    public function add_modal(){
        if( can("home_page") ){
            return view("backend.modules.page_module.modals.add");
            }
            else{
                return view("errors.404");
            }
        }
    //add modal function end


    //get qualities data start
 
    public function data(){
        if( can('home_page') ){
            $quality = Quality::select("id","name","image","position")->get();

            return DataTables::of($quality)
            ->rawColumns(['action','image'])
            ->editColumn('image', function(Quality $quality){
                if( $quality->image == null ){
                    $src = asset("images/user.png");
                }
                else{
                    $src = asset("images/home/".$quality->image);
                } 
                return "<img src='$src' width='50px' style='border-radius: 100%'>";
            })
            ->addColumn('action', function (Quality $quality) {
                return '

                    '.( can("home_page") ? '
                    <button type="button" data-content="'.route('quality.edit.modal',$quality->id).'" data-target="#largeModal" class="btn btn-outline-dark" data-toggle="modal">
                        Edit
                    </button>
                    ': '') .'

                    '.( can("home_page") ? '
                    <button type="button" data-content="'.route('quality.delete.modal',$quality->id).'" data-target="#largeModal" class="btn btn-outline-dark" data-toggle="modal">
                        Delete
                    </button>
                    ': '') .'

                ';
            })
            ->make(true);
        }else{
            return view("errors.404");
        }
        
    }

    //get qualities data ends
 //add function start
    public function add(Request $request){
     
        if( can("home_page") ){
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "position" => "required|unique:qualities,position",
                "image" => "required|image",

            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $quality = new Quality();
                    $quality->name = $request->name;
                    $quality->position = $request->position;

                    if( $request->image ){
                        if( File::exists('images/home/'. $quality->image) ){
                            File::delete('images/home/'. $quality->image);
                        }
                        $image = $request->file('image');
                        $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                        $location = public_path('images/home/'.$img);
                        Image::make($image)->save($location);
                        $quality->image = $img;
                    }

                    if($quality->save()){
                        return response()->json(['success' => 'New Quality Added'],200); 
                    }

                }
                catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
            }
        }
        else{
            return view("errors.404");
        }
    }
    //add function end
    
    //edit modal view
    public function edit_modal($id){
        if( can("home_page") ){
            $quality = Quality::where("id",$id)->select("id","name","image" ,"position")->first();
            return view("backend.modules.page_module.modals.edit",compact("quality"));
        }
        else{
            return view("errors.404");
        }
    }
    //edit modal view

    //update about us function start
    public function update_quality(Request $request, $id){
            
        $validator = Validator::make($request->all(), [
               
                "name" => "required",
                "position" => "required|unique:qualities,position,".$id,
                      
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()],422);
            }else{
                if( can("home_page") ){
                    try{
                        $quality = Quality::find($id);       
                        $quality->name = $request->name;   
                        $quality->position = $request->position;   
                            
                    
                        if( $request->image ){
                            if( File::exists('images/home/'. $quality->image) ){
                                File::delete('images/home/'. $quality->image);
                            }
                            $image = $request->file('image');
                            $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                            $location = public_path('images/home/'.$img);
                            Image::make($image)->save($location);
                            $quality->image = $img;
                        }
        
        
                        if( $quality->save() ){
                            return response()->json(['success' => 'Quality Page Updated'], 200);
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
    //update about us function end


    //view delete modal
    public function delete_modal($id){
        if( can("delte_page") ){
            $quality = Quality::where("id",$id)->select("id","name","image")->first();
            return view("backend.modules.page_module.modals.delete", compact("quality"));
        }
        else{
            return view("errors.404");
        }
    }


//quality delete function start    
    public function delete($id){
    
       $quality = Quality::find($id);
        if( can("home_page") ){

            if( File::exists('images/home/'. $quality->image) ){
                File::delete('images/home/'. $quality->image);
                } 
                $quality->delete();
            return response()->json(['success' => 'Deleted Successfully'], 200);
        }
    }
    //quality delete function end
}
