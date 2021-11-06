<?php

namespace App\Http\Controllers\Backend\PageModule;

use App\Http\Controllers\Controller;
use App\Models\ServiceModule\Service;
use Exception;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class ServicePageController extends Controller
{
    //index funciton start
    public function index(){
        if( can("service_page") ){
             
            return view("backend.modules.page_module.service.index");
        }
        else{
            return view("errors.404");
        }
    }   
    //index funciton end


    //view data
    public function data(){
        if( can('service_page') ){
            $service = Service::select("id","name",'image','is_active','position')->orderBy("position","desc")->get();

            return DataTables::of($service)
            ->rawColumns(['action','image','is_active'])
            ->editColumn('image', function(Service $service){
                if( $service->image == null ){
                    $src = asset("images/user.png");
                }
                else{
                    $src = asset("images/service/".$service->image);
                } 
                return "<img src='$src' width='50px' style='border-radius: 100%'>";
            })
            ->editColumn('is_active', function (Service $service) {
                if ($service->is_active == true) {
                    return '<p class="badge badge-success">Active</p>';
                } else {
                    return '<p class="badge badge-danger">Inactive</p>';
                }
            })           
            
            ->addColumn('action', function (Service $service) {
                return '
                <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown'.$service->id.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdown'.$service->id.'">
                
                '.( can("service_page") ? '
                <a class="dropdown-item" href="#" data-content="'.route('service.edit',$service->id).'" data-target="#largeModal" class="btn btn-outline-dark" data-toggle="modal">
                    <i class="fas fa-edit"></i>
                    Edit Service
                </a>
                ': '') .' 
                
                    '.( can("service_page") ? '
                    <a class="dropdown-item text-danger" href="#" data-content="'.route('service.delete.modal',$service->id).'" data-target="#largeModal" class="btn btn-outline-dark" data-toggle="modal">
                        <i class="fas fa-trash"></i>
                        Delete Service
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
        if( can("service_page") ){
            return view("backend.modules.page_module.service.modals.add");
        }
        else{
            return view("errors.404");
        }
    }   
    //add_modal funciton end

    //add service start
    public function add(Request $request){
       
        if( can('service_page') ){
            $validator = Validator::make($request->all(),[
                'name' => 'required|unique:services,name',
                'position' => 'required|unique:services,position',
                'image' => 'required',
            ]);
            

           if( $validator->fails() ){
               return response()->json(['errors' => $validator->errors()] ,422);
           }else{
                try{
                    $service = new Service();
                    $service->name = $request->name;
                    $service->position = $request->position;  
                    $service->is_active = true;  

                    if( $request->image ){
                        
                        $image = $request->file('image');
                        $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                        $location = public_path('images/service/'.$img);
                        Image::make($image)->save($location);
                        $service->image = $img;
                    }

                    if( $service->save() ){
                        return response()->json(['success' => 'Service Created Successfully'], 200);
                    }

                }catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
           }
        }else{
            return view("errors.404");
        }
    }

    //add service end


    //service edit modal start
     public function edit($id){
        if( can("service_page") ){
            $service = Service::where("id",$id)->select("id","name","image","position","is_active")->first();
            return view("backend.modules.page_module.service.modals.edit", compact("service"));
        }
        else{
            return view("errors.404");
        }
    }
    //service edit modal end

    //service update modal start
    public function update(Request $request, $id){
        if( can('service_page') ){
            
            $validator = Validator::make($request->all(),[
                'name' => 'required|unique:services,name,'.$id,
                'position' => 'required|unique:services,position,'.$id,
           ]);

           if( $validator->fails() ){
               return response()->json(['errors' => $validator->errors()] ,422);
           }else{
                try{
                    $service = Service::find($id);
                    $service->name = $request->name;
                    $service->position = $request->position;
                    $service->is_active = $request->is_active;

                    if( $request->image ){
                        if( File::exists('images/service/'. $service->image) ){
                            File::delete('images/service/'. $service->image);
                        }
                        $image = $request->file('image');
                        $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                        $location = public_path('images/service/'.$img);
                        Image::make($image)->save($location);
                        $service->image = $img;
                    }

                    if( $service->save() ){
                        return response()->json(['success' => "Service Updated Successfully"], 200);
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
      
        if( can("service_page") ){
          $service = Service::where("id",$id)->select("id")->first();
            return view("backend.modules.page_module.service.modals.delete", compact("service"));
        }
        else{
            return view("errors.404");
        }
    }


   //service delete function start    
    public function delete($id){
        
        $service = Service::find($id);
        if( can("service_page") ){

            if( File::exists('images/services/'. $service->image) ){
                File::delete('images/services/'. $service->image);
                } 
                $service->delete();
            return response()->json(['success' => 'Deleted Successfully'], 200);
        }
   }
   //service delete function end

}
