<?php

namespace App\Http\Controllers\Backend\TestModule;

use App\Http\Controllers\Controller;
use App\Models\TestModule\InitialTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class InitialTestController extends Controller
{
    //index funciton start
    public function index(){
        if( can("initial_test") ){
            return view("backend.modules.test_module.all_initial_test.index");
        }
        else{
            return view("errors.404");
        }
    }   
    //index funciton end


    //view data
    public function data(){
        if( can('initial_test') ){
            $initial_test = InitialTest::select("id","name","is_active")->get();

            return DataTables::of($initial_test)
            ->rawColumns(['action', 'is_active'])
            ->editColumn('is_active', function (InitialTest $initial_test) {
                if ($initial_test->is_active == true) {
                    return '<p class="badge badge-success">Active</p>';
                } else {
                    return '<p class="badge badge-danger">Inactive</p>';
                }
            })
            ->addColumn('action', function (InitialTest $initial_test) {
                return '

                    '.( can("edit_initial_test") ? '
                    <button type="button" data-content="'.route('initial_test.edit',$initial_test->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
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

    //add_modal funciton start
    public function add_modal(){
        if( can("add_initial_test") ){
            return view("backend.modules.test_module.all_initial_test.modals.add");
        }
        else{
            return view("errors.404");
        }
    }   
    //add_modal funciton end

    //add initial_test start
    public function add(Request $request){

        if( can('add_initial_test') ){
            $validator = Validator::make($request->all(),[
                'name' => 'required|unique:initial_tests,name,',
            ]);
            

           if( $validator->fails() ){
               return response()->json(['errors' => $validator->errors()] ,422);
           }else{
                try{
                    $initial_test = new InitialTest();
                    $initial_test->name = $request->name;
                    $initial_test->is_active      = true;
                    
                    if( $initial_test->save() ){
                        return response()->json(['success' => 'New '.$initial_test->name.' Created Successfully'], 200);
                    }

                }catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
           }
        }else{
            return view("errors.404");
        }
    }

    //add initial_test end

    //initial_test edit modal start
     public function edit($id){
        if( can("edit_initial_test") ){
            $initial_test = InitialTest::where("id",$id)->select("id","name","is_active")->first();
            return view("backend.modules.test_module.all_initial_test.modals.edit", compact("initial_test"));
        }
        else{
            return view("errors.404");
        }
    }
    //initial_test edit modal end

    //initial_test update modal start
    public function update(Request $request, $id){
        if( can('edit_initial_test') ){
            
            $validator = Validator::make($request->all(),[
                'name' => 'required|unique:initial_tests,name,'. $id,
           ]);

           if( $validator->fails() ){
               return response()->json(['errors' => $validator->errors()] ,422);
           }else{
                try{
                    $initial_test = InitialTest::find($id);
                    $initial_test->name = $request->name;
                    $initial_test->is_active      = $request->is_active;

                    if( $initial_test->save() ){
                        return response()->json(['success' => $initial_test->name . "'s name Updated Successfully"], 200);
                    }
                }catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
           }
        }else{
            return view("errors.404");
        }
    }

    //initial_test update modal end



}
