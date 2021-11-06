<?php

namespace App\Http\Controllers\Backend\TestModule;

use App\Http\Controllers\Controller;
use App\Models\TestModule\TestType;
use App\Models\TestModule\TestTypeList;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class TestTypeController extends Controller
{
    
    //index function start
    public function index(){
        if( can("all_test") ){
            return view("backend.modules.test_module.all_test.index");
        }
        else{
            return view("errors.404");
        }
    }
    //index function end

    //data function start
    public function data(){
        if( can('all_test') ){
            $test_type = TestType::select("id","name","is_active")->get();

            return DataTables::of($test_type)
            ->rawColumns(['action', 'is_active'])
            ->editColumn('is_active', function (TestType $test_type) {
                if ($test_type->is_active == true) {
                    return '<p class="badge badge-success">Active</p>';
                } else {
                    return '<p class="badge badge-danger">Inactive</p>';
                }
            })
            ->addColumn('action', function (TestType $test_type) {
                return '

                    '.( can("edit_test") ? '
                    <button type="button" data-content="'.route('test.edit.modal',$test_type->id).'" data-target="#largeModal" class="btn btn-outline-dark" data-toggle="modal">
                        Edit
                    </button>
                    ': '') .'

                ';
            })
            ->make(true);
        }else{
            return view("errors.404");
        }
        
    }
    //data function end


    //add modal function start
    public function add_modal(){
        if( can("add_test") ){
            return view("backend.modules.test_module.all_test.modals.add");
        }
        else{
            return view("errors.404");
        }
    }
    //add modal function end


    //add function start
    public function add(Request $request){
        if( can("add_test") ){
            $validator = Validator::make($request->all(), [
                "test_type" => "required|unique:test_types,name",
                "test_name.*" => "required|unique:test_type_lists,name",
                "test_price.*" => "required|numeric",
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $test_type = new TestType();
                    
                    $test_type->name = $request->test_type;
                    $test_type->slug = Str::slug($request->test_type);
                    $test_type->is_active = true;

                    if( $test_type->save() ){

                        foreach( $request['test_name'] as $key => $test_name ){
                            $test_type_list = new TestTypeList();
                            $test_type_list->test_type_id  = $test_type->id;
                            $test_type_list->name = $test_name;
                            $test_type_list->slug = Str::slug($test_name);
                            $test_type_list->price = $request['test_price'][$key];
                            $test_type_list->is_active = true;
                            $test_type_list->save();
                        }
                        return response()->json(['success' => 'New test added'],200);
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


    //edit modal function start
    public function edit_modal($id){
        if( can("edit_test") ){
            $test_type = TestType::where("id",$id)->select("id","name","is_active")->first();
            $test_type_lists = $test_type->test_type_list;

            return view("backend.modules.test_module.all_test.modals.edit",compact("test_type","test_type_lists"));
        }
        else{
            return view("errors.404");
        }
    }
    //edit modal function end


    //edit function start
    public function edit(Request $request,$id){
        if( can("edit_test") ){

            if( $request['test_name'] ){
                $validator = Validator::make($request->all(), [
                    "test_type" => "required|unique:test_types,name,".$id,
                    "exists_test_name.*" => "required",
                    "exists_test_price.*" => "required|numeric",
                    "exists_test_status.*" => "required",
                    "test_name.*" => "required",
                    "test_price.*" => "required|numeric",
                    "is_active" => "required",
                ]);
            }
            else{
                $validator = Validator::make($request->all(), [
                    "test_type" => "required|unique:test_types,name,".$id,
                    "exists_test_name.*" => "required",
                    "exists_test_price.*" => "required|numeric",
                    "exists_test_status.*" => "required",
                    "is_active" => "required",
                ]);
            }
            

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $test_type = TestType::find($id);
                    
                    $test_type->name = $request->test_type;
                    $test_type->slug = Str::slug($request->test_type);
                    $test_type->is_active = true;

                    if( $test_type->save() ){

                        if( $request['exists_test_name'] ){
                            foreach( $request['exists_test_name'] as $key => $test_name ){
                                $test_type_list = $test_type->test_type_list[$key];

                                $test_type_list->name = $test_name;
                                $test_type_list->slug = Str::slug($test_name);
                                $test_type_list->price = $request['exists_test_price'][$key];
                                $test_type_list->is_active = $request['exists_test_status'][$key];
                                $test_type_list->save();
                            }
                        }

                        if( $request['test_name'] ){
                            foreach( $request['test_name'] as $key => $test_name ){
                                $test_type_list = new TestTypeList();
                                $test_type_list->test_type_id  = $test_type->id;
                                $test_type_list->name = $test_name;
                                $test_type_list->slug = Str::slug($test_name);
                                $test_type_list->price = $request['test_price'][$key];
                                $test_type_list->is_active = true;
                                $test_type_list->save();
                            }
                        }
                        
                        return response()->json(['success' => 'Test updated'],200);
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
    //edit function end

}
