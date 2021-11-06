<?php

namespace App\Http\Controllers\Backend\PageModule;

use App\Http\Controllers\Controller;
use App\Models\PageModule\NewPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Exception;
class NewPageController extends Controller
{
    //index funciton start
    public function index(){
        if( can("new_page") ){
             
            return view("backend.modules.page_module.new_pages.index");
        }
        else{
            return view("errors.404");
        }
    }   
    //index funciton end


    //view data
    public function data(){
        if( can('new_page') ){
            $new_page = NewPage::select("id","name",)->orderBy("id","desc")->get();

            return DataTables::of($new_page)
            ->rawColumns(['action','image','is_active'])
            ->editColumn('is_active', function (NewPage $new_page) {
                if ($new_page->is_active == true) {
                    return '<p class="badge badge-success">Active</p>';
                } else {
                    return '<p class="badge badge-danger">Inactive</p>';
                }
            })
            ->editColumn('image', function(NewPage $new_page){
                if( $new_page->image == null ){
                    $src = asset("images/user.png");
                }
                else{
                    $src = asset("images/new_pages/".$new_page->image);
                } 
                return "<img src='$src' width='50px' style='border-radius: 100%'>";
            })
            
            ->addColumn('action', function (NewPage $new_page) {
                return '
                <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown'.$new_page->id.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdown'.$new_page->id.'">
                
                '.( can("new_page") ? '
                <a class="dropdown-item" href="#" data-content="'.route('new.page.edit',$new_page->id).'" data-target="#largeModal" class="btn btn-outline-dark" data-toggle="modal">
                    <i class="fas fa-edit"></i>
                    Edit NewPage
                </a>
                ': '') .' 
                
                    '.( can("new_page") ? '
                    <a class="dropdown-item text-danger" href="#" data-content="'.route('delete.modal',$new_page->id).'" data-target="#largeModal" class="btn btn-outline-dark" data-toggle="modal">
                        <i class="fas fa-trash"></i>
                        Delete NewPage
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
        if( can("new_page") ){
            return view("backend.modules.page_module.new_pages.modals.add");
        }
        else{
            return view("errors.404");
        }
    }   
    //add_modal funciton end

    //add new_page start
    public function add(Request $request){
       
        if( can('new_page') ){
            $validator = Validator::make($request->all(),[
                'name' => 'required|unique:new_pages,name',
                'description' => 'required',
            ]);
            

           if( $validator->fails() ){
               return response()->json(['errors' => $validator->errors()] ,422);
           }else{
                try{
                    $new_page = new NewPage();
                    $new_page->name = $request->name;
                    $new_page->slug = Str::slug($request->name);
                    $new_page->description = $request->description;                 

                    if( $new_page->save() ){
                        return response()->json(['success' => 'NewPage Created Successfully'], 200);
                    }

                }catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
           }
        }else{
            return view("errors.404");
        }
    }

    //add new_page end


    //new_page edit modal start
     public function edit($id){
        if( can("new_page") ){
            $new_page = NewPage::where("id",$id)->select("id","name","description")->first();
            return view("backend.modules.page_module.new_pages.modals.edit", compact("new_page"));
        }
        else{
            return view("errors.404");
        }
    }
    //new_page edit modal end

    //new_page update modal start
    public function update(Request $request, $id){
        if( can('new_page') ){
            
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'description' => 'required',
           ]);

           if( $validator->fails() ){
               return response()->json(['errors' => $validator->errors()] ,422);
           }else{
                try{
                    $new_page = NewPage::find($id);
                    $new_page->name = $request->name;
                    $new_page->slug = Str::slug($request->name);
                    $new_page->description = $request->description;

                    if( $new_page->save() ){
                        return response()->json(['success' => "NewPage Updated Successfully"], 200);
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
        if( can("new_page") ){
            $new_page = NewPage::where("id",$id)->select("id","name")->first();
            return view("backend.modules.page_module.new_pages.modals.delete", compact("new_page"));
        }
        else{
            return view("errors.404");
        }
    }


   //new_page delete function start    
    public function delete($id){
      
        $new_page = NewPage::find($id);
        if( can("new_page") ){

            if( File::exists('images/new_pages/'. $new_page->image) ){
                File::delete('images/new_pages/'. $new_page->image);
                } 
                $new_page->delete();
            return response()->json(['success' => 'Deleted Successfully'], 200);
        }
   }
   //new_page delete function end

}
