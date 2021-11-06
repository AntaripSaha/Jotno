<?php

namespace App\Http\Controllers\Backend\TestModule;

use App\Http\Controllers\Controller;
use App\Models\TestModule\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Exception;

class MedicineController extends Controller
{
    //index funciton start
    public function index(){
        if( can("medicine") ){
            return view("backend.modules.test_module.all_medicine.index");
        }
        else{
            return view("errors.404");
        }
    }   
    //index funciton end


    //view data
    public function data(){
        if( can('medicine') ){
            $medicine = Medicine::select("id","name","is_active")->get();

            return DataTables::of($medicine)
            ->rawColumns(['action', 'is_active'])
            ->editColumn('is_active', function (Medicine $medicine) {
                if ($medicine->is_active == true) {
                    return '<p class="badge badge-success">Active</p>';
                } else {
                    return '<p class="badge badge-danger">Inactive</p>';
                }
            })
            ->addColumn('action', function (Medicine $medicine) {
                return '

                    '.( can("edit_medicine") ? '
                    <button type="button" data-content="'.route('medicine.edit',$medicine->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
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
        if( can("add_medicine") ){
            return view("backend.modules.test_module.all_medicine.modals.add");
        }
        else{
            return view("errors.404");
        }
    }   
    //add_modal funciton end

    //add medicine start
    public function add(Request $request){

        if( can('add_medicine') ){
            $validator = Validator::make($request->all(),[
                'name' => 'required|unique:medicines,name,',
            ]);
            

           if( $validator->fails() ){
               return response()->json(['errors' => $validator->errors()] ,422);
           }else{
                try{
                    $medicine = new Medicine();
                    $medicine->name = $request->name;
                    $medicine->slug = Str::slug($request->name);
                    $medicine->is_active      = true;
                    
                    if( $medicine->save() ){
                        return response()->json(['success' => 'New '.$medicine->name.' Created Successfully'], 200);
                    }

                }catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
           }
        }else{
            return view("errors.404");
        }
    }

    //add medicine end

    //medicine edit modal start
     public function edit($id){
        if( can("edit_medicine") ){
            $medicine = Medicine::where("id",$id)->select("id","name","is_active")->first();
            return view("backend.modules.test_module.all_medicine.modals.edit", compact("medicine"));
        }
        else{
            return view("errors.404");
        }
    }
    //medicine edit modal end

    //medicine update modal start
    public function update(Request $request, $id){
        if( can('edit_medicine') ){
            
            $validator = Validator::make($request->all(),[
                'name' => 'required|unique:medicines,name,'. $id,
           ]);

           if( $validator->fails() ){
               return response()->json(['errors' => $validator->errors()] ,422);
           }else{
                try{
                    $medicine = Medicine::find($id);
                    $medicine->name = $request->name;
                    $medicine->slug = Str::slug($request->name);
                    $medicine->is_active      = $request->is_active;

                    if( $medicine->save() ){
                        return response()->json(['success' => $medicine->name . "'s name Updated Successfully"], 200);
                    }
                }catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
           }
        }else{
            return view("errors.404");
        }
    }

    //medicine update modal end



}
