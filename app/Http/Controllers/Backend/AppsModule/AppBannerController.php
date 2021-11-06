<?php

namespace App\Http\Controllers\Backend\AppsModule;

use App\Http\Controllers\Controller;
use App\Models\AppsModule\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class AppBannerController extends Controller
{
    //index funciton start
    public function index(){
        if( can("banner") ){
             
            return view("backend.modules.app_module.banner.index");
        }
        else{
            return view("errors.404");
        }
    }   
    //index funciton end


    //view data
    public function data(){
        if( can('banner') ){
            $banner = Banner::select("id","position","title","image")->orderBy("id","desc")->get();

            return DataTables::of($banner)
            ->rawColumns(['action','image','is_active'])
            ->editColumn('is_active', function (Banner $banner) {
                if ($banner->is_active == true) {
                    return '<p class="badge badge-success">Active</p>';
                } else {
                    return '<p class="badge badge-danger">Inactive</p>';
                }
            })
            ->editColumn('image', function(Banner $banner){
                if( $banner->image == null ){
                    $src = asset("images/user.png");
                }
                else{
                    $src = asset("images/banners/".$banner->image);
                } 
                return "<img src='$src' width='50px' style='border-radius: 100%'>";
            })
            
            ->addColumn('action', function (Banner $banner) {
                return '
                <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown'.$banner->id.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdown'.$banner->id.'">
                
                '.( can("edit_banner") ? '
                <a class="dropdown-item" href="#" data-content="'.route('banner.edit',$banner->id).'" data-target="#largeModal" class="btn btn-outline-dark" data-toggle="modal">
                    <i class="fas fa-edit"></i>
                    Edit Banner
                </a>
                ': '') .' 
                
                    '.( can("delte_banner") ? '
                    <a class="dropdown-item text-danger" href="#" data-content="'.route('delete.modal',$banner->id).'" data-target="#largeModal" class="btn btn-outline-dark" data-toggle="modal">
                        <i class="fas fa-trash"></i>
                        Delete Banner
                    </a>
                    ': '') .'

                    

                ';
            })
            ->make(true);
        }else{
            return view("errors.404");
        }
        
    }


    //add_modal funciton start
    public function add_modal(){
        if( can("add_banner") ){
            return view("backend.modules.app_module.banner.modals.add");
        }
        else{
            return view("errors.404");
        }
    }   
    //add_modal funciton end

    //add banner start
    public function add(Request $request){
        if( can('add_banner') ){
            $validator = Validator::make($request->all(),[
                'title' => 'required|unique:banners,title,',
                'position' => 'required|unique:banners,position,',
                'image' => 'required|mimes:jpeg,jpg,png,gif,pdf|max:2048|dimensions:width=1280,height=720',
            ]);
            

           if( $validator->fails() ){
               return response()->json(['errors' => $validator->errors()] ,422);
           }else{
                try{
                    $banner = new Banner();
                    $banner->title = $request->title;
                    $banner->position = $request->position;
                    // image insert 
                    if ($request->image){
                            
                        //insert that image
                        $image = $request->file('image');
                        $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                        $location = public_path('images/banners/' .$img);
                        Image::make($image)->save($location);
                        $banner->image = $img;
                }

                    
                    if( $banner->save() ){
                        return response()->json(['success' => 'Banner Created Successfully'], 200);
                    }

                }catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
           }
        }else{
            return view("errors.404");
        }
    }

    //add banner end


    //banner edit modal start
     public function edit($id){
        if( can("edit_banner") ){
            $banner = Banner::where("id",$id)->select("id","title","image","position")->first();
            return view("backend.modules.app_module.banner.modals.edit", compact("banner"));
        }
        else{
            return view("errors.404");
        }
    }
    //banner edit modal end

    //banner update modal start
    public function update(Request $request, $id){
        if( can('edit_banner') ){
            
            $validator = Validator::make($request->all(),[
                'title' => 'required|unique:banners,title,'. $id,
                'position' => 'required|unique:banners,position,'. $id,
                'image' => 'required|mimes:jpeg,jpg,png,gif,pdf|max:2048|dimensions:width=1280,height=720',
           ]);

           if( $validator->fails() ){
               return response()->json(['errors' => $validator->errors()] ,422);
           }else{
                try{
                    $banner = Banner::find($id);
                    $banner->title = $request->title;
                    $banner->position = $request->position;

                    if( $request->image ){
                        if( File::exists('images/banners/'. $banner->image) ){
                            File::delete('images/banners/'. $banner->image);
                        }
                        $image = $request->file('image');
                        $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                        $location = public_path('images/banners/'.$img);
                        Image::make($image)->save($location);
                        $banner->image = $img;
                    }

                    if( $banner->save() ){
                        return response()->json(['success' => "Banner Updated Successfully"], 200);
                    }
                }catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
           }
        }else{
            return view("errors.404");
        }
    }


    //view delete modal
    public function delete_modal($id){
        if( can("delte_banner") ){
            $banner = Banner::where("id",$id)->select("id","title","image","position")->first();
            return view("backend.modules.app_module.banner.modals.delete_modal", compact("banner"));
        }
        else{
            return view("errors.404");
        }
    }


   //banner delete function start    
    public function delete($id){
      
        $banner = Banner::find($id);
        if( can("delte_banner") ){

            if( File::exists('images/banners/'. $banner->image) ){
                File::delete('images/banners/'. $banner->image);
                } 
                $banner->delete();
            return response()->json(['success' => 'Deleted Successfully'], 200);
        }
   }
   //banner delete function end

}
